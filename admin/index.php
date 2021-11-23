<?php
require ('../inc/pdo.php');
require ('../inc/fonction.php');
require ('../inc/request.php');
session_start();
error403();

include ('inc/header_back.php');
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
                    <h3 class="text-themecolor">Tableau de bord</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
                        <li class="breadcrumb-item active">Tableau de bord</li>
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
                    <div class="row">
                        <!-- Column -->
                        <div class="card">
                            <div class="card-body">
                                Modifier le contenu
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
include ('inc/footer_back.php');