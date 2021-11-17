<?php
require ('inc/fonction.php');
require ('inc/request.php');


include ('inc/header.php'); ?>

    <section id="home_login">
        <div class="wrap0">
            <div class="title_absolute uppercase">
                <h2 class="text-shadow">Connectez</h2>
                <h2 class="text-shadow">Vous !</h2>
            </div>
        </div>
    </section>

    <form action="" method="post" novalidate>

        <input type="email" name="email" id="email" placeholder="Adresse mail" value="">
        <span class="error"></span>
        <input type="password" name="password" id="password" placeholder="Mot de passe" value="">

        <input type="submit" name="submitted" id="submitted" value="Se connecter">
    </form>

<?php
//include ('inc/footer.php');