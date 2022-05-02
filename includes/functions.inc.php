<?php
	//àéè
	defined('v1Secureraisix') or header('Location: /');

	function login($user) {
		$token					= createToken();
		$id_device				= (!empty($_COOKIE["id_device"]))? $_COOKIE["id_device"]:createToken();
		$_SESSION["token"]		= $token;
		$_SESSION["id"]			= $user["id"];
		$_SESSION["firstname"]	= $user["firstname"];
		$_SESSION["lastname"]	= $user["lastname"];
		$_SESSION["email"]		= $user["email"];
		$_SESSION["role"]		= $user["role"];
		$resultDevice			= ["0" => ["_count" => 0]];

		if (!empty($_COOKIE["id_device"])) {
			$SQL = "SELECT COUNT(*) AS _count FROM `users_sign` WHERE id_device = '".$id_device."' AND id_users = '".$_SESSION["id"]."';";
				$resultDevice = db_query($SQL);
		}
		if ($resultDevice[0]["_count"]) {
			$SQL = "UPDATE `users_sign` AS us1 SET us1.`date_modification` = now(), us1.`token` = '".$token."' WHERE us1.`id_device` = '".$id_device."';";
				$result = db_execute($SQL);
		} else {
			$SQL = "SELECT count(*) AS _count FROM `users_sign` WHERE id_users = '".$_SESSION["id"]."';";
				$resultCount = db_query($SQL);

			if ($resultCount[0]["_count"] < 5) {
				$SQL = "INSERT INTO `users_sign` (`date_create`, `date_modification`, `id_users`, `id_device`, `token`) VALUES (now(), now(), '".$_SESSION["id"]."', '".$id_device."', '".$token."');";
					$result = db_execute($SQL);
			} else {
				$SQL = "UPDATE `users_sign` AS us1, (SELECT id FROM `users_sign` WHERE id_users = '".$_SESSION["id"]."' ORDER BY `date_modification` ASC LIMIT 1) AS us2 SET us1.`date_modification` = now(), us1.`id_device` = '".$id_device."', us1.`token` = '".$token."' WHERE us1.`id` = us2.id;";
					$result = db_execute($SQL);
			}
		}
		if(!empty($result)) {
			$_SESSION["auth"] = true;
			if (isset($_COOKIE["remember"]) && !empty($_COOKIE["remember"])) {
				setcookie("remember", $token, [
					'expires' => strtotime('+7 days'),
					'path' => '/',
					'domain' => 'raisix'
				]);
			}
			setcookie("id_device", $id_device, [
				'expires' => strtotime('+1 year'),
				'path' => '/',
				'domain' => 'raisix'
			]);
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
			&& !empty($_SESSION["id"])
			&& !empty($_COOKIE["id_device"])) {

			$SQL = "SELECT u.`id`, u.`firstname`, u.`lastname`, u.`email`, u.`role`, us.`token` FROM users AS u
				INNER JOIN `users_sign` AS us on us.id_users = u.id
				WHERE us.id_device = '".$_COOKIE['id_device']."' AND us.token = '".$_SESSION["token"]."';";
				$result = db_query($SQL);

			if(!empty($result[0])) {
				$user = ["id"=>$_SESSION["id"], "email"=>$_SESSION["email"], "role"=>$_SESSION["role"], "firstname"=>$_SESSION["firstname"], "lastname"=>$_SESSION["lastname"]];
				$_rtn  = login($user);
				return true;
			}
		} else if (isset($_COOKIE["remember"]) && !empty($_COOKIE["remember"]) && isset($_COOKIE["id_device"]) && !empty($_COOKIE["id_device"])) {
			$SQL = "SELECT u.`id`, u.`firstname`, u.`lastname`, u.`email`, u.`role` FROM users AS u
					INNER JOIN `users_sign` AS us on us.id_users = u.id
					WHERE us.id_device = '".$_COOKIE['id_device']."' AND us.token = '".$_COOKIE['remember']."';";
				$result = db_query($SQL);

			if(!empty($result[0])) {
				$user = ["id"=>$result[0]["id"], "email"=>$result[0]["email"], "role"=>$result[0]["role"], "firstname"=>$result[0]["firstname"], "lastname"=>$result[0]["lastname"]];
				$_rtn  = login($user);
				return true;
			}
		}

		if ($redirect) {
			session_destroy();
			header("Location: /login.php?url_redirect=".$_SERVER["REQUEST_URI"]);
		} else
			return;
	}