<?php
session_start();

require './connect.php';
extract($_POST);

//$login=htmlentities($_POST['login']);
$login=htmlentities($_POST['login']);
$password=htmlentities($_POST['password']);

//$login=addslashes($login);
$login=addslashes($login);
$password=addslashes($password);

$sql="SELECT * from user WHERE login LIKE '$login'"; // requête
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

if ($req){
	$data = mysql_fetch_assoc($req);
	
	if (sha1($password) === $data['password'] && $data['password'] != null) {
		if ($data['is_admin']){
			$_SESSION['dead'] = $data['dead'];
			$_SESSION['shootpass'] = $data['shootpass'];
			$_SESSION['pseudo'] = $data['pseudo'];
			$_SESSION['login'] = $login;
			$_SESSION['id'] =  $data['id'];
			$_SESSION['is_admin'] =  $data['is_admin'];
			header($after_login_admin);
			exit;
			
		}	else {
			$_SESSION['dead'] = $data['dead'];
			$_SESSION['shootpass'] = $data['shootpass'];
			$_SESSION['login'] = $login;
			$_SESSION['pseudo'] = $data['pseudo'];
			$_SESSION['id'] =  $data['id'];
			if($data['mail_activated'] === '1'){
				header($after_login);
			exit;
			}
			echo "votre compte n'as pas &eacute;t&eacute; valider par e-mail";
			exit;
		}
		
	}elseif ($password === $data['password'] && $data['password'] != null) {
		$_SESSION['login'] = $login;
		$_SESSION['pseudo'] = $data['pseudo'];
		$_SESSION['id'] =  $data['id'];
		if($data['mail_activated'] !== '1'){
				echo "votre compte n'a pas &eacute;t&eacute; valider par e-mail";
			exit;
		}else {
			header("location:../edit_account.php");
		}
		
	}	else {
			header("location:../signin.php");
	}
	
}	else {
		echo "Erreur login inexistant.";
}
?>
