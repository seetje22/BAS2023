<?php

if(isset($_POST["verwijderen"])){
	include 'classes/Verkoop.php';
	
	// Maak een object Acteur
	$verkoop = new verkoop;
	
	// Delete Acteur op basis van NR
	$verkoop->deleteVerkoop($_GET["verkOrdId"]);
	echo '<script>alert("VerkoopOrder verwijderd")</script>';
	echo "<script> location.replace('index.php'); </script>";
}
?>