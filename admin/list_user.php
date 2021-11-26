<?php
session_start();
require ('../inc/pdo.php');
require ('../inc/request.php');
require ('../inc/fonction.php');
error403();

require '../vendor/autoload.php';

use JasonGrimes\Paginator;

/*$totalItems = getNombreUsers();*/

$totalItems = getNombreUsers()['userTotal'];
$itemsPerPage = 5;
$currentPage = empty($_GET['page']) ? 1 : intval($_GET['page']);
$urlPattern = '/projets/vaccin/admin/list_user.php?page=(:num)';

$offset = empty($_GET['page']) ? 0 : (intval($_GET['page']-1)*$itemsPerPage);

$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

// affiche les message d'erreur ou de succes
if (!empty($_GET['success']) && $_GET['success'] == 1 ) {
    $success = true;
} else {
    $success = false;
}

$users = getAllUserPagination($itemsPerPage,$offset);
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
                    <h3 class="text-themecolor">Liste des utilisateurs <i class="fas fa-users"></i></h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Utilisateurs</a></li>
                        <li class="breadcrumb-item active">Liste des utilisateurs</li>
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
                    <i class="fas fa-info-circle"></i> <span style="font-weight: 700;">Bienvenue <?= $_SESSION['user']['prenom']?></span> sur la liste des utilisateurs.
                </div>
            <?php } else { ?>
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-thumbs-up"></i> Félicitations, vos modifications ont bien été pris en compte ! <br>
                    <u>Nous vous invitons à rafraichir la page pour voir vos modifications</u>
                </div>
            <?php } ?>
            <?php if (!empty($_GET['error'])) {  ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-info-circle"></i> Attention ! Vous devez cliquer directement sur le rôle d'un utilisateur parmi cette liste pour le modifier.
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
                                        <th>Numéro</th>
                                        <th>Pseudo</th>
                                        <th>Prenom</th>
                                        <th>Nom</th>
                                        <th>Age</th>
                                        <th>Email</th>
                                        <th>Rôle(s)</th>
                                        <th>Carnet</th>
                                    </tr>
                                    </thead>
                                    <tbody><?php
                                    foreach ($users as $user){ ?>
                                    <tr>
                                        <?php
//                                      // Calcul l'age par rapport à la date de naissance
                                        $dateNaissance = $user['age'];
                                        $aujourdhui = date("Y-m-d");
                                        $diff = date_diff(date_create($dateNaissance), date_create($aujourdhui));
                                        ?>
                                        <td><?=$user['id']?></td>
                                        <td><?=$user['pseudo']?></td>
                                        <td><?=$user['prenom']?></td>
                                        <td><?=$user['nom']?></td>
                                        <td><?=$diff->format('%y')?></td>
                                        <td><?=$user['email']?></td>
                                        <td><?= '<a href="role_user.php?id='.$user['id'].'">'.$user['role'].'</a>'?></td>
                                        <td><?php //vérification si carnet de vacination existant ou non
                                            if (!empty(getVaccinsUser($user['id']))){?>
                                            <a href="carnet_vaccination_user.php?id=<?= $user['id']?>"><i class="fas fa-info-circle"></i></a><?php
                                            }else{echo '<i class="fas fa-times-circle" style="color: red"></i>';}?>
                                        </td>
                                    </tr> <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
															<ul class="pagination">
                                  <?php if ($paginator->getPrevUrl()): ?>
																		<li class="page-item"><a class="page-link" href="<?php echo $paginator->getPrevUrl(); ?>">&laquo; Previous</a></li>
                                  <?php endif; ?>
                                  <?php foreach ($paginator->getPages() as $page): ?>
                                      <?php if ($page['url']): ?>
																			<li <?php echo $page['isCurrent'] ? 'class="active page-item"' : ''; ?>>
																				<a class="page-link" href="<?php echo $page['url']; ?>"><?php echo $page['num']; ?></a>
																			</li>
                                      <?php else: ?>
																			<li class="disabled page-item"><span><?php echo $page['num']; ?></span></li>
                                      <?php endif; ?>
                                  <?php endforeach; ?>

                                  <?php if ($paginator->getNextUrl()): ?>
																		<li class="page-item"><a class="page-link" href="<?php echo $paginator->getNextUrl(); ?>">Next &raquo;</a></li>
                                  <?php endif; ?>
															</ul>

															<p><?= $paginator->getTotalItems(); ?> utilsateurs présents base de données.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
include('inc/footer_back.php');