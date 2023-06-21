<!DOCTYPE html>
<html>
<body>
<h1>CRUD Acteur</h1>
<h2>Wijzigen</h2>

<?php

    include_once 'classes/Artikel.php';
    $artikel = new Artikel;

    if(isset($_POST["update"]) && $_POST["update"] == "Wijzigen"){

        $artikel->updateArtikel2($_POST['artId'], $_POST['artOmschrijving'], $_POST['artInkoop'], $_POST['artVerkoop'], $_POST['artVoorraad'], $_POST['artMinVoorraad'], $_POST['artMaxVoorraad'], $_POST['artLocatie']);
        echo '<script>alert("Artikel is gewijzigd")</script>';
        
        // Toon weer het scherm
        //include "update_form.php";
    }

    if (isset($_GET['artId'])){
        $row = $artikel->getArtikel($_GET['artId']);
    }
?>
	
<form method="post">
<input type='hidden' name='artId' value='<?php echo $row["artId"];?>'>
<input type='text' name='artOmschrijving' required value="<?php echo $row["artOmschrijving"];?>"> *</br>
<input type='text' name='artInkoop' required value='<?php echo $row["artInkoop"];?>'> *</br>
<input type='text' name='artVerkoop' required value='<?php echo $row["artVerkoop"];?>'> *</br>
<input type='text' name='artVoorraad' required value='<?php echo $row["artVoorraad"];?>'> *</br>
<input type='text' name='artMinVoorraad' required value='<?php echo $row["artMinVoorraad"];?>'> *</br>
<input type='text' name='artMaxVoorraad' required value='<?php echo $row["artMaxVoorraad"];?>'> *</br>
<input type='text' name='artLocatie' required value='<?php echo $row["artLocatie"];?>'> *</br>
<input type='submit' name='update' value='Wijzigen'>
</form></br>

<a href='index.php'>Terug</a>

</body>
</html>
