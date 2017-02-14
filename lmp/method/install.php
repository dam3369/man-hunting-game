<?php
require './connect.php';

$sql="CREATE TABLE  `user` (`id` INT( 7 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,`login` VARCHAR( 20 ) NOT NULL ,`password` VARCHAR( 20 ) NOT NULL ,`is_admin` TINYINT( 1 ) NOT NULL ,UNIQUE (`login`)) ENGINE = INNODB;"; // requête
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
if ($req){
	echo "Installation r&eacute;ussie";
}
