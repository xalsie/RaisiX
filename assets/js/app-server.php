<?php
include_once("../../includes/inc.php");

if (!isConnected())
   die("Vous etes deconnecté.");

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
            $SQL = "SELECT u.id, u.firstname, u.lastname, u.email, ud.avatar, ud.langue, ud.date_naissance, ud.description FROM users AS u LEFT JOIN users_detail AS ud ON u.id = ud.id_users WHERE u.id = ".$_SESSION["id"]." AND u.token = '".$_SESSION["token"]."';";
            $result = db_query($SQL);

			echo json_encode($result);
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
        case "getDatas":
            $SQL = "SELECT id, date_create, title, backdrop_path, poster_path  FROM `movie_detail` WHERE date_create > date_sub(now(), interval 1 week) ORDER BY date_create DESC LIMIT 15;";
                $result["notification"] = [];
                $result["notification"]["datas"] = db_query($SQL);

            if (!$result["notification"]["datas"]) {
                $result["notification"]["datas"] = [];
                $result["notification"]["_count"] = 0;
            } else
                $result["notification"]["_count"] = count($result["notification"]["datas"]);


            $SQL = "SELECT * FROM `movie_detail` WHERE date_create > date_sub(now(), interval 1 week) ORDER BY date_create DESC LIMIT 6;";
                $result["slider"] = [];
                $result["slider"]["datas"] = db_query($SQL);

			if (!$result["slider"]["datas"]) {
                $result["slider"]["datas"] = [];
                $result["slider"]["_count"] = 0;
            } else
                $result["slider"]["_count"] = count($result["slider"]["datas"]);
        
            echo json_encode($result);
            break;
        case "saveMovie":
            $data     = $_POST["data"];
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
			$result = db_execute($SQL);

            if (!empty($poster)) {
                $savePicture["poster"] = saveFile('https://image.tmdb.org/t/p/original'.$poster, $poster, 'assets/images/movie-poster');
            }

            if (!empty($backdrop)) {
                $savePicture["backdrop"] = saveFile('https://image.tmdb.org/t/p/original'.$backdrop, $backdrop, 'assets/images/movie-backdrop');
            }

            print_r([$result, $savePicture]);
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
            $SQL = "SELECT * FROM `movie_detail` WHERE id = '".db_escape($_POST['uuid'])."';";
                $result = db_query($SQL);

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
        $errorName      = "Taille max dépasser. 4Mo";
        $error          = true;
    }

    if ($error) {
        echo "Erreur lors du téléchargement. [".$errorName."] sur le fichier '".$_FILES["file"]["name"]."'.";
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