<?php

    $importJsHead = [
        "file.js",
        "fetch.js",
        "book.js"
    ];

    require_once __DIR__ . "/../includes/header.php";

    require_file("/includes/nav.php");
    $eid= $_GET["eid"];
    $result=$connectdb->prepare("SELECT * FROM livre WHERE id=$eid");
    $result->execute();

    $row = $result->fetch(PDO::FETCH_ASSOC);

    $action = "/books/editprocess.php?redirect=" . BASE_URL . "/books.php";


?>

<section class="edit">

    <?php 
        require_file("/includes/form_book.php", [
            "action" => $action,
            "row" => $row,
            "connectdb" => $connectdb
        ]);
    
    ?>


</section>

<?php require_file("/includes/footer.php") ?>