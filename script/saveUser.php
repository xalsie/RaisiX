<?php
include_once("../includes/inc.php");

//doit avoir 6 champs
//vérifier que les champs: firstname, lastname, ... (et certain non vide)
	if (count($_POST) == 6
		&& !empty($_POST["firstname"])
		&& !empty($_POST["lastname"]) 
		&& !empty($_POST["email"]) 
		&& !empty($_POST["pwd"]) 
		&& !empty($_POST["pwdConfirm"]) 
		&& !empty($_POST["cgu"])
	) {
		$error = FALSE;
		$listOfErrors = [];
		//Nettoyage des chaines 
		$_POST["firstname"] = ucfirst( strtolower( trim($_POST["firstname"]) ) );
		$_POST["lastname"] = strtoupper( trim($_POST["lastname"]) );
		$_POST["email"] = strtolower( trim($_POST["email"]) );
		//vérifier les champs un par un

			//firstname : min 2, max : 25
		if( strlen($_POST["firstname"]) < 2 || strlen($_POST["firstname"])> 25 ) {
			$error = TRUE;
			$listOfErrors[]=1;
		}
			//lastname: min 2, max : 125
		if( strlen($_POST["lastname"]) <2 || strlen($_POST["lastname"]) > 125 ) {
			$error = TRUE;
			$listOfErrors[]=2;
		}
			//email : format valid
		if( !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) ) {
			$error = TRUE;
			$listOfErrors[]=3;
		}

			//pwd : min 8, max : 25
		if( strlen($_POST["pwd"]) < 8 || strlen($_POST["pwd"]) > 25 ) {
			$error = TRUE;
			$listOfErrors[]=7;
		}

			// -> majuscules, minuscules et chiffres
		if( !preg_match("#[a-z]#", $_POST["pwd"])
			|| !preg_match("#[0-9]#", $_POST["pwd"])
			|| !preg_match("#[A-Z]#", $_POST["pwd"]) ) {
			$error = TRUE;
			$listOfErrors[]=10;
		}

			//pwdConfirm == pwd
		if( $_POST["pwd"] != $_POST["pwdConfirm"] ) {
			$error = TRUE;
			$listOfErrors[]=8;
		}
			//cgu: pas besoins de la tester car si pas cochee pas de variable
		
		if ($error) {
			// redirection (signup.php) avec les erreurs
			//echo "error";
			$_SESSION["errorsForm"] = $listOfErrors;
			$_SESSION["postForm"] = $_POST;
			header("Location: /sign-up.php");
		} else {

			$token_email = uniqid('', true);

			// send mail to verif
			// raisix:83/verif_mail?uuid=$token_email&email=$_POST["email"]
			
			$sql = "INSERT INTO `users` (`date_create`, `date_modification`, `firstname`, `lastname`, `email`, `token_check_email`, `password`, `date_modification_pw`, `tac`)
				VALUES (now(), now(), '".db_escape($_POST["firstname"])."', '".db_escape($_POST["lastname"])."', '".db_escape($_POST["email"])."', '".$token_email."', '".password_hash($_POST["pwd"], PASSWORD_BCRYPT)."', now(), '1');";
			$result = db_execute($sql);

			
		}
	} else {
		header("Location: /login.php");
		// die("HACK !!!!!");
	}
