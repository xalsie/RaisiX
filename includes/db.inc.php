<?php
	//àéè
	defined('v1Secureraisix') or header('Location: /');

function db_connect() {
	global $db_link;
	global $aConfig;
	
	$db_link = mysqli_connect($aConfig['db_host'], $aConfig['db_user'], $aConfig['db_password']);
	if (!is_object($db_link)) {
		return mysqli_connect_error($db_link);
	}
	
	mysqli_set_charset($db_link,'utf8');
	
	if (!mysqli_select_db($db_link, $aConfig['db_name'])) {
		return false;
		exit;
	}
	// echo "connect";
	return true;
}

function db_disconnect() {
	global $db_link;

	if (!is_object($db_link)) return True;
	
	mysqli_close($db_link);
	// echo "disconnect";

}

function db_query($sql) {
	global $db_link;
	
	if (!is_object($db_link)) {
		$rep=db_connect();
		if (!is_object($db_link)) return false;
	}
	
	// if (!IsQuerySelect($sql)) WriteToLog("db_query:".$sql);
	// echo $db_link." - ".$sql."\n";
	$db_result = mysqli_query($db_link, $sql);
	if (!$db_result) {
		return false;
	}
	
	$new_array=false;
	while($row = mysqli_fetch_assoc($db_result)){
		$new_array[] = $row;
	}
	mysqli_free_result($db_result);
	
	return $new_array;
}

function db_multi_query($sql) {
	global $db_link;
	$new_array=false;
	
	if (!is_object($db_link)) {
		$rep=db_connect();
		if (!is_object($db_link)) return false;
	}
	
	// if (!IsQuerySelect($sql)) WriteToLog("db_multi_query:".$sql);
	if (mysqli_multi_query($db_link, $sql)) {
		do {
			if ($result = mysqli_store_result($db_link)) {
				while ($row = mysqli_fetch_assoc($result)) {
					$new_array[] = $row;
				}
				mysqli_free_result($result);
			}
		} while (mysqli_next_result($db_link));
	}
	
	return $new_array;
}

function db_execute($sql) {
	global $db_link;
	
	if (!is_object($db_link)) {
		$rep=db_connect();
		if (!is_object($db_link)) return array(false, mysqli_error($db_link));
	}
	
	// if (!IsQuerySelect($sql)) WriteToLog("db_execute:".$sql);
	
	// echo $db_link." - ".$sql."\n";
	$db_result = mysqli_query($db_link, $sql);
	if (!$db_result) {
		return array(false, mysqli_error($db_link));
	}
	return array(true, "");
}

function db_multiExec($sql) {
	global $db_link;
	
	if (!is_object($db_link)) {
		$rep=db_connect();
		if (!is_object($db_link)) return false;
	}
	
	// if (!IsQuerySelect($sql)) WriteToLog("db_multiExec:".$sql);
	// echo $db_link." - ".$sql."\n";
	$db_result = mysqli_multi_query($db_link, $sql);
	
	if(mysqli_errno($db_link) != 0)
	{
		return '<strong>'.mysqli_errno($db_link).' :</strong>'.mysqli_error($db_link);
	}
	
	return 'anyerorr';
}

function db_escape($value) {
	global $db_link;
	if (!is_object($db_link)) {
		$rep=db_connect();
		if (!is_object($db_link)) return false;
	}
	
	// return utf8_encode(mysqli_real_escape_string($db_link, $value));
	return mysqli_real_escape_string($db_link, $value);
}

function db_info() {
	global $db_link;
	if (!is_object($db_link)) {
		$rep=db_connect();
		if (!is_object($db_link)) return false;
	}
	echo mysqli_get_client_info($db_link);echo '<br/>';
	echo mysqli_get_server_info($db_link);
}
