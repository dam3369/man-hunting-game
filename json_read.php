<?php
require './lmp/lock.php';
require './lmp/config.php';
$connection = mysql_connect (DB_HOST,DB_LOGIN,DB_PASS);
mysql_select_db (DB_BDD) or die ("pas de connection");
$sql="SELECT id,lati,longi FROM user WHERE dead='0' ORDER BY pseudo ASC"; // requête
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$num_rows = mysql_num_rows($req);
$i = 0;
$j = 0;

echo "{ ";

while($data=mysql_fetch_assoc ($req)) {
	$i++;
	$id=$data['id'];
	$lati=$data['lati'];
	$longi=$data['longi'];
	if($data['id'] != $_SESSION['id']) {
		$j++;
		echo '"'.$j.'": {';
		echo '"id": "'.$id.'",';
		echo '"lati": "'.$lati.'",';
		echo '"longi": "'.$longi.'"';
		if ( $i == $num_rows ) {
			echo "} ";	//you're on last line...    
		} else {
			echo "}, ";	
		}
	}
};

echo "}";
?>
