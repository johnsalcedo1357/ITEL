<?php
include 'db.php';

$result = $conn->query("SELECT * FROM item");

if(!$result){
    die("Query failed: " . $conn->error);
}
?>
<html lang="en">
<head>
    <title>Show</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="show.css">
</head>
<body>
    <div class="blur">
        <div>
        <audio hidden autoplay loop src="assets/Irasshaimase.ogg">
        </div>
    <div class="category">
    <div class="botlog2">
        <center><h2>Normal</h2></center>
    </div>
    <div class="botlog">
    <center><h2>Eligma</h2></center>
    </div>
    <div class="botlog">
    <center><h2>Eligma II</h2></center>
    </div>
    <div class="botlog">
    <center><h2>Total Assault</h2></center>
    </div>
    <div class="botlog">
    <center><h2>Grand Assault</h2></center>
    </div>
    <div class="botlog">
    <center><h2>Expert Permit</h2></center>
    </div>
    <div class="botlog">
    <center><h2>Joint Firing Drill</h2></center>
    </div>
    </div>
    <div class="flex-container">
<?php 
while($row = $result->fetch_assoc()) {
    echo '<div><div class="header">' . $row['name'] .  "</div>" . "<div class='parallelogram'><center><div class='pricename'><img src='assets/Currency_Icon_Gold.png' class='cred'><p>" . $row['price'] . "</p></div></center><p>Purchase</p></div></div>";
}
?>
    </div>
    <img src="assets/desk.png" class="desk">
    </div>
</body>
</html>
<?php 
$conn->close();
?>