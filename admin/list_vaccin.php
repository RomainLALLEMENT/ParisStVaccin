<?php
session_start();
require ('../inc/pdo.php');
require ('../inc/fonction.php');
require ('../inc/request.php');
error403();
include('inc/header_back.php');
global $pdo;
$sql = "SELECT * FROM `psv_vaccin` WHERE 1";
$query = $pdo->prepare($sql);
$query->execute();
$listVaccin = $query->fetchAll();
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
                            <table class="table">
                                <tr>
                                    <th>Libelle</th>
                                    <th>Temps de rappel</th>
                                    <th>Obligatoire</th>
                                    <th>Pays</th>
                                    <th>Description</th>
                                    <th>Laboratoire</th>
                                </tr>
                                <div class="listvaccins"><?php
                                    foreach ($listVaccin as $vaccin){?>
                                        <div class="vaccin">
                                            <tr>
                                                <th><?=$vaccin['libelle']?></th>
                                                <th><?=$vaccin['temps_rappel']?></th>
                                                <th><?=$vaccin['obligatoire']?></th>
                                                <th><?=$vaccin['pays']?></th>
                                                <th><?=$vaccin['description']?></th>
                                                <th><?=$vaccin['Laboratoire']?></th>
                                            </tr>
                                        </div>
                                    <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include('inc/footer_back.php');