<?php
require './../lock.php';
require './connect.php';
$id = $_GET['id'];

$sql = "DELETE FROM `user` WHERE `id` = '$id'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
header($after_login_admin);
?>

<?php mysql_close($connection); ?>