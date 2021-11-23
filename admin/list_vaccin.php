<?php
session_start();
require ('../inc/pdo.php');
require ('../inc/fonction.php');
require ('../inc/request.php');
error403();
include('inc/header_back.php');

if (!empty($_GET['success']) && $_GET['success'] == 1 ) {
    $success = true;
} else {
    $success = false;
}

$listVaccin = getAllVaccin();


?>

    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Liste des vaccins</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Vaccins</a></li>
                        <li class="breadcrumb-item active">Liste des vaccins</li>
                    </ol>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <?php if (!$success) { ?>
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-info-circle"></i> <span style="font-weight: 700;">Bienvenue <?= $_SESSION['user']['prenom']?></span> sur la liste des vaccins
                </div>
            <?php } else { ?>
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-thumbs-up"></i> Félicitations, vos modifications ont bien été pris en compte ! <br>
                    <u>Nous vous invitons à rafraichir la page pour voir vos modifications</u>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Libelle</th>
                                        <th>Temps de rappel</th>
                                        <th>Obligatoire</th>
                                        <th>Pays</th>
                                        <th>Description</th>
                                        <th>Laboratoire</th>
                                        <th>modifier</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <div class="listvaccins"><?php
                                    foreach ($listVaccin as $vaccin){?>
                                        <div>
                                            <tr>
                                                <th><?=$vaccin['libelle']?></th>
                                                <th><?=$vaccin['temps_rappel']?></th>
                                                <th><?php if ($vaccin['obligatoire'] == 1) { echo '<i class="fas fa-check-circle" style="color: green;"></i>'; } else { echo '<i class="fas fa-times-circle" style="color: red;"></i>'; }?></th>
                                                <th><?=$vaccin['pays']?></th>
                                                <th><?=substr($vaccin['description'], 0, 30).'...'?></th>
                                                <th><?=$vaccin['Laboratoire']?></th>
                                                <th><?= '<a href="edit_vaccin.php?id='.$vaccin['id'] . '">Modifier</a>'?></th>
                                            </tr>
                                        </div>
                                    <?php } ?>
                                        </div>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
include('inc/footer_back.php');