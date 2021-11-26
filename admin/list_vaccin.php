<?php
session_start();
require ('../inc/pdo.php');
require ('../inc/fonction.php');
require ('../inc/request.php');
error403();
include('inc/header_back.php');
require '../vendor/autoload.php';

use JasonGrimes\Paginator;

$totalItems = getNombreVaccins()['vaccinTotal'];
$itemsPerPage = 5;
$currentPage = empty($_GET['page']) ? 1 : intval($_GET['page']);
$urlPattern = '/php/projetGroupe/parisstvaccin/admin/list_vaccin.php?page=(:num)';

$offset = empty($_GET['page']) ? 0 : (intval($_GET['page']-1)*$itemsPerPage);

$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
$listVaccin = getAllVaccinPagination($itemsPerPage,$offset);

if (!empty($_GET['success']) && $_GET['success'] == 1 ) {
    $success = true;
} else {
    $success = false;
}




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
                    <h3 class="text-themecolor">Liste des vaccins <i class="fas fa-syringe"></i></h3>
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
                    <i class="fas fa-info-circle"></i> <span style="font-weight: 700;">Bienvenue <?= $_SESSION['user']['prenom']?></span> sur la liste des vaccins.
                </div>
            <?php } else { ?>
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-thumbs-up"></i> Félicitations, vos modifications ont bien été pris en compte ! <br>
                    <u>Nous vous invitons à rafraichir la page pour voir vos modifications</u>
                </div>
            <?php } ?>
            <?php if (!empty($_GET['error'])) {  ?>
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-info-circle"></i> Attention ! Vous devez directement cliquer sur l'icone modifier pour éditer un vaccin.
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
                                                <th><?=$vaccin['laboratoire']?></th>
                                                <th><?= '<a href="edit_vaccin.php?id='.$vaccin['id'] . '"><i class="fas fa-edit"></i></a>'?></th>
                                            </tr>
                                        </div>
                                    <?php } ?>
                                        </div>
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

															<p><?= $paginator->getTotalItems(); ?> Vaccins présents base de données.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
include('inc/footer_back.php');