<?php
include '../bootstrap/bootstrap.php';
$name = $_GET['name'];
$image = $_GET['image'];
?>

<div class="container">
    <h1><?=$name?></h1>
    <a href="../index.php"><input type="submit" value="На главную"></a>
    <br>
    <img src="../uploads/<?=$image?>" width="1000px" height="1000px">
</div>
