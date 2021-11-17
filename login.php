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

    <div class="wrap3">
        <form action="" method="post" novalidate>
            <div class="wrap4">

                <div class="input_group">
                    <label for="email">Adresse mail</label>
                    <input type="email" name="email" id="email" placeholder="monemail@example.com" value="">
                    <span class="error"></span>
                </div>

                <div class="input_group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="Mot de passe" value="">
                </div>

                <input type="submit" name="submitted" id="submitted" value="Se connecter">
            </div>
        </form>
    </div>


<?php
//include ('inc/footer.php');