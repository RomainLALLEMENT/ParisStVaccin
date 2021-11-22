<?php
session_start();
require ('inc/pdo.php');
require ('inc/fonction.php');
require ('inc/request.php');
include ('inc/header.php');
?>

    <section id="home">
        <div class="wrap0">
            <div class="title_absolute uppercase">
                <h2 class="text-shadow">Vaccinez</h2>
                <h2 class="text-shadow">Vous !</h2>
                <a href="login.php">Connexion</a>
            </div>
        </div>
    </section>
<section id="vaccins">
    <div class="wrap1">
    <div class="vrecher">
        <label for="recherche site">Rechercher des vaccins</label>
        <input type="search" id="site-recherche" placeholder="tapez votre recherche">
    </div>
    <?php
    $sql = "SELECT * FROM psv_vaccin ORDER BY RAND() LIMIT 4";
    $query = $pdo->prepare($sql);
    $query->execute();
    $vaccins=$query->fetchAll();

    ?><div class="vaccins"> <?php
            foreach ($vaccins as $vaccin){  ?>
                <div class="vaccin">
                    <div><div class="vimg"></div></div>
                    <h2><?= $vaccin['libelle'];?></h2>
                    <p><?= $vaccin['description'];?></p>
                </div>
                <?php } ?>
        </div>
    </div>
</section>
    <br>
    <br>
    <br>
    <br>
<?php
include ('inc/footer.php');