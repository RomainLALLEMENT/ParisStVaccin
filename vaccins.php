<?php
session_start();
require ('inc/pdo.php');
require ('inc/fonction.php');
require ('inc/request.php');
include ('inc/header.php');
$vaccins = getAfficherVaccin();
if (!empty($_POST['submitted'])&& $_POST['submitted']!=' ') {
    $recherche = cleanXss('submitted');
    $recherche = getRechercheVaccin($_POST['submitted']);
   }
if (!empty($recherche))$vaccins = $recherche;
?>

<section id="home">
    <div class="wrap0">
        <div class="title_absolute uppercase">
            <h2 class="text-shadow">Vaccinez</h2>
            <h2 class="text-shadow">Vous !</h2>
            <?php if (empty($_SESSION)) { ?>
                <a href="login.php">Connexion</a>
            <?php } else { ?>
                <a href="listVaccinsUser.php">Mon carnet</a>
            <?php } ?>
        </div>
    </div>
</section>

<section id="vaccins">
    <div class="wrap1">
        <div class="vrecher">
            <form action="" method="post">
                <label for="recherche site">Rechercher des vaccins</label>
                <input type="search" id="site-recherche" placeholder="tapez votre recherche" name="submitted">
            </form>
            <?php
            if (!empty($recherche))echo '<p> Résultats pour : \''.$_POST['submitted'].'\' ';
            ?>
        </div>
        <div class="vaccins"><?php
            foreach ($vaccins as $vaccin){?>
                <div class="vaccin">
                    <div><div class="vimg"></div></div>
                    <h2><?= $vaccin['libelle'];?></h2>
                    <p><?= $vaccin['description'];?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php
include ('inc/footer.php');

