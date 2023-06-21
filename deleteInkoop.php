<!DOCTYPE html>
<html>
<head>
    <title>deleten op Inkooporder ID</title>
</head>
<body>

<h2>deleten op Inkooporder ID</h2>
    <form method="POST" action="deleteKlant.php">
        <input type="text" name="inkOrdId" placeholder="Voer Inkooporder ID in">
        <input type="submit" value="submit">
    </form>

<?php 

if(isset($_POST["submit"])){
	include 'classes/inkoop.php';
	

	$inkoop = new Inkoop();

	$inkOrdId = $_POST["inkOrdId"];
	

	$inkoop->deleteInkoop($inkOrdId);
	echo '<script>alert("Inkooporder verwijderd")</script>';
	echo "<script> location.replace('index.php'); </script>";
}
?>

</body>
</html>