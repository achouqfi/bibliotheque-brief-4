<?php 
    if (isset($row)) {
        extract($row);
    }

    $result=$connectdb->prepare("SELECT id, name FROM auteur");
    $result->execute();

    $auteurs = $result->fetchAll(PDO::FETCH_ASSOC);
    

    // dump($auteurs)

?>
<form enctype="multipart/form-data" class="form" action="<?php p_base_url($action) ?>" method="POST">
        <?php echo isset($id) ? '<input type="hidden" value="' . $id . '" name="id">' : ""; ?>
        <div class="form-fild">
          <label for="title">Title</label>
          <input type="text" placeholder="title" id="title" name="titre" value="<?php echo isset($titre) ? $titre : ""; ?>"/>
        </div>
        <div class="form-fild">
            <label for="authors">Authors</label>
            <select name="authors[]" id="authors" multiple="multiple">
                <option value="-1" disabled selected>Select an author</option>
                <?php foreach ($auteurs as $auteur) :?>
                    <?php
                        
                        $selected = "";

                        if (isset($id)) {
                            
                            $result=$connectdb->prepare("SELECT id FROM auteur_livre WHERE id_auteur = ? and id_livre = ?");
                            $result->execute([$auteur["id"], $id]);

                            $current_auteur = $result->fetch(PDO::FETCH_ASSOC);

                            $selected = $current_auteur ? "selected": "";

                        }
                    ?>
                    <option value="<?php echo $auteur["id"] ?>" <?php echo $selected ?>><?php echo $auteur["name"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-fild">
          <label for="cover">Cover</label>
            <div class="file">
                <div class="placeholder">
                    Chose File...
                </div>
                <input type="file" placeholder="Full name" id="cover"  name="cover" value="<?php echo isset($cover) ? $cover : ""; ?>" />
            </div>
        </div>
        <div class="form-fild">
          <label for="price">Price</label>
          <input type="number" placeholder="price..." id="price" name="prix" value="<?php echo isset($prix) ? $prix : ""; ?>" />
        </div>
        <?php if (isset($id)): ?>    
            <input class="cta" type="submit" name="update" value="update">
        <?php else: ?>
            <button class="cta" name="submit">Add Book</button>
        <?php endif; ?>
      </form>