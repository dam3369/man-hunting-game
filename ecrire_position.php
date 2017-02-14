<?php

require './lmp/config.php';
$connection = mysql_connect (DB_HOST,DB_LOGIN,DB_PASS);
if (!$connection) die ("connection impossible");
mysql_select_db (DB_BDD) or die ("pas de connection");
require './lmp/lock.php';

extract($_POST);

$myId = $_SESSION['id'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$updated_at = time();

$update="UPDATE user SET lati='$lat', longi='$lng', updated_at='$updated_at' WHERE id='$myId'";
//$save="INSERT INTO location (lat,lng,user_id,) VALUES ('$lat','$lng','$myId')";

if ($lat!=0 && $lng!=0) { 
	mysql_query($update) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error()); 
	//mysql_query($save) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
}

include './json_read.php';
mysql_close($connection);
?>