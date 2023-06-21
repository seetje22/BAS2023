<?php 

include_once 'classes/Database.php';

class Klant extends Database{

	public $klantId;
	public $klantNaam;
	public $klantEmail;
	public $klantAdres;
	public $klantPostcode;
	public $klantWoonplaats;

	public function setObject($klantId, $klantNaam, $klantEmail, $klantAdres, $klantPostcode, $klantWoonplaats){
		$this->klantId = $klantId;
		$this->klantNaam = $klantNaam;
		$this->klantEmail = $klantEmail;
		$this->klantAdres = $klantAdres;
		$this->klantPostcode = $klantPostcode;
		$this->klantWoonplaats = $klantWoonplaats;
	}

	public function insertKlant($naam, $mail, $adres, $postcode, $woonplaats){

        $sql = "INSERT INTO klanten (klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats) VALUES ('$naam', '$mail', '$adres', '$postcode', '$woonplaats')";

		$stmt = self::$conn->prepare($sql);

        $stmt->execute();

        return true;

	}

	public function selectKlant(){
		$lijst = self::$conn->query("select * from 	klanten")->fetchAll();
		return $lijst;
        
	}

	public function searchCustomerById($klantId) {
        return self::$conn->searchCustomerById($klantId);
    }

	public function getKlant($klantId) {

		$sql = "select * from klanten where klantId = '$klantId'";
		$query = self::$conn->prepare($sql);
		$query->execute();
		return $query->fetch();
	}

	public function updateKlant(){
		// Voor deze functie moet eerst een setObject aangeroepen worden om $this te vullen
		$sql = "update klanten 
			set klantNaam = :klantNaam, klantEmail = :klantEmail, klantAdres = :klantAdres, klantPostcode = :klantPostcode 
			WHERE klantId = :klantId";

		$stmt = self::$conn->prepare($sql);
		$stmt->execute((array)$this);
		return ($stmt->rowCount() == 1) ? true : false;		
	}

	public function updateKlant2($klantId, $klantNaam, $klantEmail, $klantAdres, $klantPostcode, $klantWoonplaats) {
		$sql = "update klanten 
			set klantNaam = '$klantNaam', klantEmail = '$klantEmail', klantAdres = '$klantAdres', klantPostcode = '$klantPostcode', klantWoonplaats = '$klantWoonplaats' 
			WHERE klantId = '$klantId'";

		$stmt = self::$conn->prepare($sql);
		$stmt->execute(); 
		return ($stmt->rowCount() == 1) ? true : false;	
	}

	public function updateKlantSanitized($klantId, $klantNaam, $klantEmail, $klantAdres, $klantPostcode, $klantWoonplaats){

		$sql = "update acteurs 
			set klantNaam = :klantNaam, klantEmail = :klantEmail, klantAdres = :klantAdres, klantPostcode = :klantPostcode, klantWoonplaats = :klantWoonplaats 
			WHERE klantId = :klantId";
			
		// PDO sanitize automatisch in de prepare
		$stmt = self::$conn->prepare($sql);
		$stmt->execute([
			'klantNaam' => $klantNaam,
			'klantEmail'=> $klantEmail,
			'klantAdres'=> $klantAdres,
			'klantPostcode'=> $klantPostcode,
			'klantWoonplaats'=> $klantWoonplaats,
			'klantId'=> $klantId
		]);  
	}

	public function deleteKlant($klantId){

		$sql = "delete from klanten where klantId = '$klantId'";
		$stmt = self::$conn->prepare($sql);
		$stmt->execute();
      	return ($stmt->rowCount() == 1) ? true : false;
   	 	
			
 	}

	 public function showTable($lijst){
		
		
		$txt = "<table border=1px>";
		$txt .= "<tr><th>ID</th><th>Naam</th><th>Email</th><th>Adres</th><th>Postcode</th><th>Woonplaats</th></tr>";
		foreach($lijst as $row){
			$txt .= "<tr>";
			$txt .=  "<td>" . $row["klantId"] . "</td>";
			$txt .=  "<td>" . $row["klantNaam"] . "</td>";
			$txt .=  "<td>" . $row["klantEmail"] . "</td>";
			$txt .=  "<td>" . $row["klantAdres"] . "</td>";
			$txt .=  "<td>" . $row["klantPostcode"] . "</td>";
			$txt .=  "<td>" . $row["klantWoonplaats"] . "</td>";
			
			//Update
			// Wijzig knopje
        	$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='updateKlant.php?klantId=$row[klantId]' >       
                <button name='update'>Wzg</button>	 
            </form> </td>";


			//Delete
			$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='deleteKlant.php?klantId=$row[klantId]' >       
                <button name='verwijderen'>Verwijderen</button>	 
            </form> </td>";	
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		echo $txt;
	}

}


?>