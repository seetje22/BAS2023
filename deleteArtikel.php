<?php

if(isset($_POST["verwijderen"])){
	include 'classes/Artikel.php';
	
	// Maak een object Acteur
	$artikel = new Artikel;
	
	// Delete Acteur op basis van NR
	$artikel->deleteArtikel($_GET["artId"]);
	echo '<script>alert("Artikel verwijderd")</script>';
	echo "<script> location.replace('index.php'); </script>";
}
?>