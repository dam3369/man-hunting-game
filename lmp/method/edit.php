<?php
require $_SERVER['DOCUMENT_ROOT'].'/lmp/lock.php';
require $_SERVER['DOCUMENT_ROOT'].'/lmp/method/connect.php';

extract($_POST);

$id=$_POST['id'];
$password=htmlentities($_POST['password']);
$confirm_password=htmlentities($_POST['confirm_password']);

$password=addslashes($password);
$confirm_password=addslashes($confirm_password);

if ($password == $confirm_password){
	$password = sha1($password);
	$sql = "UPDATE user SET password = '$password' WHERE id = '$id'";
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	header($after_login);
}	?>

<?php mysql_close($connection); ?>