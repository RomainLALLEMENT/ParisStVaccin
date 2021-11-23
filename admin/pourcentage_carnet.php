<?php
session_start();
require ('../inc/pdo.php');
require ('../inc/fonction.php');
require ('../inc/request.php');
error403();
$nombreUsers = getNombreUsers();
$nombreCarnets = getNombreUserCarnet();
$pourcentage = getPourcentage($nombreCarnets['UserCarnet'], $nombreUsers['userTotal']);

//afficher la listes des carnets (extrait)
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
                    <h3 class="text-themecolor">Page Statistique</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Statistiques</a></li>
                        <li class="breadcrumb-item active">Page Statistique</li>
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
                    <h2>Il y a <?php echo $pourcentage ?>% de personnes possédant un carnet de vaccination sur Paris Saint Vaccin !</h2>
                </div>
            </div>
        </div>

<?php
include('inc/footer_back.php');