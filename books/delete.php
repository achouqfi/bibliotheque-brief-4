<?php
    require_once __DIR__ . "/../config.php";
    $did=$_GET['did'];
    $result=$connectdb->prepare("DELETE FROM livre WHERE id=$did");
    $result->execute();
    redirect();
?>