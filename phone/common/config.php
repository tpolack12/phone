<?php
//APP configs
$templates='templates/';



//VOIP Database
$dbserver='10.40.6.21';
$dbuser='tpolack';
$dbpass='Temp1234';
$db='voip';

$link = new mysqli($dbserver, $dbuser, $dbpass, $db);

if ($link->connect_errno) {
    echo "<pre>";
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . $link->connect_errno . PHP_EOL;
    echo "Debugging error: " . $link->connect_error . PHP_EOL;
    echo "</>";
    exit;
}

?>
