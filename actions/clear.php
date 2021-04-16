<?php
include '../DB.php';
$db = new DB();
$db->clear();

header('Location:../crud.php');