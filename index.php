<?php
session_start();
require ('inc/pdo.php');
require ('inc/fonction.php');
require ('inc/request.php');
include ('inc/header.php');
//debug($_SESSION);
?>
<section id="home">
    <div class="wrap0">
        <h2 class="text-shadow">Vaccinez</h2>
        <h2 class="text-shadow">Vous !</h2>
        <?php if (empty($_SESSION)) { ?>
            <a href="login.php">Connexion</a>
        <?php } else { ?>
            <a href="listVaccinsUser.php">Mon carnet</a>
        <?php } ?>
    </div>
</section>

<section id="panel_buttons">
    <div class="wrap2 uppercase">
        <div class="container">
            <div class="element1">
                <div class="img1"></div>
                <a class="link" href="add_vaccin_user.php">Se faire vacciner</a>
            </div>
            <div class="element2">
                <div class="img2"></div>
                <a class="link" href="listVaccinsUser.php">Carnet de vaccination</a>
            </div>
            <div class="element3">
                <div class="img3"></div>
                <a class="link" href="vaccins.php">Les vaccins</a>
            </div>
        </div>
    </div>
</section>

<?php

include ('inc/footer.php');