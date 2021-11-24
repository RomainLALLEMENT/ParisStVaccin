<?php
require ('../inc/pdo.php');
require ('../inc/fonction.php');
require ('../inc/request.php');
session_start();
error403();

if (!empty($_SESSION['user']['id'])) {

    $id = $_SESSION['user']['id'];

    $sql = "SELECT * FROM psv_user WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $user = $query->fetch();
}

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
            <div class="alert alert-info" role="alert">
                <i class="fas fa-info-circle"></i> <span style="font-weight: 700;">Bienvenue <?= $user['prenom']?></span> sur l'espace administrateur de Paris Saint Vaccin ! Vous pouvez effectuer diverses manipulation comme citées ci-dessous.
            </div>
            <div class="row">
                <!-- Column -->
                <div class="col-lg-4 col-xlg-3 col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <center class="m-t-30"> <img src="assets/images/users/5.jpg" class="img-circle" width="150" />
                                <h4 class="card-title m-t-10"><?= $user['prenom'].' '.$user['nom'] ?></h4>
                                <h6 class="card-subtitle"><?= $user['role'];?></h6>
                                <div class="row text-center justify-content-md-center">
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-lg-8 col-xlg-9 col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div class="users">
                                    <h1>Utilisateurs <i class="fas fa-users"></i></h1>
                                    <ul>
                                        <li><a href="list_user.php"><i class="fas fa-users"></i> Accéder à la liste des utilisateurs</a></li>
                                    </ul>
                                </div>
                                <div class="vaccins">
                                    <h1>Vaccins <i class="fas fa-syringe"></i></h1>
                                    <ul>
                                        <li><a href="list_vaccin.php"><i class="fas fa-syringe"></i> Accéder à la liste des vaccins</a></li>
                                        <li><a href="add_vaccin.php"><i class="fa fa-plus" aria-hidden="true"></i> Ajouter un vaccin</a></li>
                                    </ul>
                                </div>
                                <div class="statistiques">
                                    <h1>Statistiques <i class="fas fa-signal"></i></h1>
                                    <ul>
                                        <li><a href="pourcentage_carnet.php"><i class="fas fa-signal"></i> Accéder au nombre de carnets de vaccinations crées</a></li>
                                        <li><a href="taux_vaccination.php"><i class="fas fa-signal"></i> Accéder au taux de vaccination</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>
        </div>

<?php
include ('inc/footer_back.php');