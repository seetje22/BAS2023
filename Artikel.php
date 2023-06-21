<?php 

include 'Database.php';

class Artikel extends Database{

	public function selectArtikel(){

		$lijst = self::$conn->query("select * from 	artikelen")->fetchAll();
		return $lijst;
        
	}

	public function updateArtikel2($artId, $artOmschrijving, $artInkoop, $artVerkoop, $artVoorraad, $artMinVoorraad, $artMaxVoorraad, $artLocatie) {
		$sql = "update klanten 
			set artOmschrijving = '$artOmschrijving', artInkoop = '$artInkoop', artVerkoop = '$artVerkoop', artVoorraad = '$artVoorraad', artMinVoorraad = '$artMinVoorraad', artMaxVoorraad = '$artMaxVoorraad', artLocatie = '$artLocatie' 
			WHERE artId = '$artId'";

		$stmt = self::$conn->prepare($sql);
		$stmt->execute(); 
		return ($stmt->rowCount() == 1) ? true : false;	
	}

	public function deleteArtikel($artId){

		$sql = "delete from klanten where artId = '$artId'";
		$stmt = self::$conn->prepare($sql);
		$stmt->execute();
      	return ($stmt->rowCount() == 1) ? true : false;
   	 	
			
 	}

	public function showTable($lijst){
		
		
		$txt = "<table border=1px>";
		$txt .= "<tr><th>ID</th><th>Omschrijving</th><th>Inkoop</th><th>Verkoop</th><th>Voorraad</th><th>MinVoorraad</th><th>MaxVoorraad</th><th>LeverancierId</th></tr>";
		foreach($lijst as $row){
			$txt .= "<tr>";
			$txt .=  "<td>" . $row["artId"] . "</td>";
			$txt .=  "<td>" . $row["artOmschrijving"] . "</td>";
			$txt .=  "<td>" . $row["artInkoop"] . "</td>";
			$txt .=  "<td>" . $row["artVerkoop"] . "</td>";
			$txt .=  "<td>" . $row["artVoorraad"] . "</td>";
			$txt .=  "<td>" . $row["artMinVoorraad"] . "</td>";
			$txt .=  "<td>" . $row["artMaxVoorraad"] . "</td>";
			$txt .=  "<td>" . $row["artLocatie"] . "</td>";
			$txt .=  "<td>" . $row["levId"] . "</td>";
			
			//Update
			// Wijzig knopje
        	$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='updateArtikel.php?artId=$row[artId]' >       
                <button name='update'>Wzg</button>	 
            </form> </td>";


			//Delete
			$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='deleteArtikel.php?artId=$row[artId]' >       
                <button name='verwijderen'>Verwijderen</button>	 
            </form> </td>";	
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		echo $txt;
	}

}
?>