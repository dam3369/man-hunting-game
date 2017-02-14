<?php
require './../lock.php';
require './../method/connect.php';

$sql="SELECT * from user ORDER BY id"; // requête
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
<ul>
<?php while($data = mysql_fetch_assoc($req)){ ?>
	<li><a href="./edit_account.php?id=<?php echo $data['id']?>"><?php echo $data['login']; ?></a></li>
<?php } ?>
</ul>