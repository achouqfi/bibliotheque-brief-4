<?php

    $importJsHead = [
        "faker.js",
        "filter.js",
    ];

    require_once "includes/header.php";
    require_file("/includes/nav.php");
  
    
    $result=$connectdb->query('SELECT * FROM livre');
    $result->execute();

    $books = $result->fetchAll();

?>

<main class="gallery">
    <div class="separation">
        <h1>Gallery</h1>
    </div>

    <form class="form" id="filter">
        <div class="form-fild">
            <label for="author">Author</label>
            <select name="author" id="author">
                <option value="-1" disabled selected>Select an author</option>
            </select>
        </div>
        <div class="form-fild">
            <label for="min_prix">Min prix</label>
            <input name="min_prix" type="number" id="min_prix" />
        </div>
        <div class="form-fild">
            <label for="max_prix">Max prix</label>
            <input type="number" name="max_prix" id="max_prix" />
        </div>

        <button class="cta">Search</button>
    </form>



    <?php 
    
        // dump($books);
    ?>

    <section class="gallery-images">
        <div class="images" id="books">
            <?php foreach ($books as $book) : ?>
            <?php extract($book) ?>
            <div class="card">
                <?php 
                    $imageURL = BASE_URL . "/img-books/gallery/";
                     $cover = !empty($cover) || $cover != "" ? $cover : "0cee7e54fda8ac99ec11459448e89c7d.jpg";
                    //  dump($cover);
                     $fullImageURL = $imageURL . $cover;
                ?>
                <img src="<?php echo $fullImageURL ?>" alt="" />
                <div class="text">
                    <h2 class="title"><?php echo $titre ?><span class="prix"><?php echo $prix ?> dh</span></h2>
                    <h3 class="author" data-author-id="0">
                        <a href="">Book author</a>
                    </h3>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>


<?php

    require_file("/includes/footer.php");
    
?>