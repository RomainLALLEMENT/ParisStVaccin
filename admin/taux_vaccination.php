<?php
session_start();
require ('../inc/pdo.php');
require ('../inc/fonction.php');
require ('../inc/request.php');
error403();
if (!empty($_GET['success']) && $_GET['success'] == 1 ) {
    $success = true;
} else {
    $success = false;
}

$nombreUsers = getNombreUsers();
$nombreCarnets = getNombreUserCarnet();
$listVaccin = getAllVaccin();

/*Partie variable pour le js*/
$vaccins = getAllVaccin();
// on mets les donnès dans une chaine en forme de tableau pour JS
$libelle        = '[\'';
$nombreVaccine  = '[\'';
foreach ($vaccins as $vaccin){
    $infoNombreVaccine = statNombreUserVaccine($vaccin['id']);
    $libelle       .= ''.$infoNombreVaccine['vaccin'].'';
    $libelle       .= '\',\'';

    $nombreVaccine .= ''.$infoNombreVaccine['nombre'].'';
    $nombreVaccine .= '\',\'';
}
$libelle        .= '\']';
$nombreVaccine  .= '\']';
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
        <?php if ($success) { ?>
            <div class="alert alert-success" role="alert">
                <i class="fas fa-thumbs-up"></i> Félicitations, vos modifications ont bien été pris en compte ! <br>
                <u>Cependant cela est une démo donc le mail n'a pas pu aboutir.</u>
            </div>
        <?php } ?>
        <div class="row">
			<div class="col-12">
				<div class="card">
					<!-- Tab panes -->
					<div class="card-body">
						<canvas id="grapTauxVaccination"></canvas>
						<table class="table">
							<thead>
								<tr>
									<th>Libelle</th>
									<th>Taux de vaccination</th>
									<th>Taux de vaccination utilisateur du site</th>
									<th>Mail</th>
								</tr>
							</thead>
							<tbody><?php
								foreach ($listVaccin as $vaccin){
									$taux = getNumberUsersVacinateByVaccin($vaccin['id']);?>
											<tr>
												<th><?=$vaccin['libelle']?></th>
												<th><?=getPourcentage($taux['nombrePersonneVaccin'], $nombreCarnets['UserCarnet']);?></th>
												<th><?=getPourcentage($taux['nombrePersonneVaccin'], $nombreUsers['userTotal']);?></th>
												<th><a href="rappelMail.php?id=<?= $vaccin['id'] ?>">Définir un rappel</a></th>
											</tr>
                  <?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

    <?php
    include('inc/footer_back.php');?>
<script>
      const ctx = document.getElementById('grapTauxVaccination').getContext('2d');
      const myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: <?= $libelle ?>,
              datasets: [{
                  label: 'nombre de personne vacciné par vaccin',
                  data: <?= $nombreVaccine ?>,
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(255, 159, 64, 0.2)'
                  ],
                  borderColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(255, 159, 64, 0.2)'
                  ],
                  borderWidth: 0

              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });
	</script>
<?php
