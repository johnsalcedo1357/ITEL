<?php
include 'db.php';
clear_temp_table();
$result = $conn->query("SELECT * FROM item");

if(!$result){
    die("Query failed: " . $conn->error);
}
?>
<html lang="en">
<head>
    <title>List of Items</title>
    <link rel="stylesheet" href="show.css">
</head>
<body>
<div id="window2" class="box">
<form method="POST" action="add.php">
    <input type="hidden" name="item_id">
    <label for="barcode">ITEM NAME:</label>
    <input type="text" name="item_name">
    <label for="barcode">ITEM PRICE:</label>
    <input type="text" name="item_price">
    <input type="submit" name="ADD" class="box hover" value="ADD">
</form>
</div>
<div id="window3" class="box">
<form method="POST" action="search.php">
    <input type="hidden" name="id">
    <label for="barcode">ITEM NAME:</label>
    <input type="text" name="name">
    <label for="barcode">ITEM PRICE:</label>
    <input type="text" name="price">
    <input type="submit" name="SEARCH" class="box hover" value="SEARCH">
</form>
</div>
<div id="window" class="box">
<form method="POST" action="show.php">
    <input type="hidden" id="itemid" name="itemid">
    <label for="barcode">ITEM NAME:</label>
    <input type="text" id="itemname" name="itemname">
    <label for="barcode">ITEM PRICE:</label>
    <input type="text" id="itemprice" name="itemprice">
    <input type="submit" name="EDIT" class="box hover" value="EDIT">
</form>
</div>
    <div class="container">
    <div class="menu">
        <center>--MENU--</center>
        <div class="box center hover" onclick="index()">GO BACK</div>
        <div class="box center hover" onclick="showadd()">ADD</div>
        <div class="box center hover" onclick="showsearch()">SEARCH</div>
    </div>
    <div class="list">
<?php 
while($row = $result->fetch_assoc()){
    echo "<div class='box contain-r center'>
            <div class='box center'>
            " . $row['item_id'] . "
            </div>
            ITEM NAME: " . $row['name'] . "<br>
            PRICE: ₱" . $row['price'] . "
            <div class='contain-c'>
                <div class='box center hover' onclick='show(\"" . htmlspecialchars($row['name']) . "\", \"" . htmlspecialchars($row['price']) . "\", \"" . $row['item_id'] . "\")'>
                    EDIT
                </div>
                <form method='POST' action='show.php'>
                <input type='hidden' value='" . htmlspecialchars($row['item_id']) . "' name='itemid'>
                <input type='submit' class='box center hover' value='DELETE' name='DELETE'>
                </form>
            </div>
        </div>";
}
?>
    </div>
    </div>
    <audio autoplay loop hidden src="assets/bgm2.mp3">
</body>
<script src="plugin/script2.js"></script>
</html>
<?php
if(isset($_POST['EDIT'])){
    $id = $_POST['itemid'];
    $price = $_POST['itemprice'];
    $name = $_POST['itemname'];
    
    $sql = "UPDATE item
            SET price = ?, name = ?
            WHERE item_id = ?";
    
        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("dsi", $price, $name, $id);
            $stmt->execute();
    }
}

if (isset($_POST['DELETE'])) {
    $id = $_POST['itemid'];

    $stmt = $conn->prepare("DELETE FROM item WHERE item_id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            echo "Error executing query: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
$conn->close();
?>