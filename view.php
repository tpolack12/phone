<html>
<head>
	<style type="text/css">
		table,tr,td,input,select,body,fieldset {font-family:verdana, Bitstream Vera Sans, sans serif; color:000000; font-size:11px;}
	</style>
	<script type="text/javascript" src="md5.js" ></script>
	<script type="text/javascript">
		function HashPass(f)
		{
			return true;
			v = f.hash.value;
			
			v = hex_md5(v);
			f.hash.value = v;			
			//v = new Date().getHour();
		
			f.tok.value = hex_md5(new Date());
			
			return true;
		}
	
	</script>
</head>
<body>
<?php
	require_once("config.php");
	$conn = mysql_connect($dbaddr, $dbuser, $dbpass);
	if(!$conn) die('Could not connect to : ' . mysql_error());		
	@mysql_select_db("hr", $conn) or die("Unable to select database.");
	
	$rs=mysql_query("SELECT * FROM Acks a JOIN Forms f ON a.FormID=f.FormID ORDER BY DATE(a.AckDate),a.EmpName,a.FormID LIMIT 100");
	if(!$rs) die("Query failed.");		
	$rc=mysql_numrows($rs);			
	

	if(!isset($_POST["pass"]))
	{
		
?>
	<form action="" method="POST" onsubmit="return HashPass(this)">
	<input type="hidden" name="tok" value="">
	<center>
		<? if(isset($_POST["pass"])) echo "<b><font color=red>Invalid credentials.  Please try again.</font></b>";
			else echo "<b>Please enter your username and password to continue.</b>";
		?>
		<table cellspacing="2" cellpadding="0" width="300" style="background-color:f0c0ca; border:1px black solid">
			<tr>
				<td><b>Username: </b></td>
				<td><input type="input" name="user" value="" style="width:100px"></td>
			</tr>
				<td><b>Password: </b></td>
				<td><input type="password" name="pass" value="" style="width:100px"></td>
			</tr>
			<tr align="center">
				<br><br><br><td align="center" colspan="2"><input type="submit" value="Login"></td>
			</tr>
		</table>
	</center>
	</form>
<?
	}
	else {
		$ldaprdn  = "ELEPHANTGROUP\\" . $_POST["user"];
		$ldappass = $_POST["pass"];

		$ldapconn = ldap_connect("10.20.34.2") or die("Could not connect to LDAP server."); 
	
		if($ldapconn)
		{ 	
		    // binding to ldap server 
		    $ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass); 
		
		    // verify binding 
		    if ($ldapbind) { 
		        echo "<center><font color=green>Authentication successful.</font></center><br>"; 
		    } else { 
		        echo "<center><br><br><font color=red>Authentication failed!  Try again.</font><br><br></center>";
		        echo "<meta HTTP-EQUIV=Refresh CONTENT='2'>";
		        die();
			}
		}
	
?>

<table border="0" cellpadding="2" cellspacing="0" width="800">
	<tr>
		<td><b>ID</b></td>
		<td><b>Date</b></td>
		<td><b>Form</b></td>
		<td><b>Employee Name</b></td>
		<td><b>SSN</b></td>
	</tr>
	<?
		$cdate = "";
		for($i=0,$k=0;$i<$rc;$i++)
		{
			$rdatetime = mysql_result($rs,$i,"AckDate");
			$rdate = date('Y-m-d (D)',strtotime($rdatetime));
			if($rdate!=$cdate)
			{
				$cdate = $rdate;
				echo "<tr><td></td><td colspan=4 style='border-bottom:1px black solid'><b>$cdate</b></td></tr>";
			}
			if(($k%2)==0) $bgc="e0e0e0"; else $bgc="ffffff"; $k++;
			echo "<tr bgcolor='$bgc'>";
			echo "<td>" . mysql_result($rs,$i,"AckID") . "</td>";
			echo "<td>" . $rdatetime . "</td>";
			echo "<td>" . mysql_result($rs,$i,"FormName") . "</td>";
			
			echo "<td>" . mysql_result($rs,$i,"EmpName") . "</td>";
			echo "<td>" . mysql_result($rs,$i,"EmpPin") . "</td>";
			echo "</tr>";
		}
	} ?>

</table>

</body>






