<?php
include 'db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['barcode'])) {
    $barcode = $_POST['barcode'];

    $stmt = $conn->prepare("SELECT * FROM item WHERE barcode = ?");
    $stmt->bind_param("s", $barcode);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $insertstmt = $conn->prepare("INSERT INTO temp (name, price) VALUES (?, ?)");
            $insertstmt->bind_param("sd", $row['name'], $row['price']);

            if ($insertstmt->execute()) {
                echo "Inserted into temp: " . htmlspecialchars($row['name']) . " - " . htmlspecialchars($row['price']) . "<br>";
            } else {
                echo "Insertion error: " . htmlspecialchars($insertstmt->error) . "<br>";
            }
            $insertstmt->close();
        }
    } else {
        $message = "No item found with that barcode.";
    }
    $stmt->close();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$tempstmt = $conn->prepare("SELECT * FROM temp");
$tempstmt->execute();
$tempResult = $tempstmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show</title>
    <link rel="stylesheet" href="search.css">
</head>
<body>
    <?php if($tempResult->num_rows > 0)?>
    <div class="container">
    <table>
    <tr>
        <th>NAME</th>
        <th>PRICE</th>
    </tr>
    <?php
        while ($tempRow = $tempResult->fetch_assoc()) {
            echo "<tr><td>" . htmlspecialchars($tempRow['name']) ."</td>";
            echo "<td>" . htmlspecialchars($tempRow['price'])."</td></tr>";
        }
    ?>
    </table>
    <?php
    $tempstmt->close();

    if (isset($_POST['add_all'])) {
    $totalstmt = $conn->prepare("SELECT SUM(price) AS total_price FROM temp");
    $totalstmt->execute();
    $totalResult = $totalstmt->get_result();
    $totalRow = $totalResult->fetch_assoc();

    if ($totalRow && $totalRow['total_price'] !== null) {
        $message = "Total Price: " . htmlspecialchars($totalRow['total_price']);
    } else {
        $message = "No items in the temp table.";
    }
    $totalstmt->close();    
    } else {
        $message = '';
    }
    ?>
        <?php if(!empty($message)): ?>
        <div class="box"><?php echo $message; ?></div>
        <?php endif; ?>
        <center>
        <form method="POST">
        <button type="submit" name="add_all" class="box hover">Add all</button>
        </form>
        </center>
        <div class="box hover small center"><a href="index.php">GO BACK</a></div>
        </div>
    <audio autoplay loop hidden src="assets/bgm2.mp3">
</body>
</html>
<?php $conn->close();?>
