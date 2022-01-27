<?php
defined('v1Secureutd') or header('Location: /');

ini_set("session.gc_maxlifetime",36000);
if (@$PHP_Self!=true) session_start();
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: text/html; charset=utf-8');

date_default_timezone_set('Europe/Paris');

$niv = @$_SESSION["niv"];
$ident = @$_SESSION['user'];
if ($ident =="" && @$PHP_Self!=true){
	header("Location:/login.php");
	exit;
}  

if (empty(@$_SERVER["DOCUMENT_ROOT"])) {
	$path = "/var/www/html/SiteChrono";
} else {
	$path = $_SERVER["DOCUMENT_ROOT"];
}

include_once($path."/includes/config.inc.php");

if (!function_exists('WriteToLog')) {
	function WriteToLog($sLog) {
		if (is_array($sLog)) {
			$sLog=var_export($sLog,true);
			$sLog=trim(preg_replace('/\s+/', ' ', $sLog));
			$sLog=str_replace(", )"," )",$sLog);
		}
		$toLog=strftime("%d/%m/%Y %H:%M:%S")." - ".@$_SESSION['user']." (".$_SERVER['REMOTE_ADDR'].") - ".str_replace("http://chrono.prolival.fr/","",@$_SERVER['HTTP_REFERER'])." -> ".str_replace($_SERVER["DOCUMENT_ROOT"]."/","",$_SERVER['SCRIPT_FILENAME'])." : ".$sLog."\n";
		file_put_contents($_SERVER["DOCUMENT_ROOT"]."/logs/posts.log",$toLog,FILE_APPEND);
	}
}

if (@$_SERVER['REQUEST_METHOD'] === 'POST' and @$_POST["action"]<>"getlist" and @$_POST["action"]<>"getincid") {
	WriteToLog($_POST);
}

?>