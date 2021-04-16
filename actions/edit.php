<?php
include "../bootstrap/bootstrap.php";
include '../DB.php';
include 'UploadFile.php';
$db = new DB();
$player = $_GET['player'];
$id = $_GET['id'];
if (isset($_POST['edit'])) {
    $db->updatePlayer($id, $_POST['name']);
    if ($_FILES['image']!="") {
        uploadfile($_FILES['image'], $db, $id, true);
    }
    header('Location:../crud.php');
}
?>

<div class="container">
    <h1>Редактировать имя</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Имя</label>
        <input type="input" value="<?=$player;?>" class="form-control" name="name">
        <input type="file" name="image" title="Выбирите файл" class="form-control">
        <input type="submit" value="Редактиовать" class="btn btn-success" name="edit">
    </form>
</div>