<?php 
include_once("../includes/inc.php");

// if (!isConnected())
//     die("Vous etes deconnecté.");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    http_response_code(401);
    echo "Not unauthorized for GET request.";
    return;
}

// Getting posted data and decodeing json
if(empty($_POST))
    $_POST = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
	switch ($_POST['action']){
		case "toPairing":
            echo GetAuthPairing2fa();
        break;
        case "toValidate":
            $GetAuthValidation = GetAuthValidation2fa($_POST["code"]);

            if ($_POST["param"] == "toAddBdd" && strtolower($GetAuthValidation[0]) == "true") {
                $SQL = "UPDATE users SET date_modification = NOW(), auth_fa = 1, auth_fa_token = '".$_SESSION["2FA_token"]."' WHERE id = ".$_SESSION["id"]." AND email = '".$_SESSION["email"]."';";
                    $result = db_execute($SQL);
            }
            if ($_POST["param"] == "toLogin" && strtolower($GetAuthValidation[0]) == "true") {
                login($_SESSION["user"]);
                $_SESSION["user"] = "";
				$_SESSION["2FA_token"] = "";
            }

            echo $GetAuthValidation;
        break;
        case "toDisable":
            echo toDisable($_POST["pwd"], $listOfErrors);
        break;
    }
	exit;
}

function GetAuthPairing2fa() {
    $token = md5(uniqid()."RaisiX".time());
    $token = substr($token, 0, 20);
    $token = str_shuffle($token);

    $_SESSION["2FA_token"] = $token;

    $_rtn = false;

    $ch = curl_init();
	try {
        $URL = "https://www.authenticatorApi.com/pair.aspx?AppName=RaisiX&AppInfo=".$_SESSION['email']."&SecretCode=$token";
        $headers = [ 'Cache-Control: no-cache', 'Content-Type: text/html; charset=utf-8' ];

		curl_setopt($ch, CURLOPT_URL, $URL);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);         
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
		$response = curl_exec($ch);
		
	    if (curl_errno($ch)) {
			echo curl_error($ch);
			die();
		}
		
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($http_code == intval(200)) {
			$_rtn = $response;
		}
		else{
			$_rtn = "Ressource introuvable : " . $http_code;
		}
	} catch (\Throwable $th) {
		throw $th;
	} finally {
		curl_close($ch);
	}

    return $_rtn;
}

function GetAuthValidation2fa($code, $secretCode = false) {
    $_rtn = false;

    $ch = curl_init();
	try {

        $URL = "https://authenticatorapi.com/api.asmx/ValidatePin";

        $token = $_SESSION["2FA_token"];

        $headers = [ 'Cache-Control: no-cache', 'Content-Type: application/x-www-form-urlencoded', 'Accept: application/xml' ];

		curl_setopt($ch, CURLOPT_URL, $URL);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, "pin=$code&secretCode=$token");
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$response = curl_exec($ch);

	    if (curl_errno($ch)) {
			return curl_error($ch);
			die();
		}

		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($http_code == intval(200)) {
            $xml = simplexml_load_string($response);
			
            $_rtn = $xml[0];
		}
		else{
			$_rtn = "Ressource introuvable : " . $http_code;
		}
	} catch (\Throwable $th) {
		throw $th;
	} finally {
		curl_close($ch);
	}

    return $_rtn;
}

function toDisable($pwd, $listOfErrors) {
    $error = FALSE;
    $codeErrors = [];
    if ((count($_POST) == 3) && !empty($pwd)) {
        $SQL = "SELECT u.`id`, u.`password` FROM `users` AS u
                JOIN users_sign AS us
                ON u.id = us.id_users
                WHERE u.`email` = '".db_escape($_SESSION["email"])."' AND u.`id` = ".$_SESSION["id"]." AND us.id_device = '".$_COOKIE["id_device"]."' AND us.token = '".$_SESSION[$_COOKIE["id_device"]]["token"]."';";

            $result = db_query($SQL);
        if (password_verify($pwd, $result[0]["password"])) {
            $SQL = "UPDATE users SET date_modification = NOW(), auth_fa = 0 WHERE id = ".$_SESSION["id"]." AND email = '".$_SESSION["email"]."';";
                $result = db_execute($SQL);
            return json_encode(true);
        } else {
            $error = TRUE;
            $codeErrors = 11;
        }
    } else {
        $error = TRUE;
        $codeErrors = 11;
    }
    
    return json_encode([false, $listOfErrors[$codeErrors]]);
}
