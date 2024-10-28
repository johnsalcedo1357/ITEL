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
    <div id="window">
        <div class="formedit">
            <div class="header2">
                <h2>Edit/Delete</h2>
            </div><br>
    <form method="POST">
        <input type="hidden" id="itemid" name="itemid">
        <label for="itemname">Item Name: </label>
        <input type="text" id="itemname" name="itemname" class="texbox"><br>
        <label for="itemprice">Item Price: </label>
        <input type="text" id="itemprice" name="itemprice" class="texbox"><br>
        <div class="parallelogram2">
        <input type="submit" name="edit" value="Edit" class="button">
        </div>
        <div class="parallelogram2">
        <input type="submit" name="delete" value="Delete" class="button">
        </div>
    </form>
    <br>
        </div>
    </div>
        <div>
        <audio hidden autoplay loop src="assets/Irasshaimase.ogg">
        </div>
    <div class="category">
    <div class="botlog2">
        <center><h2>Tab 1</h2></center>
    </div>
    <div class="botlog">
    <center><h2>Tab 2</h2></center>
    </div>
    <div class="botlog">
    <center><h2>Tab 3</h2></center>
    </div>
    <div class="botlog">
    <center><h2>Tab 4</h2></center>
    </div>
    <div class="botlog">
    <center><h2>Tab 5</h2></center>
    </div>
    <div class="botlog">
    <center><h2>Tab 6</h2></center>
    </div>
    <div class="botlog">
    <center><h2>Tab 7</h2></center>
    </div>
    </div>
    <div class="flex-container">
<?php 
while($row = $result->fetch_assoc()) {
    echo '<div>
    <div class="header">' . htmlspecialchars($row['name']) .  "
    </div>
    " . "<div class='parallelogram' onclick='show(\"" . htmlspecialchars($row['name']) . "\", \"" . htmlspecialchars($row['price']) . "\", \"" . $row['item_id'] . "\")'>
    <center><div class='pricename'>
        <img src='assets/Currency_Icon_Gold.png' class='cred'><p>" . htmlspecialchars($row['price']) . "</p>
        </div></center>
            <p>Edit</p>
        </div>
    </div>";
}
?>
    </div>
    <img src="assets/desk.png" class="desk">
    </div>
</body>
<script src="plugin/script3.js"></script>
</html>
<?php 

if(isset($_POST['delete'])){
    $id = $_POST['itemid'];
    $sql = "DELETE FROM item WHERE item_id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

if(isset($_POST['edit'])){
    $id = $_POST['itemid'];
    $name = $_POST['itemname'];
    $price = $_POST['itemprice'];

    $sql = "UPDATE item SET name = '$name', price = $price WHERE item_id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>