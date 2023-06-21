<!DOCTYPE html>
<html>
<head>
    <title>Zoeken op klant ID</title>
</head>
<body>
    <h2>Zoeken op klant ID</h2>
    <form method="GET" action="searchKlant.php">
        <input type="text" name="klantId" placeholder="Voer klant ID in">
        <input type="submit" value="Zoeken">
    </form>

    <?php
    if (isset($_GET['klantId'])) {
        $klantId = $_GET['klantId'];
        require_once 'classes/verkoop.php';
        $verkoop = new Verkoop();
        $result = $verkoop->searchCustomerById($klantId);

        if ($result) {
            echo "<h3>Klantgegevens:</h3>";
            echo "ID: " . $result['klantId'] . "<br>";
            echo "Naam: " . $result['klantNaam'] . "<br>";
            // Voeg hier andere velden toe die je wilt tonen
        } else {
            echo "Geen klant gevonden met het opgegeven ID.";
        }
    }
    ?>
</body>
</html>
