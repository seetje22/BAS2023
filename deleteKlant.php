<?php

if(isset($_POST["verwijderen"])){
	include 'classes/Klant.php';
	
	// Maak een object Acteur
	$klant = new Klant;
	
	// Delete Acteur op basis van NR
	$klant->deleteKlant($_GET["klantId"]);
	echo '<script>alert("Klant verwijderd")</script>';
	echo "<script> location.replace('index.php'); </script>";
}
?>