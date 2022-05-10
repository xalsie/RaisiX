<?php
include_once("../includes/inc.php");
defined('v1Secureraisix') or header('Location: /');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    http_response_code(401);
    echo "Not unauthorized for GET request.";
    return;
}

// Getting posted data and decodeing json
if(empty($_POST))
	$_POST = json_decode(file_get_contents('php://input'), true);

if ((count($_POST) == 3 || count($_POST) == 4) && !empty($_POST["email"]) && !empty($_POST["pwd"]) && !empty($_POST["captcha"])) {
	$error = FALSE;
	$keyError = FALSE;
	$_POST["email"] = strtolower(trim($_POST["email"]));

	if (strtolower(trim($_POST["captcha"])) !== strtolower(trim($_SESSION["captcha"]))) {
		$error = TRUE;
		$keyError = 12;
		echo json_encode([false, $listOfErrors[$keyError], $_POST]);
		exit;
	}

	$SQL = "SELECT `id`, `firstname`, `lastname`, `email`, `password`, `role`, `auth_fa`, `auth_fa_token` FROM `users` WHERE `email` = '".db_escape($_POST["email"])."' LIMIT 1;";
		$result = db_query($SQL);

	if (!empty($result[0])) {
		if (password_verify($_POST["pwd"], $result[0]["password"])) {
			$_SESSION["auth"]		= true;
			$_SESSION["id"]			= $result[0]["id"];
			$_SESSION["email"]		= $_POST["email"];
			$_SESSION["firstname"]	= $result[0]["firstname"];
			$_SESSION["lastname"]	= $result[0]["lastname"];
			$_SESSION["idmd5"]		= md5(trim($result[0]["id"].$result[0]["firstname"].$result[0]["lastname"].$_POST["email"]));
			$_SESSION["token"]		= createToken();
			$_SESSION["role"]		= $result[0]["role"];

			if (isset($_POST["remember_me"]) && $_POST["remember_me"] == "on") {
				setcookie("remember", $_SESSION["token"], [
					'expires' => strtotime('+7 days'),
					'path' => '/',
					'domain' => 'raisix'
				]);
			}

			$user = ["id"=>$_SESSION["id"], "email"=>$_SESSION["email"], "firstname"=>$_SESSION["firstname"], "lastname"=>$_SESSION["lastname"], "role"=>$_SESSION["role"]];

			// $referer = explode("url_redirect=", $_SERVER["HTTP_REFERER"])[1];

			if ($result[0]["auth_fa"] == "1") {
				$_SESSION["user"] = $user;
				$_SESSION["2FA_token"] = $result[0]["auth_fa_token"];
				echo json_encode(["2FA", ""]);
			} else {
				login($user);
				echo json_encode([true, ""]);
			}
		} else {
			$error = TRUE;
			$keyError = 11;
		}
	} else {
		$error = TRUE;
		$keyError = 11;
	}
} else {
	$error = TRUE;
	$keyError = 11;
}

if ($error) {
	echo json_encode([false, $listOfErrors[$keyError], $_POST]);
}