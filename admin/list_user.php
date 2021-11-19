<?php
require ('../inc/pdo.php');
require ('inc/request.php');
require ('../inc/fonction.php');
global $pdo;
$sql = "SELECT id,nom,prenom,age,email,pseudo FROM psv_user";
$query = $pdo->prepare($sql);
$query->execute();
$users = $query->fetchAll();
$carnet = getVaccinsUser(2);
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
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Numéro</th>
                                        <th>Pseudo</th>
                                        <th>Prenom</th>
                                        <th>Nom</th>
                                        <th>Age</th>
                                        <th>Email</th>
                                        <th>Vaccin</th>
                                    </tr>
                                    </thead>
                                    <tbody><?php
                                    foreach ($users as $user){ ?>
                                    <tr>
                                        <td><?=$user['id']?></td>
                                        <td><?=$user['pseudo']?></td>
                                        <td><?=$user['prenom']?></td>
                                        <td><?=$user['nom']?></td>
                                        <td><?=$user['age']?></td>
                                        <td><?=$user['email']?></td>
                                        <td><?php if (empty($carnet['id_vaccin'])){
                                            echo 'ok';
                                            }else{
                                            echo 'ko';
                                            }?></td>
                                    </tr> <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <?=debug($users);?>
                                <?=debug($carnet);?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
include('inc/footer_back.php');