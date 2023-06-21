<?php

include "classes/VerkooporderForm.php";
include 'classes/verkoop.php';

$form = new VerkooporderForm();
$form->generateForm();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $klantId = $_POST["klant"];
    $artId = $_POST["artikel"];
    $aantal = $_POST["aantal"];

    $verkoop = new Verkoop();
    $verkoop->insertVerkoop($klantId, $artId, $aantal);

}

	//if(isset($_POST['submit'])){
	//	include "conn.php";
	//	include 'classes/verkoop.php';
	//	$conn = dbConnect();




		//$klantId = $_POST['$klant[klantId]'];
		//$artId = $_POST['artId'];
		//$aantal = $_POST['Aantal'];

		//$verkoop = new Verkoop();
		//$verkoop->insertVerkoop($conn, $klantId, $artId, $aantal);
	//}

	if(isset($verkoop) && $verkoop == true){
		echo '<script>alert("VerkoopOrder toegevoegd")</script>';
        echo "<script> location.replace('index.php'); </script>";
	}

?>