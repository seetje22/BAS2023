<?php 

include 'Database.php';

class Leverancier extends Database{

	public function insertLeverancier($conn, $naam, $inkoop, $verkoop, $voorraad, $minVoorraad, $maxVoorraad, $locatie, $levId){

        $sql = "INSERT INTO klanten (artOmschrijving, artInkoop, artVerkoop, arVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie, levId) VALUES ('$naam', '$inkoop', '$verkoop', '$voorraad', '$minVoorraad', '$maxVoorraad', '$levId')";

		$stmt = self::$conn->prepare($sql);

        $stmt->execute();

        return true;

	}

	public function selectLeverancier(){

		$lijst = self::$conn->query("select * from 	artikelen")->fetchAll();
		return $lijst;
        
	}

	public function getLeveranciers(){

		$sql = "SELECT DISTINCT klantNaam FROM klanten";

		$stmt = self::$conn->query($sql);

        $klanten = $stmt->fetchALL(PDO::FETCH_ASSOC);

   	   return $klanten;
	}

	public function getLeverancier($klant){

		$sql = "SELECT * FROM klanten WHERE klantnaam = '$klant'";

		$stmt = self::$conn->query($sql);

        $klanten = $stmt->fetchALL(PDO::FETCH_ASSOC);

   	   return $klanten;
	}

	public function getIds(){

		$sql = "SELECT klantId FROM klanten";

		$stmt = self::$conn->query($sql);

        $klanten = $stmt->fetchALL(PDO::FETCH_ASSOC);

   	   return $klanten;
	}

	public function getId($id){

		$sql = "SELECT * FROM klanten WHERE `klantId` = '$id'";

		$stmt = self::$conn->query($sql);

        $klanten = $stmt->fetchALL(PDO::FETCH_ASSOC);

   	   return $klanten;
	}

	public function deleteLeverancier($levId){

		$sql = "DELETE FROM leveranciers WHERE levId = '$levId'";
		$stmt = self::$conn->prepare($sql);
        $stmt->execute();
 	}


}
?>