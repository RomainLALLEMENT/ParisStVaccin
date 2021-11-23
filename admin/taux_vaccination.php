<?php
session_start();
require ('../inc/pdo.php');
require ('../inc/fonction.php');
require ('../inc/request.php');
error403();
$nombreUsers = getNombreUsers();
$nombreCarnets = getNombreUserCarnet();
$listVaccin = getAllVaccin();
include('inc/header_back.php');
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
                    <h3 class="text-themecolor">Taux Vaccination</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Statistiques</a></li>
                        <li class="breadcrumb-item active">Taux Vaccination</li>
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
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Libelle</th>
                                    <th>Taux de vaccination</th>
                                    <th>Taux de vaccination utilisateur du site</th>
                                    <th>Mail</th>
                                </tr>
                                </thead>
                                <tbody>
                                <div class="listvaccins"><?php
                                    foreach ($listVaccin as $vaccin){
                                        $taux = getNumberUsersVacinateByVaccin($vaccin['id']);?>
                                        <div>
                                            <tr>
                                                <th><?=$vaccin['libelle']?></th>
                                                <th><?=getPourcentage($taux['nombrePersonneVaccin'], $nombreCarnets['UserCarnet']);?></th>
                                                <th><?=getPourcentage($taux['nombrePersonneVaccin'], $nombreUsers['userTotal']);?></th>
                                                <th><form action=""><input type="submit" name="envoyeMail" value="rappel mail"></form></th>
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

<?php
include('inc/footer_back.php');