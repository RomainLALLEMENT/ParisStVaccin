<?php
session_start();
require ('../inc/pdo.php');
require ('../inc/fonction.php');
require ('../inc/request.php');
require '../vendor/autoload.php';

use JasonGrimes\Paginator;

error403();
// verifier l'id corespond à un user présent en base
$idUsers = getAllIdUsers();

$idUserValid =verifyIdBdd($_GET['id'],$idUsers);


if($idUserValid){
	if(!empty($_GET['id']))$idUser =$_GET['id'];
	$infoVaccinsUser = getVaccinsUserByCarnetOld($idUser);
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
	                <h3 class="text-themecolor">Carnet de santé</h3>
	                <ol class="breadcrumb">
	                    <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
	                    <li class="breadcrumb-item active">Carnet de santé</li>
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
	                    <div class="card-body"><?php
	                        $infoUser = getUser($idUser);
	                        if(!empty(getVaccinsUser($idUser))){ ?>
	                            <h2><?php echo ('Carnet de santé de : '. $infoUser['prenom'].' '.$infoUser['nom']); ?></h2>
	                            <div class="table-responsive">
	                                <table class="table">
	                                    <thead>
	                                        <tr>
	                                            <th>libelle</th>
	                                            <th>laboratoire</th>
	                                            <th>Obligatoire</th>
	                                            <th>pays</th>
	                                            <th>Date de dernière injection</th>
	                                            <th>Date rappel</th>
	                                        </tr>
	                                    </thead><?php
	                                    foreach ($infoVaccinsUser as $info){?>
	                                    <tbody>
	                                    <tr>
	                                        <td><?=$info['libelle']?></td>
	                                        <td><?=$info['Laboratoire']?></td>
	                                        <td><?php if($info['obligatoire']){echo'oui';}else{echo'non';}?></td>
	                                        <td><?php if($info['pays'] == 'France'){echo $info['pays'];}else{echo'non connus';}?></td>
	                                        <td><?=date('d/m/Y',strtotime($info['date dernière injection']))?></td>
	                                        <td><?php if(($info['date rappel'])== ($info['date dernière injection'])){echo date('d/m/Y',strtotime($info['date rappel']));}else{echo 'Pas de rappel pour ce vaccin';}?></td>
	                                    </tr>
	                                    </tbody>
	                                    <?php
	                                        }?>
	                                </table>
	                            </div><?php
	                        }else{?>
	                            <p><?php echo ($infoUser['prenom'].' '.$infoUser['nom'].' n\'a pas de carnet de santé.'); ?></p><?php
	                        } ?>
	                    </div>
	                </div>
	            </div>
	        </div>
	     </div>

	        <?php
	?>

	<?php
}else{
    header('Location : list_user.php');
}
	include('inc/footer_back.php');
