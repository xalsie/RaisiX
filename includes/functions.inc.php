<?php
	//àéè
	defined('v1Secureraisix') or header('Location: /');

	function login($user) {
		$token							= createToken();
		$id_device						= (!empty($_COOKIE["id_device"]))? $_COOKIE["id_device"]:createToken();
		$_SESSION[$id_device]["token"]	= $token;
		$_SESSION["id"]					= $user["id"];
		$_SESSION["firstname"]			= $user["firstname"];
		$_SESSION["lastname"]			= $user["lastname"];
		$_SESSION["email"]				= $user["email"];
		$_SESSION["role"]				= $user["role"];
		$_SESSION["payment_choise"]		= $user["payment_choise"];
		$resultDevice					= ["0" => ["_count" => 0]];

		if (!empty($_COOKIE["id_device"])) {
			$SQL = "SELECT COUNT(*) AS _count FROM `users_sign` WHERE id_device = '".$id_device."' AND id_users = '".$_SESSION["id"]."';";
				$resultDevice = db_query($SQL);
		}
		if ($resultDevice[0]["_count"]) {
			$SQL = "UPDATE `users_sign` SET `date_modification` = now(), `token` = '".$token."' WHERE `id_users` = ".$_SESSION["id"]." AND `id_device` = '".$id_device."';";
				$result = db_execute($SQL);
		} else {
			$SQL = "SELECT count(*) AS _count FROM `users_sign` WHERE id_users = '".$_SESSION["id"]."';";
				$resultCount = db_query($SQL);

			$limitDevice = 1;
			switch ($_SESSION["payment_choise"]) {
				case '1':
					$limitDevice = 2;
					break;
				case '2':
					$limitDevice = 3;
					break;
				case '3':
					$limitDevice = 5;
					break;
			}

			if ($resultCount[0]["_count"] < $limitDevice) {
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
					'domain' => $_SERVER["SERVER_NAME"]
				]);
			}
			setcookie("id_device", $id_device, [
				'expires' => strtotime('+1 year'),
				'path' => '/',
				'domain' => $_SERVER["SERVER_NAME"]
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
		$id_device = (!empty($_COOKIE["id_device"]))? $_COOKIE["id_device"]:"";

		if(!empty($_SESSION[$id_device]["token"])
			&& !empty($_SESSION["email"])
			&& !empty($_SESSION["id"])
			&& !empty($_COOKIE["id_device"])) {

			$SQL = "SELECT u.`id`, u.`firstname`, u.`lastname`, u.`email`, u.`role`, us.`token`, ud.`payment_choise` FROM users AS u
				JOIN `users_detail` AS ud on ud.id_users = u.id
				JOIN `users_sign` AS us on us.id_users = u.id
				WHERE us.id_device = '".$_COOKIE['id_device']."' AND us.token = '".$_SESSION[$id_device]["token"]."';";
				$result = db_query($SQL);

			if(!empty($result[0])) {
				$user = ["id"=>$_SESSION["id"], "email"=>$_SESSION["email"], "role"=>$_SESSION["role"], "payment_choise"=>$result[0]["payment_choise"], "firstname"=>$_SESSION["firstname"], "lastname"=>$_SESSION["lastname"]];
				$_rtn  = login($user);
				return true;
			}
		} else if (isset($_COOKIE["remember"]) && !empty($_COOKIE["remember"]) && isset($_COOKIE["id_device"]) && !empty($_COOKIE["id_device"])) {
			$SQL = "SELECT u.`id`, u.`firstname`, u.`lastname`, u.`email`, u.`role`, ud.`payment_choise` FROM users AS u
					JOIN `users_detail` AS ud on ud.id_users = u.id
					JOIN `users_sign` AS us on us.id_users = u.id
					WHERE us.id_device = '".$_COOKIE['id_device']."' AND us.token = '".$_COOKIE['remember']."';";
				$result = db_query($SQL);

			if(!empty($result[0])) {
				$user = ["id"=>$result[0]["id"], "email"=>$result[0]["email"], "role"=>$result[0]["role"], "payment_choise"=>$result[0]["payment_choise"], "firstname"=>$result[0]["firstname"], "lastname"=>$result[0]["lastname"]];
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