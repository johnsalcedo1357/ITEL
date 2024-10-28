<?php
include 'db.php';
$rng = mt_rand(1,4);
$chosen = "";
$name = "";
switch($rng){
    case 1:
    $chosen = "assets/momoi";
    $name = "momoi";
        break;
    case 2:
    $chosen = "assets/midori";
    $name = "midori";
        break;
    case 3:
    $chosen = "assets/yuzu";
    $name = "yuzu";
        break;
    case 4:
    $chosen = "assets/aris";
    $name = "aris";
        break;
    default:
    $chosen = "assets/arona";
    $name = "arona";
    }
    $chosen .= "1.png";
?>

<html lang="en">
<head>
    <title>Add an Item</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="itemadd.css">
</head>
<body>
    <div class="container">
<div class="formadd">
        <div class="header">
            <h2 style="font-weight:bolder;">Add an Item</h2>
        </div>
    <br>
    <form action="add.php" method="POST">
        <label for="itemname">Item Name: </label>
        <input type="text" id="itemname" name="itemname" class="texbox" required/><br>
        <label for="itemprice">$</label>
        <input type="text" id="itemprice" name="itemprice" class="texbox" required/><br>
        <div class="parallelogram">
        <input type="submit" value="Add" class="button"/>
        </div>
    </form>
    <br>
</div>
    <!-- <img src="<?php echo $chosen ?>" id="image">
    <button id="button" class ="<?php echo $name ?>" onclick="headpat()"></button> -->
</div>
    <audio autoplay src="assets/Pixel_Time.mp3" preload="auto" loop>
</body>
<script src="plugin/script4.js"></script>
</html>