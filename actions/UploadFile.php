<?php
function uploadfile ($image, $db, $id, $update = false) {
    $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
    $name = uniqid().".".$extension;
   
    if ($update && $image['name']!= "") {
        unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$db->getImage($id));
    }

    if ($image['name']!= "") {
        move_uploaded_file($image['tmp_name'], "../uploads/".$name);
        $db->addImage($id, $name);
    }



}