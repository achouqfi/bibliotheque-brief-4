<?php
    require_once __DIR__ . "/../config.php";

    if(isset($_POST['submit']))
    {
        $titre=$_POST['titre'];
        $prix=$_POST['prix'];

        $cover = upload("/img-books/gallery/", "cover");
        $result=$connectdb->prepare("INSERT into livre(cover, titre, prix) values(?, ?, ?)");
        $result->execute([$cover, $titre, $prix]);

        $id = $connectdb->lastInsertId();

        // dump($_POST["authors"]);
        foreach ($_POST["authors"] as $id_auteur) {
            add_book_author_relation($id_auteur, $id);
        }


        redirect();
    }