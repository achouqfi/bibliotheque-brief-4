<?php
    require_once __DIR__ . "\\..\\config.php";

    $id=$_POST['id'];
    $name=$_POST['name'];
    $DDN=$_POST['date_de_naissance'];
    $photo=$_POST['photo'];

    dump($photo);

    $result=$connectdb->prepare("UPDATE `auteur` SET  `name` = '$name', `DDN` = '$DDN', `photo` = '$photo' WHERE `id` = '$id';"); 
    $result->execute();
    
    // redirect();
?>