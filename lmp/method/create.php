<?php
require './connect.php';

extract('$_POST');

$login=htmlentities($_POST['login']);
$pseudo=htmlentities($_POST['pseudo']);
$password=htmlentities($_POST['password']);
$confirm_password=htmlentities($_POST['confirm_password']);

$pseudo=addslashes($pseudo);
$login=addslashes($login);
$password=addslashes($password);
$confirm_password=addslashes($confirm_password);



if ($password == $confirm_password){
	$password = sha1($password);

	$shootpass = rand(1000, 9999);

	$sql = "INSERT INTO user (pseudo, login, password, shootpass) VALUES ('$pseudo', '$login','$password','$shootpass');"; // requête
	$req = mysql_query($sql) or die('Erreur SQL ! <br>'.$sql.'<br>'.mysql_error()); 
		
	if ($req){
		header($after_create);
	}
}	else {  ?>
	<p>les mots de passe ne correspondent pas</p>
<?php	}?>

<?php mysql_close($connection); ?>