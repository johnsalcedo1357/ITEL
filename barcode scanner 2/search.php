<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search = $_POST['barcode'];
    $message = '';
    $stmt = $conn->prepare("SELECT * FROM item WHERE barcode = ?");
    $stmt->bind_param("s", $search);
    $stmt->execute();

    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $plana = 'assets/plana1.png';
            $message = "Found: " . htmlspecialchars($row['name']);
        }
    } else {
        $plana = 'assets/plana2.png';
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
            <div class="name"><strong><h1>Plana</h1></strong></div>
    <p><?php echo $message; ?></p>
    <p><?php echo $message2?></p>
        </div>
            </div>
    <center><img src="<?php echo $plana; ?>" alt="plana.png" class="image"></center>
</body>
<script text="text/javascript" src="plugin/script2.js"></script>
</html>