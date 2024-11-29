<?php
include 'db.php';
clear_temp_table();
function generateBarcode($conn) {
    $count = 1;
    do {
        $barcode = strtoupper(bin2hex(random_bytes(10)));
        $stmt = $conn->prepare("SELECT COUNT(*) FROM item WHERE barcode = ?");
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
        $stmt->bind_param("s", $barcode);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
    } while ($count > 0);

    return $barcode;
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $price = $_POST['itemprice'];
    $name = $_POST['itemname'];
    $barcode = generateBarcode($conn);

    if (empty($name)) {
        $message = "Item name cannot be empty.";
    } elseif (empty($price) || !is_numeric($price) || floatval($price) < 0) {
        $message = "Invalid Price.";
    } else {
        $price = floatval($price);

            // // Add item
            // $insertStmt = $conn->prepare("INSERT INTO item (barcode, name, price) VALUES (?, ?, ?)");
            // if ($insertStmt === false) {
            //     die('Prepare failed: ' . htmlspecialchars($conn->error));
            // }
            // $insertStmt->bind_param("ssd", $barcode, $name, $price);
            // if ($insertStmt->execute()) {
            //     $message = "Item added.";
            // } else {
            //     $message = "Error: " . htmlspecialchars($insertStmt->error);
            // }
            // $insertStmt->close();

            add($barcode, $name, $price);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <link rel="stylesheet" href="add.css">
</head>
<body>
    <div class="box up">
    <?php echo $message; ?>
    </div>
    <div class="box">
        <a href="index.php">GO BACK</a>
    </div>
</body>
</html>
<?php
$conn->close();
?>