<?php
include 'db.php';

function generateBarcode($conn) {
    $count = 1;
    do {
        $barcode = strtoupper(bin2hex(random_bytes(10))); // Generate a 20-character string
        $stmt = $conn->prepare("SELECT COUNT(*) FROM item WHERE barcode = ?");
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
        $stmt->bind_param("s", $barcode);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
    } while ($count > 0); // Repeat until a unique barcode is found

    return $barcode;
}

$arona = 'assets/_arona2.png';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $itemid = $_POST['itemid'];
    $itemname = $_POST['itemname'];
    $itemdesc = $_POST['itemdesc'];
    $itemprice = $_POST['itemprice'];
    $barcode = generateBarcode($conn);

    // VALIDATION
    if (empty($itemid) || !is_numeric($itemid) || intval($itemid) <= 0) {
        $message = "Invalid Item ID.";
    } elseif (empty($itemname)) {
        $message = "Item name cannot be empty.";
    } elseif (empty($itemprice) || !is_numeric($itemprice) || floatval($itemprice) < 0) {
        $message = "Invalid Price.";
    } else {
        $itemid = intval($itemid);
        $itemprice = floatval($itemprice);

    // Check if item already exists
        $checkStmt = $conn->prepare("SELECT name FROM item WHERE item_id = ?");
        if ($checkStmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
        $checkStmt->bind_param("i", $itemid);
        $checkStmt->execute();
        $checkStmt->bind_result($fetchedName);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($fetchedName !== null && $fetchedName !== $itemname) {
            $message = "Error: An item with this ID already exists with a different name.";
        } else {
    // Add item
            $insertStmt = $conn->prepare("INSERT INTO item (item_id, barcode, name, description, price) VALUES (?, ?, ?, ?, ?)");
            if ($insertStmt === false) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }
            $insertStmt->bind_param("isssd", $itemid, $barcode, $itemname, $itemdesc, $itemprice);
            if ($insertStmt->execute()) {
                $arona = 'assets/_arona1.png';
                $message = "New record created successfully!";
            } else {
                $message = "Error: " . htmlspecialchars($insertStmt->error);
            }
            $insertStmt->close();
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="add.css">
</head>
<body>
            <div class="container">
                <div class="header"></div>
                <h3 class="next" id="hidden-text" style="display:none;">▼</h3>
        <div class="dialogue">
            <div class="name"><strong><h1>Arona</h1></strong></div>
    <p><?php echo $message; ?></p>
        </div>
            </div>
    <center><img src="<?php echo $arona; ?>" alt="arona.png" class="image"></center>
</body>
<script text="text/javascript" src="plugin/script2.js"></script>
</html>
