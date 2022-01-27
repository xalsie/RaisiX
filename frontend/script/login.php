<?php
include_once("../../includes/inc.php");

if (count($_POST) == 2 && !empty($_POST["email"]) && !empty($_POST["pwd"])) {
	$error = FALSE;
	$listOfErrors = [];
	$_POST["email"] = strtolower( trim($_POST["email"]) );

	$sql = "SELECT `id`, `firstname`, `lastname`, `email`, `password`, `role` FROM `users` WHERE `email` = '".db_escape($_POST["email"])."'";
	$result = db_query($sql);

	if (!empty($result[0])) {
		if (password_verify($_POST["pwd"], $result[0]["password"])) {
			$_SESSION["auth"]=true;
			$_SESSION["id"] = $result[0]["id"];
			$_SESSION["email"] = $_POST["email"];
			$_SESSION["firstname"] = $result[0]["firstname"];
			$_SESSION["lastname"] = $result[0]["lastname"];
			$_SESSION["idmd5"] = md5(trim($result[0]["id"].$result[0]["firstname"].$result[0]["lastname"].$_POST["email"]));
			$_SESSION["token"] = createToken($result[0]['id'], $_POST['email']);
			$_SESSION["role"] = $result[0]["role"];

			$user = ["id"=>$_SESSION["id"], "email"=>$_SESSION["email"], "firstname"=>$_SESSION["firstname"], "lastname"=>$_SESSION["lastname"], "role"=>$_SESSION["role"],];
			login($user);

			header("Location: ../index.php");
			// echo "Location: ../index.php";
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
		header("Location: ../login.php");
		// echo "Location: ../login.php";
	}
} else {
	header("Location: ../login.php");
	// echo "Location: ../login.php";
}