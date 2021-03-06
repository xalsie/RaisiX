<?php
include_once("../../includes/inc.php");

if (!isConnected())
    die("Vous etes deconnect√©.");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    http_response_code(401);
    echo "Not unauthorized for GET request.";
    return;
}

// Getting posted data and decodeing json
if(empty($_POST))
    $_POST = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
	switch ($_POST['action']){
		case "getSession":
            $SQL = "SELECT u.id, u.firstname, u.lastname, u.email, u.auth_fa, ud.pseudo, ud.avatar, ud.langue, ud.date_naissance, ud.description, ud.payment_date, ud.payment_choise
                        FROM users AS u
                        JOIN users_detail AS ud
                        JOIN users_sign AS us
                        ON u.id = ud.id_users AND u.id = us.id_users
                        WHERE u.id = ".$_SESSION["id"]." AND us.id_device = '".$_COOKIE['id_device']."' AND us.token = '".$_SESSION[$_COOKIE["id_device"]]["token"]."';";

            $result = db_query($SQL);

            header('Content-Type: text/json; charset=utf-8');
			echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
			break;
        case "saveSession":
            /*
            "firstname"         :"Alexis",
            "lastname"          :"GIARD",
            "email"             :"xalsie.ff@hotmail.fr",
            "avatar"            :"LeGrizzly",
            "langue"            :null,
            "date_naissance"    :null,
            "description"       :null
            */
            $data = $_POST["data"][0];

            print_r($data["id"]);

            $SQL = "INSERT INTO `users` (`date_modification`, `firstname`, `lastname`, `email`, `password`, `date_modification_pw`)
				VALUES (now(), '".db_escape($_POST["firstname"])."', '".db_escape($_POST["lastname"])."', '".db_escape($_POST["email"])."', '".password_hash($_POST["pwd"], PASSWORD_BCRYPT)."', now());";
			$result = db_execute($SQL);

            break;
        case "getAvatar":
            $SQL = "SELECT ud.avatar FROM users_detail AS ud WHERE ud.id_users = ".$_SESSION["id"].";";
            $result = db_query($SQL);

			echo json_encode($result);
            break;
        case "getDatasSlider":
            $SQL = "SELECT * FROM `movie_detail` ORDER BY date_create DESC LIMIT 6;";
                $result["slider"] = [];
                $result["slider"]["datas"] = db_query($SQL);

			if (!$result["slider"]["datas"]) {
                $result["slider"]["datas"] = [];
                $result["slider"]["_count"] = 0;
            } else
                $result["slider"]["_count"] = count($result["slider"]["datas"]);
        
            echo json_encode($result);
            break;
        case "getDatasNotifs":
            $listView = $_POST["listView"];

            $SQL = "SELECT id, date_create, title, backdrop_path, poster_path FROM `movie_detail` WHERE id NOT IN (".db_escape($listView).") ORDER BY date_create DESC;";
                $result["notification"] = [];
                $result["notification"]["datas"] = db_query($SQL);

            if (!$result["notification"]["datas"]) {
                $result["notification"]["datas"] = [];
                $result["notification"]["_count"] = 0;
            } else
                $result["notification"]["_count"] = count($result["notification"]["datas"]);

            echo json_encode($result);
            break;
        case "getUpcomingMovies":
            $SQL = "SELECT id, date_create, title, vote_average, runtime, backdrop_path, poster_path FROM `movie_detail` WHERE `status` = '1' ORDER BY date_create DESC LIMIT 8;";
                $result["upComingMovies"] = [];
                $result["upComingMovies"]["datas"] = db_query($SQL);

            if (!$result["upComingMovies"]["datas"]) {
                $result["upComingMovies"]["datas"] = [];
                $result["upComingMovies"]["_count"] = 0;
            } else
                $result["upComingMovies"]["_count"] = count($result["upComingMovies"]["datas"]);

            echo json_encode($result);
            break;
        case "getListUsers":
            $_search = (empty($_POST["search"])? false:$_POST["search"]);

            $SQL = "SELECT u.id, u.date_create, u.date_modification, u.firstname, u.lastname, u.email, u.check_email, u.date_modification_pw, u.role, u.auth_fa, ud.date_modification, ud.pseudo, ud.avatar, ud.langue, ud.date_naissance, ud.description, ud.payment_date, ud.payment_choise FROM `users` AS u
                    LEFT JOIN `users_detail` AS ud on u.`id` = ud.`id_users`
                    ORDER BY u.`date_create` ASC;";
                $result = db_query($SQL);

            if(!$result[0])
                $aRow=array();
            else
                foreach ($result as $row) {
                    $aRow[]=array("id"=>$row["id"],"date_create"=>$row["date_create"],"date_modification"=>$row["date_modification"],
                                "firstname"=>$row["firstname"],"lastname"=>$row["lastname"],"email"=>$row["email"],"check_email"=>$row["check_email"],
                                "date_modification_pw"=>$row["date_modification_pw"],"role"=>$row["role"],"auth_fa"=>$row["auth_fa"],
                                "date_modification"=>$row["date_modification"],"pseudo"=>$row["pseudo"],"avatar"=>$row["avatar"],"langue"=>$row["langue"],
                                "date_naissance"=>$row["date_naissance"],"description"=>$row["description"],"payment_date"=>$row["payment_date"],
                                "payment_choise"=>$row["payment_choise"]);
                }

            echo json_encode($aRow);
            break;
        case "getMovies":
            $SQL = "SELECT id, date_create, title, vote_average, runtime, backdrop_path, poster_path FROM `movie_detail` WHERE `status` = '2' ORDER BY date_create DESC LIMIT 16;";
                $result["moviesList"] = [];
                $result["moviesList"]["datas"] = db_query($SQL);

            if (!$result["moviesList"]["datas"]) {
                $result["moviesList"]["datas"] = [];
                $result["moviesList"]["_count"] = 0;
            } else
                $result["moviesList"]["_count"] = count($result["moviesList"]["datas"]);

            echo json_encode($result);
            break;
        case "saveMovie":
            $data     = $_POST["data"];
            $credits  = $_POST["credits"];
            $backdrop = $_POST["backdrop"];
            $language = $_POST["language"];
            $pathfile = $_POST["pathfile"];
            $poster   = $_POST["poster"];
            $qualite  = $_POST["qualite"];
            $status   = $_POST["status"];
            $video    = $_POST["video"];

            $result = [];
            $savePicture = [];

            $SQL = "INSERT INTO `movie_detail` (`date_create`, `date_modification`, `adult`, `backdrop_path`, `belongs_to_collection`, `budget`, `genres`, `homepage`, `tmdb_id`, `imdb_id`, `original_language`, `original_title`, `overview`, `popularity`, `poster_path`, `production_companies`, `production_countries`, `release_date`, `revenue`, `runtime`, `languages`, `status`, `tagline`, `title`, `video`, `vote_average`, `vote_count`, `qualite`, `pathfile`)
                    VALUES (now(), now(), '".$data['adult']."', '".$backdrop."', '".json_encode($data['belongs_to_collection'])."', '".$data['budget']."', '".json_encode($data['genres'])."', '".db_escape($data['homepage'])."', '".$data['id']."', '".$data['imdb_id']."', '".db_escape($data['original_language'])."', '".db_escape($data['original_title'])."', '".db_escape($data['overview'])."', '".$data['popularity']."', '".$poster."', '".json_encode($data['production_companies'])."', '".json_encode($data['production_countries'])."', '".$data['release_date']."', '".$data['revenue']."', '".$data['runtime']."', '".json_encode($language)."', '".$status."', '".db_escape($data['tagline'])."', '".db_escape($data['title'])."', '".$video."', '".$data['vote_average']."', '".$data['vote_count']."', '".json_encode($qualite)."', '".db_escape(json_encode($pathfile, JSON_FORCE_OBJECT))."');";
			$result1 = db_execute($SQL);

            $insert_id[0] = db_query("SELECT LAST_INSERT_ID();");

            $SQL = "INSERT INTO `movie_credits` (`date_create`, `date_modification`, `id_movie_details`, `content`) VALUES (now(), now(), (SELECT LAST_INSERT_ID() AS lastID), '".db_escape(json_encode($credits))."')";
            $result2 = db_execute($SQL);

            if (!empty($poster)) {
                $savePicture["poster"] = saveFile('https://image.tmdb.org/t/p/original'.$poster, $poster, 'assets/images/movie-poster');
            }

            if (!empty($backdrop)) {
                $savePicture["backdrop"] = saveFile('https://image.tmdb.org/t/p/original'.$backdrop, $backdrop, 'assets/images/movie-backdrop');
            }

            if ($result1[0] && $result2[0]) {
                discordApiPost($data, $credits, $insert_id);
            }

            print_r([$result1, $result2, $savePicture]);
            break;
        case "getPathMovie":
            $result = array();
            $dir = 'C:/wamp64/www/raisix/assets/video/';
            $files = scandir($dir);

            foreach ($files as $key => $value) {
                $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
                if (is_dir($path) && $value != "." && $value != "..") {
                    $result[] = $path;
                }
            }

            echo json_encode($result);
            break;
        case "getMovieById":
            $SQL = "SELECT md.id, md.adult, md.backdrop_path, md.genres, md.original_title, md.overview, md.poster_path, md.release_date, md.runtime, md.languages, md.title, md.vote_average, md.vote_count, md.qualite, mc.content FROM `movie_detail` AS md
                     INNER JOIN `movie_credits` AS mc
                     on md.id = mc.id_movie_details
                     WHERE md.id = '".db_escape($_POST['uuid'])."';";
                $result = db_query($SQL);

            echo json_encode($result);
            break;
        case "toMovieView":
            $idMovie = db_escape($_POST["uuid"]);
            $idUser = $_SESSION["id"];

            $SQL = "INSERT INTO `movie_view` (`date_create`, `date_modification`, `id_movie`, `id_user`) VALUES (NOW(), NOW(), $idMovie, $idUser)";
                $result = db_execute($SQL);

                echo json_encode($result);
            break;
        case "getListMovie":
            // $_limit = $_POST["limit"];
            // $_offset = $_POST["offset"];
            $_search = (empty($_POST["search"])? false:$_POST["search"]);
            $_reqSearch = "";

            if ($_search) {
                $_reqSearch = "WHERE (`adult` LIKE '%$_search%' OR `backdrop_path` LIKE '%$_search%' OR `belongs_to_collection` LIKE '%$_search%' OR `genres` LIKE '%$_search%' OR `homepage` LIKE '%$_search%' OR `tmdb_id` LIKE '%$_search%' OR `imdb_id` LIKE '%$_search%' OR `original_language` LIKE '%$_search%' OR `original_title` LIKE '%$_search%' OR `overview` LIKE '%$_search%' OR `poster_path` LIKE '%$_search%' OR `production_companies` LIKE '%$_search%' OR `production_countries` LIKE '%$_search%' OR `release_date` LIKE '%$_search%' OR `languages` LIKE '%$_search%' OR `status` LIKE '%$_search%' OR `tagline` LIKE '%$_search%' OR `title` LIKE '%$_search%' OR `video` LIKE '%$_search%' OR `qualite` LIKE '%$_search%' OR `pathfile` LIKE '%$_search%')";
            }

            $SQL = "SELECT `id`, `date_create`, `date_modification`, `poster_path`, `genres`, `tmdb_id`, `original_title`, `release_date`, `qualite`, `languages`, `runtime`, `overview`, `status`, `vote_average`, `vote_count`, `pathfile` FROM `movie_detail` $_reqSearch ;";
                $result = db_query($SQL);

            if(!$result)
                $aRow=array();
            else
                foreach ($result as $row) {
                    $aRow[]=array("id"=>$row["id"], "date_create"=>$row["date_create"], "date_modification"=>$row["date_modification"],
                    "poster_path"=>$row["poster_path"], "genres"=>$row["genres"], "tmdb_id"=>$row["tmdb_id"],"original_title"=>$row["original_title"],
                    "release_date"=>$row["release_date"], "qualite"=>$row["qualite"], "languages"=>$row["languages"],"runtime"=>$row["runtime"],
                    "overview"=>$row["overview"], "status"=>$row["status"], "vote_average"=>$row["vote_average"], "vote_count"=>$row["vote_count"],
                    "pathfile"=>$row["pathfile"]);
                }

            echo json_encode($aRow);
            break;
        case "delMovie":

            break;
        case "getListRequestMovie":
            $_search = (empty($_POST["search"])? false:$_POST["search"]);

            $SQL = "SELECT mr.id, mr.date_create, mr.date_modification, ud.pseudo, mr.name, mr.`date-release`, mr.langage FROM `movie_request` AS mr LEFT JOIN `users_detail` AS ud on mr.id_users = ud.id_users;";
                $result = db_query($SQL);

            if(!$result)
                $aRow=array();
            else
                foreach ($result as $row) {
                    $aRow[]=array("id"=>$row["id"], "date_create"=>$row["date_create"], "date_modification"=>$row["date_modification"],
                    "pseudo"=>$row["pseudo"], "name"=>$row["name"], "date-release"=>$row["date-release"],"langage"=>$row["langage"]);
                }

            echo json_encode($aRow);
            break;
        case "saveMovieRequest":
            $nameMovie = db_escape($_POST["nameMovie"]);
            $dateRelease = db_escape($_POST["dateRelease"]);
            $langage = db_escape(json_encode($_POST["langage"], JSON_FORCE_OBJECT));

            $SQL = "INSERT INTO `movie_request` (`date_create`, `date_modification`, `id_users`, `name`, `date-release`, `langage`)
                    VALUES (now(), now(), '".$_SESSION['id']."', '$nameMovie', '$dateRelease', '$langage');";
            $result = db_execute($SQL);

            if ($result[0]) {
                echo 'OK';
            }
            break;
        case "toSignOutAll":
            $error = FALSE;
	        $codeErrors = [];
            $_rtn = false;
            if ((count($_POST) == 3) && !empty($_POST["pwd"])) {
                $SQL = "SELECT u.`id`, u.`password` FROM `users` AS u
                         JOIN users_sign AS us
                         ON u.id = us.id_users
                         WHERE u.`email` = '".db_escape($_SESSION["email"])."' AND u.`id` = ".$_SESSION["id"]." AND us.id_device = '".$_COOKIE["id_device"]."' AND us.token = '".$_SESSION[$_COOKIE["id_device"]]["token"]."';";

                    $result = db_query($SQL);

                if (password_verify($_POST["pwd"], $result[0]["password"])) {
                    $SQL = "UPDATE users_sign SET date_modification = NOW(), token = 0 WHERE id_users = ".$_SESSION["id"]." AND id_device != '".$_COOKIE["id_device"]."';";
                        $result = db_execute($SQL);
                    $_rtn = json_encode(true);
                } else {
                    $error = TRUE;
                    $codeErrors = 11;
                }
            } else {
                $error = TRUE;
                $codeErrors = 11;
            }

            if (!$error)
                echo $_rtn;
            else
                echo json_encode([false, $listOfErrors[$codeErrors]]);
            break;
        case "toSuppCart":
            $id = db_escape($_POST["id"]);

            $SQL = "DELETE FROM `users_cart` WHERE (`id` = '$id');";
                $result = db_execute($SQL);

                echo json_encode($result);
            break;
        case "getCartuser":
            $SQL = "SELECT * FROM `users_cart` WHERE (id_users = ".$_SESSION["id"].");";
                $result = db_query($SQL);

            if(!$result)
                $aRow=array();
            else
                foreach ($result as $row) {
                    $data = "************".substr($row["number"],-4);
                    $aRow[]=array("id"=>$row["id"], "date_create"=>$row["date_create"], "date_modification"=>$row["date_modification"],
                    "id_users"=>$row["id_users"], "name"=>$row["name"], "number"=>$data, "date"=>$row["date"]);
                }

            echo json_encode($aRow);
            break;
        case "toPay":
            $savedCart = db_escape($_POST["saved"]);
            $remember_cart = $_POST["remember_cart"];
            $optionPlan = db_escape($_POST["option"]);

            if ($savedCart == true) {
                // $idCart = $_POST["id"];
                // verif Cart
                $cvv = $_POST["cvv"];

                if ($cvv !== "001") {
                    $errorText = "Le CVV de la carte est faux.";
                    echo json_encode([false, $errorText]);
                    break;
                }
                // payment process
                // return
                //      -> false - return error
                //      -> true - insert detail table
            } else if ($remember_cart) {
                $nameCart = (empty($_POST["name"])? false:$_POST["name"]);
                $numCart = (empty($_POST["number"])? false:$_POST["number"]);
                $dateCart = (empty($_POST["date"])? false:$_POST["date"]);

                $SQL = "INSERT INTO `users_cart` (`date_create`, `date_modification`, `id_users`, `name`, `number`, `date`) VALUES (NOW(), NOW(), ".$_SESSION["id"].", '$nameCart', '$numCart', '$dateCart');";
                    $result = db_execute($SQL);
    
                // payment process
            }

            $SQL = "UPDATE `users_detail` SET `payment_date` = NOW(), `payment_choise` = '$optionPlan' WHERE (id_users = ".$_SESSION["id"].");";
                $result = db_execute($SQL);

            echo json_encode($result);
            break;
	
    
        case "deleteUser":
            $rtn = false;
            $rtn_txt = "";

            $id = db_escape($_POST["id"]);

            $SQL = "DELETE FROM `users` WHERE `id` = '".$id."';";
                $result = db_execute($SQL);
            
            if ($result) {
                $rtn = true;
            } else {
                $rtn_txt = "Une erreur s'est produite lors de l'execution de la tache. Contacter le support.";
            }

            echo json_encode([$rtn, $rtn_txt]);
            break;
        case "editUser":
            $rtn = false;
            $rtn_txt = "";

            $id = db_escape($_POST["id"]);
            $firstname = db_escape($_POST["firstname"]);
            $lastname = db_escape($_POST["lastname"]);
            $email = db_escape($_POST["email"]);
            $pseudo = db_escape($_POST["pseudo"]);
            $description = db_escape($_POST["description"]);
            $avatar = db_escape($_POST["avatar"]);

            $SQL = "UPDATE `users` SET `date_modification` = NOW(), `firstname` = '$firstname', `lastname` = '$lastname', `email` = '$email' WHERE `id` = '".$id."';";
                $result1 = db_execute($SQL);

            $SQL = "UPDATE `users_detail` SET `date_modification` = NOW(), `pseudo` = '$pseudo', `description` = '$description', `avatar` = '$avatar' WHERE `id_users` = '".$id."';";
                echo $SQL;
                $result2 = db_execute($SQL);

            if ($result1[0] && $result2[0]) {
                $rtn = true;
            } else {
                $rtn_txt = "Une erreur s'est produite lors de l'execution de la tache. Contacter le support.";
            }

            echo json_encode([$rtn, $rtn_txt]);
            break;
        case "sendMail":
            $rtn_txt = "";

            $id = db_escape($_POST["id"]);
            $email = db_escape($_POST["email"]);

            $token_email = uniqid('', true);

            $SQL = "INSERT INTO `users` (`date_modification`, `token_check_email`, `check_email`) VALUES (now(), '".$token_email."', '0');";
		        // $result = db_execute($SQL);

            $rtn = sendMail($_POST["email"], $token_email);

            echo json_encode([$rtn, $rtn_txt]);
            break;

    }
	exit;
}

if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {

    $error              = false;
    $extensions         = ['tif','pjp','xbm','jxl','svgz','jpg','jpeg','ico','tiff','gif','svg','jfif','webp','png','bmp','pjpeg','avif'];
    $maxSize            = 4000000;

    $temp               = explode("/", $_FILES["file"]["type"]);
    $extension          = strtolower(end($temp));
    $size               = $_FILES['file']['size'];

    if(!in_array($extension, $extensions)) {
        $errorName      = "Pas une image";
        $error          = true;
    } else if ($size >= $maxSize) {
        $errorName      = "Taille max d√©passer. 4Mo";
        $error          = true;
    }

    if ($error) {
        echo "Erreur lors du t√©l√©chargement. [".$errorName."] sur le fichier '".$_FILES["file"]["name"]."'.";
        return 0;
    }

    $temp           = explode(".", $_FILES["file"]["name"]);
    $uniqueName     = uniqid('', true);
    $newfilename    = $uniqueName .'.'. $extension;

    move_uploaded_file($_FILES['file']['tmp_name'], '../images/user/' . $newfilename);

    $SQL = "UPDATE `users_detail` SET `date_modification` = now(), `avatar` = '".$newfilename."' WHERE `id_users` = '".$_SESSION["id"]."';";
    $result = db_execute($SQL);
}

function saveFile($urlFile, $saveName, $saveLocation) {
    $_rtnError = false;

    $img_file = $urlFile;

    $img_file=file_get_contents($img_file);

    $file_loc = $_SERVER["DOCUMENT_ROOT"]."/".$saveLocation.$saveName;

    $file_handler=fopen($file_loc,'w');

    if(fwrite($file_handler,$img_file)==false){
        $_rtnError = 'Error : Files ['.$saveName.'] not saved.';
    }

    fclose($file_handler);

    return $_rtnError;
}

function listActors($data, $count) {
    $rtn = "";
    for($i = 0; $i < $count; $i++) {
        $rtn .= $data[$i]["name"];
    }
    return $rtn;
}

function discordApiPost($data, $credits, $insert_id) {
    $webhookurl = "https://discord.com/api/webhooks/965899077218865162/vkrLkjSgaBVF2ZryFcY0lp_fOuyTiFnBOCJlWGlP9MAMecRv6zzcUd9REjFtLl3pUlFS";

    $timestamp = date("c", strtotime("now"));

    $json_data = json_encode([
        "username" => "ūüćŅÔĹúRaisiX",
        "avatar_url" => "",
        "tts" => false,
        "content" => "",
        "embeds" => [
            [
            "type" => "rich",
            "title" => "**".$data["title"]."** - *".substr($data["release_date"], 0, 4)."*",
            "color" => hexdec( "b95504" ),
            "description" => "Film ajout√© par ūüźĽÔĹúLeGrizzly#0341",
            "timestamp" => $timestamp,
            "author" => [],
            "image" => [
                "url" => "https://raisix.fr/assets/images/movie-backdrop".$data["backdrop_path"]
            ],
            "thumbnail" => [
                "url" => "https://raisix.fr/assets/images/movie-poster".$data["poster_path"]
            ],
            "footer" => [
                "text" => "ūüćŅÔĹúRaisiX - V1.1",
                "icon_url" => ""
            ],
            "fields" => [
                [
                    "name" => "ūüé¨ÔĹúSynopsis",
                    "value" => "ūüüß ".substr($data["overview"], 0, 255)."...\n--------------------",
                    "inline" => false
                ],
                [
                    "name" => "ūü§łÔĹúActeurs",
                    "value" => "ūüüß ".listActors($credits["cast"], 4)."\n--------------------",
                    "inline" => false
                ],
                [
                    "name" => "ūüé¨ÔĹúVoir le Film",
                    "value" => "ūüüß __https://raisix.fr/movie-details.php?id=".$insert_id."__\n--------------------",
                    "inline" => false
                ]
            ]
            ]
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

    $headers = [ 'Content-Type: application/json; charset=utf-8' ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $webhookurl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    $response   = curl_exec($ch);
}

