<?php
    require_once __DIR__ . "/../config.php";

    $id=$_POST['id'];
    $titre=$_POST['titre'];
    $prix=$_POST['prix'];
    $cover=$_POST['cover'];
    
    $result=$connectdb->query("SELECT cover FROM livre WHERE id = $id");

    $result= $result->fetch(PDO::FETCH_ASSOC);
    
    $cover = $result["cover"];
    
    
    if  (isset($_FILES["cover"]) && $_FILES["cover"]["name"] != "") {
        $cover = upload("/img-books/gallery/", "cover");
        // dump($_FILES["cover"]["name"]);
    }

    $result=$connectdb->prepare("UPDATE `livre` SET  `titre` = '$titre', `cover` = '$cover' , `prix` = '$prix' WHERE `id` = '$id';");
    $result->execute();

    $result=$connectdb->prepare("SELECT id_auteur FROM auteur_livre WHERE id_livre = ?");
    $result->execute([$id]);

    $current_livre_auteurs = $result->fetchAll(PDO::FETCH_ASSOC);


    // Remove existent relations that are not existent in the $_POST["authors"]
    foreach ($current_livre_auteurs as $current_livre_auteur) {

        if (!in_array($current_livre_auteur["id_auteur"], $_POST["authors"])) {
            remove_book_author_relaten($current_livre_auteur["id_auteur"], $id);
        }

    }


    // Add non existent relations
    foreach ($_POST["authors"] as $id_auteur) {
        $result=$connectdb->prepare("SELECT id FROM auteur_livre WHERE id_auteur = ? and id_livre = ?");
        $result->execute([$id_auteur, $id]);

        $current_auteur = $result->fetch(PDO::FETCH_ASSOC);

        if (!$current_auteur) {
            add_book_author_relation($id_auteur, $id);
        }
    }


    redirect();

?>