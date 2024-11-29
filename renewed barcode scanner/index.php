<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ULTRASCAN</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<svg width="auto" height="auto">
        <text x="50%" y="75%">
            Barcode Scanner
        </text></svg>
<div id="div">
    <div id="div1" onclick="showsearch()">SEARCH</div>
    <div id="div2" onclick="showadd()">ADD</div>
    <div id="div3">SHOW</div>
</div>
<div id="search">
<form method="POST" action="search.php">
    <label for="barcode">BARCODE:</label><br>
    <input type="text" name="barcode"><br>
    <input type="submit" value="SUBMIT">
</form>
</div>
<div id="add">
<form method="POST" action="add.php">
    <label for="barcode">ITEM NAME:</label>
    <input type="text" name="itemname">
    <label for="barcode">ITEM PRICE:</label>
    <input type="text" name="itemprice">
    <input type="submit" value="SUBMIT">
</form>
</div>
<audio autoplay loop hidden src="assets/bgm.mp3">
</body>
<script src="plugin/script.js"></script>
</html>