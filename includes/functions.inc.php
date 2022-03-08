<?php
	//àéè
	defined('v1Secureraisix') or header('Location: /'); 

	function login($user) {
		$token = createToken();
		$_SESSION["token"] = $token;
		$_SESSION["id"] = $user["id"];
		$_SESSION["firstname"] = $user["firstname"];
		$_SESSION["lastname"] = $user["lastname"];
		$_SESSION["email"] = $user["email"];
		$_SESSION["role"] = $user["role"];

		$SQL = "UPDATE users SET 
				token= '".$token."'  
				WHERE id=".$user["id"]." 
				AND email='".$user["email"]."'";
		$result = db_execute($SQL);

		if(!empty($result)) {
			$_SESSION["auth"] = true;
			
			if (isset($_COOKIE["remember"]) && !empty($_COOKIE["remember"])) {
				$cookieOptions = array (
					'expires' => strtotime('+7 days'),
					'path' => '/',
					'domain' => $_SERVER["HTTP_HOST"]
				);
				setcookie("remember", $token, $cookieOptions);
			}
		}
	}
	
	function createToken() {
		$token = md5(uniqid()."jq2à,?".time());
		$token = substr($token, 0, rand(10,20));
		$token = str_shuffle($token);
		return $token;
	}
	
	function isConnected($redirect = false) {
		if(!empty($_SESSION["token"])
			&& !empty($_SESSION["email"])
			&& !empty($_SESSION["id"])) {
			$SQL = "SELECT `id`, `firstname`, `lastname`, `email`, `role` FROM users WHERE token='".$_SESSION["token"]."' AND id=".$_SESSION["id"]." AND email='".$_SESSION["email"]."';";
				$result = db_query($SQL);
	
			if(!empty($result[0])) {
				$user = ["id"=>$_SESSION["id"], "email"=>$_SESSION["email"], "role"=>$_SESSION["role"], "firstname"=>$_SESSION["firstname"], "lastname"=>$_SESSION["lastname"]];
				login($user);
				return true;
			}
		} else if (isset($_COOKIE["remember"]) && !empty($_COOKIE["remember"])) {
			$SQL = "SELECT `id`, `firstname`, `lastname`, `email`, `role` FROM users WHERE token='".$_COOKIE["remember"]."';";
				$result = db_query($SQL);
	
			if(!empty($result[0])) {
				$user = ["id"=>$result[0]["id"], "email"=>$result[0]["email"], "role"=>$result[0]["role"], "firstname"=>$result[0]["firstname"], "lastname"=>$result[0]["lastname"]];
				login($user);
				return true;
			}
		}

		if ($redirect) {
			session_destroy();
			header("Location: /login.php?url_redirect=".$_SERVER["REQUEST_URI"]);
		} else
			return;
	}