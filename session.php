<?php
include_once("includes/inc.php");

if (!isConnected())
    die("Vous etes deconnect√©.");

echo "<pre>";
print_r($_SESSION);
echo "</pre>";