<?php
$result = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $bool = $_POST['parent'];

    if(!$bool){
        $result = "You are the father!";
    } else {
        $result = "You are NOT the father!";
    }
}
?>
<html lang="en">
<head>
    <title>NEGATE</title>
</head>
<body>
    <center>
    <h1>ARE YOU THE FATHER OF THIS CHILD!?</h1>
    <img src="https://media-cldnry.s-nbcnews.com/image/upload/t_fit-560w,f_auto,q_auto:best/streams/2013/January/130114/1B5514190-tdy-130113-Eli-alien-baby-01.jpg">
    <form action="skilltest.php" method="POST">
        <label for="parent">Father</label>
    <input type="checkbox" name="parent"><br>
    <input type="submit" value="Submit">
    </form>
    <p><?php echo $result; ?></p>
    </center>
</body>
</html>