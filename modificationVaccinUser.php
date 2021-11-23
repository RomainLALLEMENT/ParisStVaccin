<?php
session_start();
require ('inc/pdo.php');
require ('inc/fonction.php');
require ('inc/request.php');
error403();
$errors = [];
debug($_SESSION);
debug($_GET);

$id_user = $_SESSION['user']['id'];
var_dump($id_user);

$id_carnet = $_GET['vaccin'];
var_dump($id_carnet);

$vaccin = getLibelleMoisByCarnet($id_carnet);
debug($vaccin);

$carnet = getCarnetById($id_carnet);
debug($carnet);

if (!empty ($_POST['submitted'])){
    echo ('boutton soumis');
    //faille xss
    $date = cleanXss('date');
    //validation
    $errors = dateValidation($errors,$date, 'date');
    var_dump($date);
    if ($date ==$carnet['premiere_date']){
        $errors['date'] = 'veuillez changer la date';
        debug($errors);
    }
}


include ('inc/header.php');?>

<section id="home_modif_vaccin">
        <div class="wrap3">
            <form action="" method="post" novalidate>
                <div class="wrap4">
                   <h2>Libelle du vaccin : <?= $vaccin['libelle']?></h2>
                    <div class="input_group">
                        <label for="date">Date d'injection</label>
                        <input type="date" name="date" id="date" value="<?= $carnet['premiere_date'] ?>">
                        <?php viewError($errors,'date')  ?>
                    </div>



                    <input type="submit" name="submitted" id="submitted" value="Enregistrer">
                </div>
            </form>
        </div>
    </section>







<?php
include ('inc/footer.php');