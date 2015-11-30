#!/usr/bin/php
<?php
require('../../common/config.php');

$server="";
$username="tpolack";
$password="Temp1234";
$database="voip";

$infile=$argv[1];

//$con = new mysqli($dbserver,$dbuser,$dbpass,$db);
if (!$link) {
        die('Connection Failed: ' . $link->connect_error);
}
else
{
if(is_file($infile))
  {
        $fhandle=fopen($infile, 'r');

        while(!feof($fhandle))
        {
                $line = fgets($fhandle, 8192);    
		$parts=preg_split("/\t/", $line);
		preg_replace("/'/", "", $parts);
		$Query ="insert into Stations(Station_ID, Station_Name, Phone_Num, Caller_ID, DisconnectTime, Status, AddDate, ChangeDate, LastLoginDate) Values('{$parts[0]}','{$parts[1]}','{$parts[2]}','{$parts[3]}','{$parts[4]}','{$parts[5]}','{$parts[6]}','{$parts[7]}','{$parts[8]}')";
        	
		if ( ($srchResult = ($link->query($Query))) or trigger_error($link->error."[$Query]") ) {}

    	}
    }
}
?>

