<?php

    $importJsHead = [
        "validation.js"
    ];

    require_once "includes/header.php";
    require_file("/includes/nav.php");



?>

<main class="contact">

    <!--   contact     -->
    <div class="separation">
        <h1>CONTACT</h1>
    </div>
    <form class="formulaire-msg">
        <div class="col">
            <div class="form-fild">
                <input id="name" type="text" placeholder="nom*">
                <div id="mName" class="errors"> </div>
            </div>
            <div class="form-fild">
                <input id="email" type="email" placeholder="email*" required>
                <div id="mEmail" class="errors"> </div>
            </div>
        </div>
        <div class="col">
            <div class="form-fild">
                <input id="phone" placeholder="telephone*">
                <div id="mPhone" class="errors"> </div>
            </div>
            <div class="form-fild">
                <input id="subject" placeholder="sujet*">
                <div id="mSujet" class="errors"> </div>

            </div>
        </div>
        <div class="col">
            <textarea placeholder="Message*" id="message"></textarea>
            <div id="mMessage" class="errors"></div>
        </div>
        <div class="col">
            <button class="cta" onclick="validateForm()">Envoyer</button>
        </div>
    </form>

</main>


<?php

    require_file("/includes/footer.php");
    
?>