<?php
	require './lmp/lock.php';
	require './lmp/config.php';
	$connection = mysql_connect (DB_HOST,DB_LOGIN,DB_PASS);
	if (!$connection) die ("connection impossible");
	mysql_select_db (DB_BDD) or die ("pas de connection");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
	<title>Chasse à l'homme</title>
	<meta http-equiv="refresh" content="50000; URL=index.php">
	<!--<?php 
		if ( strstr($_SERVER['HTTP_USER_AGENT'],'iPhone')) echo "<meta name=\"viewport\" content=\"width=device-width; initial-scale=1; maximum-scale=1; user-scalable=0;\" />";
		if ( strstr($_SERVER['HTTP_USER_AGENT'],'iPad')) echo "<meta name=\"viewport\" content=\"width=device-width; initial-scale=1.5; maximum-scale=4; user-scalable=1;\" />";
	?>-->
	<link rel="apple-touch-icon" href="img/touch-icon-iphone.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="img/touch-icon-ipad.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="img/cal.jpg" />
	<link rel="apple-touch-startup-image" href="img/" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />	
	<meta name="format-detection" content="telephone=no" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />
	<meta http-equiv="Expires" content="0" />
	<script type="text/javascript" language="Javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.js"></script>
		<!--<script type="text/javascript">
			// SCRIPT QUI PROPOSE L'INSTALLATION DE LA WEBAPP
			if ('standalone' in navigator && !navigator.standalone && (/iphone|ipod|ipad/gi).test(navigator.platform) && (/Safari/i).test(navigator.appVersion)) {
				document.write('<link rel="stylesheet" href="add2home\/add2home.css">');
				document.write('<script type="application\/javascript" src="add2home\/add2home.js"><\/script>');
			}
		</script>-->
	<link rel="stylesheet" media="all and (orientation:portrait)" href="css/portrait.css" />
	<link rel="stylesheet" media="all and (orientation:landscape)" href="css/landscape.css" />
	<link rel="stylesheet" href="css/common.css" />

  </head>
  <body>
 	 <div id="blueBarre"></div>
 	 <div id="meLeft">
		<?php echo $_SESSION['prenom']; ?>
	</div>
	<div id="meRight">
		<?php echo $_SESSION['shootpass']; ?>
	</div>
	<div id="portrait">
			<form id="form" method="post" action="creer.php">
				<input type="hidden" name="lat" id="lati" />
				<input type="hidden" name="lng" id="longi" />
			</form>
			<br />
			<div id="infos">
				<?php if($_SESSION['dead']=='1'){echo '<img src="./img/dead.png"><br /><h1>You are dead !</h1>';}else{ ?>
				<?php $sql="SELECT * FROM user WHERE dead='0' ORDER BY prenom ASC"; // requête
					$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
					while($data=mysql_fetch_assoc ($req)) {
						$myId=$data['id'];
						if($myId != $_SESSION['id']) {

							$lati=$data['lati'];
							$longi=$data['longi'];
				?>
				
				<div class="uneLignAlive">
				<?php echo mb_strtoupper($data['prenom']); ?>
						<span id="gpsText<?php echo $myId; ?>" class="gpsText"></span>
						<br /><br />
						<form action="kill.php" method="post">
							<input type="hidden" name="him" value="<?php echo $data['id']; ?>" />
							<input id="passshoot_input" type="text" name="answer" size="4" />
							<INPUT id="kill_button" border=0 type=submit Value="Kill" align="middle" /></form>
			</div>
			<?php } ?>
			<?php }} ?>
			<script type="text/javascript" src="./v2/lire_position.php"></script>
			
		</div>
		<div id="infosDead">
			<?php
				$sql="SELECT * FROM user WHERE dead='1' ORDER BY prenom ASC"; // requête
				$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
				while($data=mysql_fetch_assoc ($req)) {
					 if($data['killed_by']!=$data['prenom']){echo $data['killed_by'];}else{echo 'I ';} ?>
					<img src="http://images3.wikia.nocookie.net/__cb20101127052129/valve/es/images/d/d3/Desert_Eagle_CS_Icono_de_muerte.png">
						<?php echo $data['prenom']; ?>
				<?php } ?>
		</div>
	</div>
	<div id="landscape"><center><div id="infosDead">
	<br />
	<h3>Liste des Kill</h3>
		<?php
			$sql="SELECT * FROM user WHERE dead='1' ORDER BY prenom ASC"; // requête
			$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
			while($data=mysql_fetch_assoc ($req)) {
				 echo $data['prenom']; ?>
				<span style="color:red;">KILLED</span>
					by <?php echo $data['killed_by']; ?>
				<br />
			<?php } ?>
	</div>
	<br /><br /><br /><a href="#" onClick="window.location.reload();return false;">R E L O A D</a></center></div>
  </body>
</html>