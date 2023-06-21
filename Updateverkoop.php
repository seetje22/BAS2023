<!DOCTYPE html>
<html>
<body>
<h1>CRUD Klant</h1>
<h2>Wijzigen</h2>

<?php

    include_once 'classes/Verkoop.php';
    $verkoop = new Verkoop;

    if(isset($_POST["update"]) && $_POST["update"] == "Wijzigen"){

        $verkoop->updateVerkoop2($_POST['verkOrdId'], $_POST['klantId'], $_POST['artId'], $_POST['verkOrdBestAantal'], $_POST['verkOrdDatum'], $_POST['verkOrdStatus']);
        echo '<script>alert("Klant is gewijzigd")</script>';

        // Toon weer het scherm
        //include "update_form.php";
    }

    if (isset($_GET['verkOrdId'])){
        $row = $verkoop->getVerkoop($_GET['verkOrdId']);
    }
?>

<form method="post">
<input type='hidden' name='verkOrdId' value='<?php echo $row["verkOrdId"];?>'>
<input type='text' name='klantId' required value="<?php echo $row["klantId"];?>"> *</br>
<input type='text' name='artId' required value='<?php echo $row["artId"];?>'> *</br>
<input type='text' name='verkOrdBestAantal' required value='<?php echo $row["verkOrdBestAantal"];?>'> *</br>
<input type='text' name='verkOrdDatum' required value='<?php echo $row["verkOrdDatum"];?>'> *</br>
<input type='text' name='verkOrdStatus' required value='<?php echo $row["verkOrdStatus"];?>'> *</br></br>
<input type='submit' name='update' value='Wijzigen'>
</form></br>

<a href='index.php'>Terug</a>

</body>
</html>