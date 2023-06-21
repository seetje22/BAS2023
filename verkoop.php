<?php

require_once 'Database.php';

class Verkoop extends Database{

	public function insertVerkoop($klantId, $artId, $aantal){

		$datum = date("Y-m-d");

        $sql = "INSERT INTO verkooporders (klantId, artId, verkOrdDatum, verkOrdBestAantal, verkOrdStatus) VALUES ('$klantId', '$artId', '$datum', '$aantal', 1 )";

		$stmt = self::$conn->prepare($sql);

        $stmt->execute();

        return true;

	}

	public function selectVerkoop(){

		$lijst = self::$conn->query("select * from 	verkooporders")->fetchAll();
		return $lijst;
        
	}

	public function printTable($verkoop){
		echo "<table border=1px>";
		echo "<tr>";
			echo "<th>VerkoopId</th>";
			echo "<th>KlantId</th>";
			echo "<th>ArtikelId</th>";
			echo "<th>VerkoopOrderDatum</th>";
			echo "<th>Aantal</th>";
			echo "<th>Status</th>";
		echo "</tr>";
		foreach($verkoop as $row){
			echo "<tr>";
				echo "<td>" . $row["verkOrdId"] . "</td>";
				echo "<td>" . $row["klantId"] . "</td>";
				echo "<td>" . $row["artId"] . "</td>";
				echo "<td>" . $row["verkOrdDatum"] . "</td>";
				echo "<td>" . $row["verkOrdBestAantal"] . "</td>";
				echo "<td>" . $row["verkOrdStatus"] . "</td>";
				echo "<td><form action='updateVerkoop.php' method='POST'><input type='hidden' name='verkoopId' value='$row[verkOrdId]'><input type='submit' name='bewerken' value='Bewerken'></form></td>";
				echo "<td><form action='selectVerkoop.php' method='POST'><input type='hidden' name='verkoopId' value='$row[verkOrdId]'><input type='submit' name='verwijderen' value='Verwijderen'></form></td>";
			echo "</tr>";
		}
		echo "</table>";
	}

	public function getOrders(){

		$sql = "SELECT * FROM verkooporders";

		$stmt = self::$conn->query($sql);

        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

   	   return $orders;
	}

	public function getKlant($data){

		$sql = "SELECT * FROM inkooporders WHERE $data =" ;

		$stmt = self::$conn->prepare($sql);

        $stmt->execute();
	}

	public function getVerkoop($verkOrdId) {

		$sql = "select * from verkooporders where verkOrdId = '$verkOrdId'";
		$query = self::$conn->prepare($sql);
		$query->execute();
		return $query->fetch();
	}

	public function getKlanten(){

		$sql = "SELECT DISTINCT klanten.klantNaam FROM klanten INNER JOIN verkooporders ON klanten.klantId = verkooporders.klantId";

		$stmt = self::$conn->query($sql);

        $klanten = $stmt->fetchAll(PDO::FETCH_ASSOC);

   	   return $klanten;
	}

	public function deleteVerkoop($verkOrdID){

		$sql = "delete from verkooporders where verkOrdId = '$verkOrdId'";
		$stmt = self::$conn->prepare($sql);
		$stmt->execute();
      	return ($stmt->rowCount() == 1) ? true : false;

 	}

 	public function updateVerkoop($id, $klantid, $artId, $verkOrdDatum, $verkOrdStatus){

 		$sql = "UPDATE verkooporders SET Klantid = '$klantid', artId = '$artId', verkOrdDatum = '$verkOrdDatum', verkOrdStatus = '$verkOrdStatus' WHERE verkOrdId  = '$id'";

		$stmt = self::$conn->prepare($sql);

    	$stmt->execute();
 	}

	public function updateVerkoop2($verkOrdId, $klantId, $artId, $verkOrdBestAantal, $verkOrdDatum, $verkOrdStatus) {
		$sql = "update verkooporders', klantId = '$klantId', artId = '$artId', verkOrdBestAantal = '$verkOrdBestAantal', verkOrDatum = '$verkOrdDatum', verkOrdStatus = '$verkOrdStatus' 
			WHERE verkOrdId = '$verkOrdId'";

		$stmt = self::$conn->prepare($sql);
		$stmt->execute(); 
		return ($stmt->rowCount() == 1) ? true : false;	
	}

	 public function showTable($lijst){
		
		$txt = "<table border=1px>";
		$txt .= "<tr><th>ID</th><th>klantId</th><th>artikelId</th><th>Datum</th><th>aantal</th><th>Status</th></tr>";
		foreach($lijst as $row){
			$txt .= "<tr>";
			$txt .=  "<td>" . $row["verkOrdId"] . "</td>";
			$txt .=  "<td>" . $row["klantId"] . "</td>";
			$txt .=  "<td>" . $row["artId"] . "</td>";
			$txt .=  "<td>" . $row["verkOrdDatum"] . "</td>";
			$txt .=  "<td>" . $row["verkOrdBestAantal"] . "</td>";
			$txt .=  "<td>" . $row["verkOrdStatus"] . "</td>";
			
			//Update
			// Wijzig knopje
        	$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='updateVerkoop.php?verkOrdId=$row[verkOrdId]' >       
                <button name='update'>Wzg</button>	 
            </form> </td>";


			//Delete
			$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='deleteVerkoop.php?verkOrdId=$row[verkOrdId]' >       
                <button name='verwijderen'>Verwijderen</button>	 
            </form> </td>";	
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		echo $txt;
	}

	public function getOrderList() {
        $query = "SELECT * FROM verkooporders";
        $stmt = self::$conn->query($query);
        return $stmt->fetchAll();
    }
    
    public function updateOrderStatus($orderId, $statusId) {
        $query = "UPDATE verkooporders SET verkOrdStatus = :status WHERE verkOrdId = :id";
        $stmt = self::$conn->prepare($query);
        $stmt->bindParam(':status', $statusId, PDO::PARAM_INT);
        $stmt->bindParam(':id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
    }

	
}
