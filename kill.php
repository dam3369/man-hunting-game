<?php
	require './lmp/lock.php';
	require './lmp/config.php';
	
	
	extract('$_POST');
	
	$answer=htmlentities($_POST['answer']);
	$him=htmlentities($_POST['him']);
	
	$answer=addslashes($answer);
	$him=addslashes($him);
	
	$connection = mysql_connect (DB_HOST,DB_LOGIN,DB_PASS);
	if (!$connection) die ("connection impossible");
	mysql_select_db (DB_BDD) or die ("pas de connection");
	$sql="SELECT * FROM user WHERE id='$him'"; // requête
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error()); 
	$data=mysql_fetch_assoc($req);
	
	if($answer == $data['shootpass']) {
		$killer=$_SESSION['pseudo'];
		$sql="UPDATE user SET dead='1', killed_by='$killer' WHERE id='$him'"; // requête
		$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error()); 
		$data=mysql_fetch_assoc($req);
		header("Location: index.php");
	} else {
		header("Location: index.php");
	}
	mysql_close($connection); 
?>