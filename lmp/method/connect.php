<?php require '../config.php';
$connection = mysql_connect (DB_HOST,DB_LOGIN,DB_PASS);
if (!$connection) die ("connection impossible");
mysql_select_db (DB_BDD) or die ("pas de connection");
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$after_create="Location: http://".$host.$uri.$after_create;

$after_login="Location: http://".$host.$uri.$after_login;

$after_login_admin="Location: http://".$host.$uri.$after_login_admin;

$after_logout="Location: http://".$host.$uri.$after_logout;

if ($signin=="login"){
	$login=true;
}	elseif ($signin=="mail"){
	$login=false;
}	else {
	echo "Chose your signin method in config.php";
}
?>