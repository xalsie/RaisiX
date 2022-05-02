<?php
include_once("../includes/inc.php");
defined('v1Secureraisix') or header('Location: /');


if ((count($_POST) == 3 || count($_POST) == 4) && !empty($_POST["email"]) && !empty($_POST["pwd"]) && !empty($_POST["captcha"])) {
	$error = FALSE;
	$listOfErrors = [];
	$_POST["email"] = strtolower(trim($_POST["email"]));

	if (strtolower(trim($_POST["captcha"])) !== strtolower(trim($_SESSION["captcha"]))) {
		$error = TRUE;
		$listOfErrors[]=12;
		$_SESSION["errorsForm"] = $listOfErrors;
		$_SESSION["postForm"] = $_POST;
		header("Location: /login.php");
		exit;
	}

	$SQL = "SELECT `id`, `firstname`, `lastname`, `email`, `password`, `role` FROM `users` WHERE `email` = '".db_escape($_POST["email"])."';";
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

			if (isset($_POST["customCheck"]) && $_POST["customCheck"] == "on") {
				setcookie("remember", $_SESSION["token"], [
					'expires' => strtotime('+7 days'),
					'path' => '/',
					'domain' => 'raisix'
				]);
			}

			$user = ["id"=>$_SESSION["id"], "email"=>$_SESSION["email"], "firstname"=>$_SESSION["firstname"], "lastname"=>$_SESSION["lastname"], "role"=>$_SESSION["role"]];
			login($user);

			$referer = explode("url_redirect=", $_SERVER["HTTP_REFERER"])[1];

			if (!empty($referer))
				header("Location: $referer");
			else
				header("Location: /index.php");
		} else {
			$error = TRUE;
			$listOfErrors[]=11;
		}
	} else {
		$error = TRUE;
		$listOfErrors[]=11;
	}
	if ($error) {
		$_SESSION["errorsForm"] = $listOfErrors;
		$_SESSION["postForm"] = $_POST;
		header("Location: /login.php");
	}
} else {
	header("Location: /login.php");
}