<?php
include "../bootstrap/bootstrap.php";
include '../DB.php';
include 'UploadFile.php';
session_start();
$db = new DB();

if (isset($_POST['create'])) {
    if ($_POST['name']!="") {
        $db->createPlayer($_POST['name']);
        uploadfile($_FILES['image'], $db, $db->getId());
        header('Location:../crud.php');
        $_SESSION['crate'] = true;
    }
    $_SESSION['create'] = false;
}
?>

<div class="container">
    <h1>Создать игрока</h1>
    <?php if (!$_SESSION['create']) :?>
        <div class="alert alert-info">
            <p style="color: red">Ошибка</p>
        </div>
    <?php endif;?>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Имя</label>
        <input type="input" value="" placeholder="Введите имя игрока" class="form-control" name="name">
        <input type="file" name="image" title="Выбирите файл" class="form-control">
        <input type="submit" value="Создать" class="btn btn-success" name="create">
    </form>
</div>
