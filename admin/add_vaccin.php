<?php
session_start();
require ('../inc/pdo.php');
require ('../inc/fonction.php');
require ('../inc/request.php');
error403();
$errors = array(); // soit array(); soit ca [] pour qua c'est un tableau

if (!empty($_POST['submitted'])) {
    //faille xss
    $libelle = cleanXss('libelle');
    $temps_rappel = cleanXss('temps_rappel');
    $country = cleanXss('country');
    $obligatoire = cleanXss('obligatoire');
    $description = cleanXss('description');
    $laboratoire = cleanXss('laboratoire');

    //validation
    $errors = textValidation($errors,$libelle,'libelle', 2,255);
    $errors = textValidation($errors,$temps_rappel,'temps_rappel', 1,3);
    $errors = textValidation($errors,$country,'country', 1,255);
    $errors = textValidation($errors,$description,'description', 5,500);
    $errors = textValidation($errors,$laboratoire,'laboratoire', 2,150);


    if (count($errors) == 0 ) {
        //requete sql

        $sql= "INSERT INTO  psv_vaccin ( libelle, temps_rappel, pays, obligatoire, description, Laboratoire) 
            VALUES (:libelle, :temps_rappel, :pays, :obligatoire, :description, :laboratoire)";
        $query = $pdo->prepare($sql);
        $query->bindValue(':libelle',$libelle, PDO::PARAM_STR);
        $query->bindValue(':temps_rappel',$temps_rappel, PDO::PARAM_INT);
        $query->bindValue(':obligatoire',$obligatoire,PDO::PARAM_STR);
        $query->bindValue(':description',$description, PDO::PARAM_STR);
        $query->bindValue(':laboratoire',$laboratoire,PDO::PARAM_STR);
        $query->execute();
    }
}


include('inc/header_back.php');
?>

    <div class="page-wrapper">
    <?=debug($_POST) ?>
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Blank Page</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- Tab panes -->
                        <div class="card-body">
                            <form class="form-horizontal form-material" method="post" novalidate>
                                <div class="form-group">
                                    <label for="libelle" class="col-md-12">libéllé</label>
                                    <div class="col-md-12">
                                        <input type="text" name="libelle" id="libelle" placeholder="" value="<?= recupInputValue('libelle') ?>" class="form-control form-control-line">
                                        <?= viewError($errors,'libelle') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="temps_rappel" class="col-md-12">Temps rappel</label>
                                    <div class="col-md-12">
                                        <input type="number" name="temps_rappel" id="temps_rappel" placeholder="Nombre de mois" min="3" max="100" value="<?= recupInputValue('temps_rappel') ?>" class="form-control form-control-line">
                                        <?= viewError($errors,'temps_rappel') ?>
                                    </div>
                                </div>

                                <?php

                                    $countrys = [
                                            'fr' => 'France',
                                            'gb' => 'Angleterre',
                                            'de' => 'Allemagne',
                                            'it' => 'Italie',
                                            'es' => 'Espagne'
                                    ];

                                ?>

                                <label class="col-sm-12">Sélectionnez un pays</label>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <select class="form-control form-control-line" name="country" id="v">
                                            <option value="">__sélectionnez__</option>
                                            <?php foreach ($countrys as $key => $country) { ?>
                                            <?php if (!empty($_POST['country']) && $_POST['country'] == $key ) { ?>
                                                <option value="<?= $key ?>" selected><?= $country ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $key ?>"><?= $country ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <?= viewError($errors,'country') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span>Vaccin obligatoire ?</span>
                                    <div class="col-sm-12">
                                        <div>
                                            <input type="radio" id="obligatoire_false" name="obligatoire" value="0"
                                                   checked>
                                            <label for="obligatoire_false">Non</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="obligatoire_true" name="obligatoire" value="1">
                                            <label for="obligatoire_true">Oui</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-md-12">Description</label>
                                    <div class="col-sm-12">
                                        <textarea name="description" id="description" class="form-control form-control-line" style="height: 200px; padding: 1rem"><?= recupInputValue('description')?></textarea>
                                        <?= viewError($errors,'description') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="laboratoire" class="col-md-12">Laboratoire</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="laboratoire" id="laboratoire" value="<?= recupInputValue('laboratoire')?>" class="form-control form-control-line">
                                        <?= viewError($errors,'laboratoire') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="btn btn-success" type="submit" name="submitted" id="submitted" value="Update">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
include('inc/footer_back.php');