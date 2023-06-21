<?php

require_once 'classes/verkoop.php';

// Maak een instantie van de Verkoop-klasse
$verkoop = new Verkoop();

// Verwerk het formulier als het wordt verzonden
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['verkOrdId'];
    $statusId = $_POST['verkOrdStatus'];
    
    // Werk de bestelstatus bij
    $verkoop->updateOrderStatus($orderId, $statusId);
    echo 'Bestelstatus succesvol bijgewerkt!';
    exit;
}

// Haal de lijst met bestellingen op
$orderList = $verkoop->getOrderList();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Orderstatus bijwerken</title>
</head>
<body>
    <h1>Orderstatus bijwerken</h1>
    <form method="POST" action="updateStatus.php">
        <label for="verkOrdId">Selecteer een bestelling:</label>
        <select name="verkOrdId" id="verkOrdId">
            <?php foreach ($orderList as $order): ?>
                <option value="<?php echo $order['verkOrdId']; ?>"><?php echo $order['verkOrdId']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="verkOrdStatus">Selecteer een nieuwe status:</label>
        <select name="verkOrdStatus" id="verkOrdStatus">
            <option value="1">1. Genoteerd</option>
            <option value="2">2. Picking</option>
            <option value="3">3. Bezorging</option>
            <option value="4">4. Bezorgd</option>
        </select>
        <br>
        <input type="submit" value="Update status">
    </form>
</body>
</html>
