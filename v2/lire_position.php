<?php
// $num_rows = 4;
require '../lmp/lock.php';
require '../lmp/config.php';

$connection = mysql_connect (DB_HOST,DB_LOGIN,DB_PASS);
mysql_select_db (DB_BDD) or die ("pas de connection");
$sql="SELECT id FROM user WHERE dead='0' ORDER BY pseudo ASC"; // requête
$req = mysql_query($sql) or die('Erreur SQL '.$sql.' '.mysql_error());
$num_rows = mysql_num_rows($req);
?>

	var lati;
	var long;
	var timeout = 5000; // 5 seconde de temps de reload de l'ajax
	var decalage = 1000; // décalage pour le lancement du reload de la distance et le premier call ajax 
	var distance_reload = 200; // temp entre chaque changement de la distance entre les joueurs
	var ajax_url = "./ecrire_position.php"; // Url du call ajax
	var id_affichage = 'gpsText'; // Id de l'objet qui contient la valeur à mettre à jour
	// Génération des varaible globale de chaque concurents
	<?php for($i = 1; $i <= $num_rows-1; $i++){ ?>
		var id_<?php echo $i?>; 
		var tracedLat_<?php echo $i?>;
		var tracedLng_<?php echo $i?>;
	<?php } ?>	
	
	// Fonction capturant les valeurs du GPS
	function showGPS(position){
		lati=((Math.round(position.coords.latitude*1000000))/1000000);
		long=((Math.round(position.coords.longitude*1000000))/1000000);
		
		document.getElementById("lati").value = lati;
		document.getElementById("longi").value = long;
	}
	
	// Fonction qui réalise le call ajax pour mettre à jour la base de donnée
	function uploadPage(){
		var i = 0;
		var position = $('#form').serializeArray();
		$.ajax({
			url: ajax_url,
			datatype: "json",
			type: "POST",
			data: position,
			success: function(data){
				positionsInitialisation(data);		
			}
		});
		console.log("lat="+lati+"&lng="+long);
		timeOut(); 
	}	

	// Fonction qui parse le json et qui initialise et actualise toute les variables des joueurs
	function positionsInitialisation(data){
		var otherPositions = jQuery.parseJSON(data);
		for(var i= 1; i <= <?php echo $num_rows-1?>; i++) {
//				traceGPS(otherPositions[i].id, otherPositions[i].lati, otherPositions[i].longi);
				<?php for($i = 1; $i <= $num_rows-1; $i++){ ?>
					if(i==<?php echo $i?>){
						id_<?php echo $i?> = otherPositions[i].id;
						tracedLat_<?php echo $i?> = otherPositions[i].lati;
						tracedLng_<?php echo $i?> = otherPositions[i].longi;
					}
				<?php } ?>
		}
	}
	
	// Fonctions gérer écrivant dans l'affichage la distance entre chaque concurant
	<?php for($i = 1; $i <= $num_rows-1; $i++){ ?>
		function traceGPS_<?php echo $i?>(){
			// compteur pour iphone en mode développeur personalisé :) 
			<?php //if($i == 1) echo 'var dious=3;if(console){if(dious == 3){console.log("12 powa | L ");dious=dious+3;}if(dious == 6){console.log("12 powa |  ) ");dious=dious+3;}if(dious == 9){console.log("12 powa | / ");dious=dious+3;}if(dious == 12){console.log("12 powa |( ");dious=3;}}'; ?>
			var A_<?php echo $i?>=(tracedLat_<?php echo $i?>-document.getElementById("lati").value);
			var B_<?php echo $i?>=(tracedLng_<?php echo $i?>-document.getElementById("longi").value);
			var H_<?php echo $i?>=((Math.sqrt((A_<?php echo $i?>*A_<?php echo $i?>)+(B_<?php echo $i?>*B_<?php echo $i?>)))*100000);
			var r_<?php echo $i?>=(Math.floor(H_<?php echo $i?>));
			document.getElementById(id_affichage+id_<?php echo $i?>).innerHTML = " ► " + r_<?php echo $i?> + "m";
//			document.getElementById(id_affichage+id_<?php echo $i?>).innerHTML = (Math.floor(((Math.sqrt((tracedLat_<?php echo $i?>-lati)*(tracedLat_<?php echo $i?>-lati))+((tracedLng_<?php echo $i?>-long)*(tracedLng_<?php echo $i?>-long))))*100000));
			traceGPSTimeOut_<?php echo $i?>()
		}
	<?php } ?>
	
	// Fonction créant la boucle Ajax
	function timeOut(){
		setTimeout("uploadPage()", timeout);
	}	
	
	// Fonctions générés créant la boucle d'actualisation de l'affichage de la distance des concurents
	<?php for($i = 1; $i <= $num_rows-1; $i++){ ?>
		function traceGPSTimeOut_<?php echo $i?>(){
			setTimeout("traceGPS_<?php echo $i?>()", distance_reload);
		}
	<?php } ?>
	
	// Fonction qui gère les erreurs de GPS
	function gpsError(error) {}
	
	// Ligne appelle la localisation
	navigator.geolocation.watchPosition(showGPS, gpsError, {enableHighAccuracy:true});

	$(document).ready(function(){
		// Appelle de la fonction de bouclage ajax
		timeOut();
		// Appelle des fonctions de bouclage 
		<?php for($i = 1; $i <= $num_rows-1; $i++){ ?>
			setTimeout("traceGPSTimeOut_<?php echo $i?>()", timeout+decalage);
		<?php } ?>
	});