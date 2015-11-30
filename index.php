<html>
<head>
	<style type="text/css">
		table,tr,td,input,select,body,fieldset {font-family:verdana, Bitstream Vera Sans, sans serif; color:000000; font-size:11px;}
		
	</style>
	<script type="text/javascript">
		
		function checkCheckBox(f)
		{
			if(f.agree.checked==false || f.empname.value==='')
			{
				alert("Please review the document and accept the terms to continue.");
				return false;
			}
			return true;
		}	
		
	</script>
</head>
<body>

<?php
	if(!isset($_GET["fid"])) die('Invalid format.');
	require_once("config.php");
	$conn = mysql_connect($dbaddr, $dbuser, $dbpass);
	if(!$conn) die('Could not connect to : ' . mysql_error());		
	@mysql_select_db("hr", $conn) or die("Unable to select database.");
	
	$formid = $_GET["fid"];
	$rs=mysql_query("SELECT * FROM Forms f WHERE FormID=$formid");
	if(!$rs) die("Query failed.");
	$rc=mysql_numrows($rs); if($rc!=1) die('Invalid form.');
	
	$pdf = mysql_result($rs,0,"FormPath");
	echo "<iframe src=\"forms/$pdf\" width='100%' height='90%'></iframe>";
 ?>



<!-- <object type="application/pdf" data="forms\Information Security Policy - Revised on 01_05_10.pdf"></object> -->

<br>

<form action="submit.php" method="POST" onsubmit="return checkCheckBox(this)">
	<input type="hidden" name="formid" value="<?php echo $formid; ?>">
	<table border="0" cellpadding="1" cellspacing="0" width="100%" style="background-color:a0d0aa">
		<tr><td colspan="4"><hr size=1 style="color:black"></td></tr>
		<tr>
			<td><b>Employee Name:</b> <input type="text" value="" name="empname" style="width:150px"></td>
			<td><b>Employee ID:</b> <input type="password" value="" name="emppin" style="width:50px"></td>
			<td align="right">
				<b>I have read and accept the terms above:</b> <input type="checkbox" value="0" name="agree">
			</td>
			<td align="center"><input type="submit" value="Submit"></td>
		</tr>
		<tr><td colspan="4"><hr size=1 style="color:black"></td></tr>
	</table>
</form>

</body>
</html>
