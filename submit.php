<html>
<head>
	<style type="text/css">
		table,tr,td,input,select,body,fieldset {font-family:verdana, Bitstream Vera Sans, sans serif; color:000000; font-size:11px;}
	</style>
	<script type="text/javascript">
		function Redirect() {window.location = "http://www.saveologycentral.com/hr/Wiki%20Pages/CORPORATE%20POLICY%27S.aspx";}
	</script>
</head>

<body onLoad="setTimeout('Redirect()', 5000)">
<?php
	require_once("config.php");
	$conn = mysql_connect($dbaddr, $dbuser, $dbpass);
	if(!$conn) die('Could not connect to : ' . mysql_error());		
	@mysql_select_db("hr", $conn) or die("Unable to select database.");
	
	if(!isset($_POST["empname"])) die('Invalid.');
	
	$fid	= $_POST["formid"];
	$ename	= $_POST["empname"];
	$epin	= $_POST["emppin"];
	
	$rs=mysql_query("SELECT AckID FROM Acks a WHERE a.FormID=$fid AND EmpName='$ename'");
	if(!$rs) die("Query failed.");		
	$rc=mysql_numrows($rs);				
	
	if($rc==0)
	{
		$mq = "INSERT INTO Acks (FormID,AckDate,EmpName,EmpPin) VALUES ('$fid', NOW(), '$ename', '$epin')";
		
	}
	else
	{
		$id = mysql_result($rs,0,"AckID");
		$mq = "UPDATE Acks SET AckDate=NOW(), EmpPin='$epin' WHERE AckID=$id";
	}
	$rs=mysql_query($mq); if(!$rs) die("Query failed: [$mq]");
	
	$rs=mysql_query("SELECT * FROM Forms f WHERE FormID=$fid");	if(!$rs) die("Query failed.");
	$rc=mysql_numrows($rs); if($rc!=1) die('Invalid FormID.');
	$fname = mysql_result($rs,0,"FormName");

?>

<br><br><br><br><br>
<center>
	<b>Thank you.</b>  Your acknowledgement that you have read and agreed to the <b><? echo $fname; ?></b> has been submitted.</b><br><br>
	<br><br>
	
	
	<img src="siteart/saveology.jpg">
	<br><br><br><br>
	You will be returned to SaveologyCentral in 5 seconds, or you may simply click <a href="http://www.saveologycentral.com/hr/Wiki%20Pages/CORPORATE%20POLICY%27S.aspx">here</a>.
</center>


</body>






