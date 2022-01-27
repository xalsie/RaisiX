<?php
include_once("../../../includes/inc.php");

if (!isConnected())
   die("Vous etes deconnecté.");

// Getting posted data and decodeing json
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

    print_r($_FILES);

    if ($error) {
        echo "Erreur lors du téléchargement. [".$errorName."] sur le fichier '".$_FILES["file"]["name"]."'.";
        return 0;
    }

    $temp           = explode(".", $_FILES["file"]["name"]);
    $uniqueName     = uniqid('', true);
    $newfilename    = $uniqueName .'.'. $extension;

    move_uploaded_file($_FILES['file']['tmp_name'], '../images/user/' . $newfilename);

    $SQL = "UPDATE `users_detail` SET `date_modification` = now(), `avatar` = '".$newfilename."' WHERE `id_users` = '".$_SESSION["id"]."';";
    echo $SQL;
    $result = db_execute($SQL);
}