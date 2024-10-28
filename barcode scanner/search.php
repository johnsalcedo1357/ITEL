<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search = $_POST['barcode'];
    $message = '';
    $message2 = '';
    $message3 = '';
    $stmt = $conn->prepare("SELECT * FROM item WHERE barcode = ?");
    $stmt->bind_param("s", $search);
    $stmt->execute();

    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $aoi = 'assets/aoi1.png';
            $message = "Found the item: " . htmlspecialchars($row['name']);
            $message2 = "Description is: " . htmlspecialchars($row['description']);
            $message3 = "It costs " . htmlspecialchars($row['price']);
        }
    } else {
        $aoi = 'assets/aoi2.png';
        $message = "No results found.";
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
    <link rel="stylesheet" href="search.css">
</head>
<body>
            <div class="container">
                <div class="header"></div>
                <h3 class="next" id="hidden-text" style="display:none;">▼</h3>
        <div class="dialogue">
            <div class="name"><strong><h1>Aoi</h1></strong></div>
    <p><?php echo $message; ?><br><?php echo $message2; ?><br><?php echo $message3; ?></p>
        </div>
            </div>
    <center><img src="<?php echo $aoi; ?>" alt="aoi.png" class="image"></center>
</body>
<script text="text/javascript" src="plugin/script2.js"></script>
</html>