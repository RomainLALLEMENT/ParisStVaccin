<?php
require ('inc/pdo.php');
require ('inc/fonction.php');
require ('inc/request.php');
include ('inc/header.php');
debug($_SESSION);
?>
<section id="home">
    <div class="wrap0">
        <div class="title_absolute uppercase">
            <h2 class="text-shadow">Vaccinez</h2>
            <h2 class="text-shadow">Vous !</h2>
            <a href="#">Connexion</a>
        </div>
    </div>
</section>

<section id="panel_buttons">
    <div class="wrap2 uppercase">
        <div class="container">
            <div class="element1">
                <div class="img1"></div>
                <a href="#">Se faire vacciner</a>
            </div>
            <div class="element2">
                <div class="img2"></div>
                <a href="#">Carnet de vaccination</a>
            </div>
            <div class="element3">
                <div class="img3"></div>
                <a href="#">Les vaccins</a>
            </div>
        </div>
    </div>
</section>

<?php

include ('inc/footer.php');