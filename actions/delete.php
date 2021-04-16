<?php
include '../DB.php';
$db = new DB();
$db->deletePlayer($_GET['id']);
header('Location:../crud.php');