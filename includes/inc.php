<?php
	//àéè
	// A inclure dans les fichiers php :
	// 	defined('v1SecureForeCaster') or header('Location: /');
	//  include_once("/var/www/html/SiteChrono/includes/inc.php");
	define('v1Secureraisix',"WEB");
	
	if (empty(@$_SERVER["DOCUMENT_ROOT"]) || @$_SERVER["DOCUMENT_ROOT"] == "C:/wamp64/www") {
		$path = "C:/wamp64/www/raisix/";
	} else {
		$path = $_SERVER["DOCUMENT_ROOT"];
	}

	// include_once($path."/db_connect/Connect.php");
	include_once($path."/includes/config.inc.php");
	$aConfig['db_host']=$dbhost;
	$aConfig['db_user']=$dbuser;
	$aConfig['db_password']=$dbpassword;
	$aConfig['db_name']=$database;

	session_start();
	
	include_once($path."/includes/db.inc.php");
	include_once($path."/includes/functions.inc.php");
	
	include_once($path."/includes/header.inc.php");

	$listOfErrors=[
		1=>"Le prénom doit faire plus de 2 caractères",
		2=>"Le nom doit faire plus de 2 caractères",
		3=>"L'email n'est pas valide",
		4=>"Le format de la date d'anniversaire n'est pas correct",
		5=>"La date d'anniversaire n'existe pas",
		6=>"Vous devez avoir entre 18 et 100 ans",
		7=>"Le mot de passe doit faire entre 8 et 20 caractères",
		8=>"Le mot de passe de confirmation ne correspond pas",
		9=>"L'email existe déjà",
		10=>"Le mot de passe doit avoir des minuscules, des majuscules et des chiffres",
		11=>"Identifiants incorrects."
	];

	//Verification du niveau et modif si besoin
	// $result = db_query("SELECT Niv FROM login WHERE Ident='".$ident."'");
	// $_SESSION["niv"]=$result[0]["Niv"];
	// $niv=$result[0]["Niv"];
?>