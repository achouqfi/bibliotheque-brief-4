<?php 
    if (isset($row)) {
        extract($row);
        $result=$connectdb->prepare("SELECT id, name FROM auteur WHERE id IN (SELECT id_auteur FROM auteur_livre WHERE id_livre = ?)");
        $result->execute([$id]);

        $auteurs = $result->fetchAll(PDO::FETCH_ASSOC);

    }

?>
<form enctype="multipart/form-data" class="form" action="<?php p_base_url($action) ?>" method="POST">

    <?php echo isset($id) ? '<input type="hidden" value="' . $id . '" name="id">' : ""; ?>
    <div class="form-fild">
        <div class="file">
            <img class="close-icon" src="<?php p_base_url("/icon/close.svg") ?>" title="clear image" alt="clear image">
            <img class="file-image" <?php 
                    $cover = isset($cover) ? $cover : "0cee7e54fda8ac99ec11459448e89c7d.jpg"
                ?> src="<?php p_base_url("/img-books/gallery/$cover") ?>" alt="" srcset="">
            <label for="" class="placeholder">
                <img src="<?php p_base_url("/icon/upload.svg") ?>" alt="" srcset="">
                <span>Chose Cover</span>
            </label>
            <input type="file" placeholder="Full name" id="cover" name="cover" />
            <input type="hidden" placeholder="Full name" id="cover" name="cover" value="<?php echo $cover ?>" />
        </div>
    </div>
    <div class="right">

        <div class="form-fild authors">
            <label for="authors">Authors</label>
            <div class="textarea">
                <div class="input">
                    <?php if (isset($auteurs )): foreach ($auteurs as $auteur) :?>
                    <span class="author">
                        <input type="hidden" name="authors[]" value="<?php echo $auteur["id"]?>" />
                        <?php echo $auteur["name"]?>
                        <img class="close-icon" src="/icon/close.svg" title="remove author" alt="clear image">
                    </span>
                    <?php endforeach; endif; ?>
                    <input type="text" />
                </div>
            </div>
        </div>
        <div class="form-fild">
            <label for="title">Title</label>
            <input type="text" placeholder="title" id="title" name="titre"
                value="<?php echo isset($titre) ? $titre : ""; ?>" />
        </div>
        <div class="form-fild">
            <label for="price">Price</label>
            <input type="number" placeholder="price..." id="price" name="prix"
                value="<?php echo isset($prix) ? $prix : ""; ?>" />
        </div>
        <?php if (isset($id)): ?>
        <input class="cta" type="submit" name="update" value="update">
        <?php else: ?>
        <button class="cta" name="submit">Add Book</button>
        <?php endif; ?>
    </div>

</form>