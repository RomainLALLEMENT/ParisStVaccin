<?php
session_start();
require ('inc/pdo.php');
require ('inc/fonction.php');
require ('inc/request.php');
if (isLogged()) {
    $errors = [];
//    debug($_SESSION);
//    debug($_GET);

    $id_user = $_SESSION['user']['id'];
//    var_dump($id_user);

    $id_carnet = $_GET['id'];
//    var_dump($id_carnet);

    $vaccin = getLibelleMoisByCarnet($id_carnet);
//    debug($vaccin);

    $carnet = getCarnetById($id_carnet);
//    debug($carnet);

    if (!empty ($_POST['submitted'])){
        //faille xss
        $date = cleanXss('date');
        //validation
        $errors = dateValidation($errors,$date, 'date');
//        var_dump($date);
        if ($date ==$carnet['premiere_date']){
            $errors['date'] = 'Vous n\'avez pas modifier la date';
//            debug($errors);
        }

        if (count($errors) == 0 ) {
            carnetModifDateByUser($id_carnet,$vaccin['mois'],$date);
            header('Location: listVaccinsUser.php?success=1');
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
}else{
    header('HTTP/1.0 403 Forbidden');
    header('Location:error403.php');

}