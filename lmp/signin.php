<html>
<head>
	<?php 
		if ( strstr($_SERVER['HTTP_USER_AGENT'],'iPhone')) echo "<meta name=\"viewport\" content=\"width=device-width; initial-scale=1; maximum-scale=1; user-scalable=0;\" />";
		if ( strstr($_SERVER['HTTP_USER_AGENT'],'iPad')) echo "<meta name=\"viewport\" content=\"width=device-width; initial-scale=1.5; maximum-scale=4; user-scalable=1;\" />";
	?>
<title>Killer Login</title>
</head>
<body style="background:url(../img/fond.jpg) repeat-x;">
	<center>
<form action="method/check.php" method="post" style="margin-top:50px;">	
		<table border=0 cellpadding=10>
			<tr align=center><td>
				<span style="color:black;font-size:20px;">EMAIL</span><br /><input type="text" name="login" size="20" style="background:white;"/>
				</td><td>
					<span style="color:black;font-size:20px;">PASSWORD</span><br /><input type="password" name="password" size="10" style="background:white;"/>
				</td></tr>
				</table>
				<INPUT border=0 type=submit Value="&rarr;" align="middle" style="height:50px;width:50px;"/>
			</form>
			<br /><br /><br />
			<a href="./create_account.php">Je m'inscrit</a> (no spam, only fun)
	</center>
</body>