<html lang="en">
<?php
include "db.php";
?>
<head>
    <title>Barcode Reader</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
</head>
<body>
<video autoplay muted loop id="background-video">
  <source src="assets/arona_bg.mp4" type="video/mp4">
  Your browser does not support the video tag.
</video>
<img src="assets/logo.png" class="logo">
<div class="container">
    <div class="formadd">
        <div class="header">
            <h2 style="font-weight:bolder;">Add an Item</h2>
        </div>
    <br>
    <form action="add.php" method="POST">
        <label for="itemid">Item ID: </label>
        <input type="text" id="itemid" name="itemid" class="texbox" required/><br>
        <label for="itemname">Item Name: </label>
        <input type="text" id="itemname" name="itemname" class="texbox" required/><br>
        <label for="itemdesc">Item Description: </label>
        <!-- <input type="text" id="itemdesc" name="itemdesc" value="N/A" class="texbox" required/><br> -->
        <textarea id="itemdesc" name="itemdesc" class="texbox">N/A</textarea><br>
        <label for="itemprice">$</label>
        <input type="text" id="itemprice" name="itemprice" class="texbox" required/>
        <div class="parallelogram">
        <input type="submit" value="Add" class="button"/>
        </div>
    </form>
    <br>
    </div>
    <div class="formsearch">
        <div class="header">
            <h2>Search for an Item</h2>
        </div><br>
    <form action="search.php" method="POST">
        <label for="barcode">Barcode: </label>
        <input type="text" name="barcode" class="texbox"/><br>
        <div class="parallelogram">
        <input type="submit" value="Search" class="button"/>
        </div>
    </form>
    <br>
    </div>
</div>
<audio id="audio" src="assets/Daily_Routine_247.ogg" preload="auto" loop>
</audio>
</body>
<script text="text/javascript" src="plugin/script.js">
</script>
</html>