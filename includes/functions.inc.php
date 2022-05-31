<?php
	//àéè
	defined('v1Secureraisix') or header('Location: /');

	//Import PHPMailer classes into the global namespace
	//These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require $path.'/assets/PHPMailer/Exception.php';
	require $path.'/assets/PHPMailer/PHPMailer.php';
	require $path.'/assets/PHPMailer/SMTP.php';

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

	// verifniv(15,false,array(40));

	function verifniv($nivo=0, $breturn=false, $aPremium=false){
		$rep=($_SESSION["role"] >= $nivo);

		if ($aPremium!=false) {
			foreach ($aPremium as $value) {
				if ($_SESSION["payment_choise"]==$value) {
					$rep=true;
					break;
				}
			}
		}

		switch ($breturn){
			case true:
				return $rep;
				break;
			default:
				if ($rep){
					return;
				} else {
					header('Location: /');
				}
		}
	}

	function sendMail($email, $token_email, $aConfig) {
		//Create an instance; passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
			//Server settings
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;
			$mail->isSMTP();

			$mail->Host       = $aConfig['mail_host'];
			$mail->SMTPAuth   = true;
			$mail->Username   = $aConfig['mail_user'];
			$mail->Password   = $aConfig['mail_pwd'];

			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
			$mail->Port       = $aConfig['mail_port'];

			$mail->CharSet = "UTF-8";

			$mail->addCustomHeader('MIME-Version', '1.0');
			$mail->addCustomHeader('Content-type', 'text/html');

			//Recipients
			$mail->setFrom('contact@raisix.fr', 'RaisiX support');

			$mail->addAddress($email);

			//Content
			$mail->isHTML(true);
			$mail->Subject = "RaisiX : Confirmé l'adresse mail";
			$mail->Body    = "<!DOCTYPE html><html> <head> <title>RaisiX : Confirmé l'adresse mail</title> <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/> <meta name='viewport' content='width=device-width, initial-scale=1'> <meta http-equiv='X-UA-Compatible' content='IE=edge'/> <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap'/> <style type='text/css'>a[x-apple-data-detectors]{color:inherit!important;text-decoration:none!important;font-size:inherit!important;font-family:inherit!important;font-weight:inherit!important;line-height:inherit!important}@media screen and (max-width:600px){h1{font-size:32px!important;line-height:32px!important}}div[style*='margin: 16px 0;']{margin:0!important}</style> <script async='' src='https://www.googletagmanager.com/gtag/js?id=G-K01N3EFBW2'></script> <script>window.dataLayer=window.dataLayer || []; function gtag(){dataLayer.push(arguments);}gtag('js', new Date()); gtag('config', 'G-K01N3EFBW2'); </script> </head> <body style='background-color: #000; margin: 0 !important; padding: 0 !important;font-family: 'Roboto'; font-weight: 400; font-style: normal; font-size: 16px; line-height: 1.5; padding: 0; margin: 0; height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;'> <table border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse !important;'> <tbody style='position: relative; background: url(https://raisix.fr/assets/images/login/login_wp.jpg) no-repeat scroll 0 0; background-size: cover;'> <tr> <td align='center' style='padding: 0px 10px 0px 10px;mso-table-lspace: 0pt; mso-table-rspace: 0pt;'> <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px; margin-top: 80px;'> <tr> <td align='center' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #ffffff; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;background: #0009; -webkit-backdrop-filter: blur(5px); backdrop-filter: blur(5px); box-shadow: 0px 0 20px 0 rgb(0 0 0 / 50%); -webkit-box-shadow: 0px 0 20px 0 rgb(0 0 0 / 50%); -moz-box-shadow: 0px 0 20px 0 rgba(0, 0, 0, 0.5);mso-table-lspace: 0pt; mso-table-rspace: 0pt;'> <h1 style='font-size: 48px; font-weight: 400; margin: 2;'>Bienvenue !</h1> <img src='https://raisix.fr/assets/images/logo.png' width='300' style='display: block; border: 0px;margin-left: -45px;-ms-interpolation-mode: bicubic; border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;'/> </td></tr></table> </td></tr><tr> <td align='center' style='padding: 0px 10px 0px 10px;mso-table-lspace: 0pt; mso-table-rspace: 0pt;'> <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'> <tr> <td align='left' style='padding: 20px 30px 40px 30px; color: #797979; font-size: 18px; font-weight: 400; line-height: 25px;background: #0009; -webkit-backdrop-filter: blur(5px); backdrop-filter: blur(5px); box-shadow: 0px 0 20px 0 rgb(0 0 0 / 50%); -webkit-box-shadow: 0px 0 20px 0 rgb(0 0 0 / 50%); -moz-box-shadow: 0px 0 20px 0 rgba(0, 0, 0, 0.5);mso-table-lspace: 0pt; mso-table-rspace: 0pt;'> <p style='margin: 0;'>Nous sommes impatients de vous voir commencer. Tout d'abord, vous devez confirmer votre compte. Appuyez simplement sur le bouton ci-dessous.</p></td></tr><tr> <td align='left' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'> <table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr> <td align='center' style='padding: 20px 30px 60px 30px;background: #0009; -webkit-backdrop-filter: blur(5px); backdrop-filter: blur(5px); box-shadow: 0px 0 20px 0 rgb(0 0 0 / 50%); -webkit-box-shadow: 0px 0 20px 0 rgb(0 0 0 / 50%); -moz-box-shadow: 0px 0 20px 0 rgba(0, 0, 0, 0.5);mso-table-lspace: 0pt; mso-table-rspace: 0pt;'> <table border='0' cellspacing='0' cellpadding='0'> <tr> <td align='center' style='border-radius: 3px;mso-table-lspace: 0pt; mso-table-rspace: 0pt;'><a href='https://raisix.fr/verif_mail?uuid=".$token_email."&email=".$_POST['email']."' target='_blank' style='font-size: 20px; color: #ffffff; text-decoration: none; text-decoration: none; padding: 15px 25px; border-radius: 2px; display: inline-block;background-image: linear-gradient(to right,#aa1938 0,#f76e14 100%);-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;'>Confirmer le compte</a></td></tr></table> </td></tr></table> </td></tr><tr> <td align='left' style='padding: 0px 30px 0px 30px; color: #797979; font-size: 18px; font-weight: 400; line-height: 25px;background: #0009; -webkit-backdrop-filter: blur(5px); backdrop-filter: blur(5px); box-shadow: 0px 0 20px 0 rgb(0 0 0 / 50%); -webkit-box-shadow: 0px 0 20px 0 rgb(0 0 0 / 50%); -moz-box-shadow: 0px 0 20px 0 rgba(0, 0, 0, 0.5);mso-table-lspace: 0pt; mso-table-rspace: 0pt;'> <p style='margin: 0;'>Si cela ne fonctionne pas, copiez et collez le lien suivant dans votre navigateur :</p></td></tr><tr> <td align='left' style='padding: 20px 30px 20px 30px; color: #797979; font-size: 18px; font-weight: 400; line-height: 25px;background: #0009; -webkit-backdrop-filter: blur(5px); backdrop-filter: blur(5px); box-shadow: 0px 0 20px 0 rgb(0 0 0 / 50%); -webkit-box-shadow: 0px 0 20px 0 rgb(0 0 0 / 50%); -moz-box-shadow: 0px 0 20px 0 rgba(0, 0, 0, 0.5);mso-table-lspace: 0pt; mso-table-rspace: 0pt;'> <p style='margin: 0;'><a href='#' target='_blank' style='color: #1746e0;-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;'>https://raisix.fr/verif_mail?uuid=".$token_email."&email=".$_POST['email']."</a></p></td></tr><tr> <td align='left' style='padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #797979; font-size: 18px; font-weight: 400; line-height: 25px;background: #0009; -webkit-backdrop-filter: blur(5px); backdrop-filter: blur(5px); box-shadow: 0px 0 20px 0 rgb(0 0 0 / 50%); -webkit-box-shadow: 0px 0 20px 0 rgb(0 0 0 / 50%); -moz-box-shadow: 0px 0 20px 0 rgba(0, 0, 0, 0.5);mso-table-lspace: 0pt; mso-table-rspace: 0pt;'> <p style='margin: 0;'>Cordialement,<br>Team RaisiX</p></td></tr></table> </td></tr><tr> <td align='center' style='padding: 0px 30px 30px 30px; color: #797979; font-size: 14px; font-weight: 400; line-height: 18px;mso-table-lspace: 0pt; mso-table-rspace: 0pt;'> <br><p style='margin: 0;'>Si ces courriels deviennent ennuyeux, n'hésitez pas à <a href='https://raisix.fr?unsubscribe' target='_blank' style='color: #a5a5a5; font-weight: 700;-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;'>se désabonner</a>.</p></td></tr></tbody> </table> </body></html>";

			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}