<?php
include "DB.php";
session_start();
$db = new DB();
$players = $db->getPlayers();
include 'table.php';
include "bootstrap/bootstrap.php";
?>


