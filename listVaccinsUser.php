<?php
session_start();
require ('inc/pdo.php');
require ('inc/fonction.php');
require ('inc/request.php');
/*On vérifie que l'id existe bien*/
$idUser = $_SESSION['user']['id'];
$idsUserBdd = getAllIdUsers();
$idValide = verifyIdBdd($idUser,$idsUserBdd);
// récupérer le carnet de vaccin de l'user si on il n'existe pas on le redige pour qu'il puisse en créer un
$vaccinsUser = getVaccinsUser($idUser);
$carnet = (bool)$vaccinsUser; // indique si le user à un carnet ou non
if(!empty($_POST['modifier'])) {echo 'soumis modif';}
if(!empty($_POST['actualiser'])) {echo 'soumis actu';}
echo '<br>';
//echo 'session';
//debug($_SESSION);
//echo 'post';
//debug($_POST);
//echo 'carnet';
//debug($carnet);
if($carnet) $vaccinsUser = getVaccinsUserByCarnet($idUser);
//debug($vaccinsUser);

$dateDuJour = strtotime(date('Y-m-d'));
$troisMois  = 7884000;
setlocale (LC_TIME, 'fr_FR.utf8','fra');

include ('inc/header.php');
if($idValide === true){?>
<section id="list_vaccins_user">
	<div class="wrap2">
<?php
		if($carnet){	?>
			<a href="add_vaccin_user.php" title="Ajouter un vaccin à mon carnet de vaccination">Ajouter <i class="fas fa-plus-circle"></i></a><?php
            // vU = Vaccin user
			foreach ($vaccinsUser as $vU){
				$obligatoire = (bool)$vU['obligatoire']; // determine si le vaccin est obligatoire ou non


				// condition pour determiner la couleur de la div
				if($vU['premiere_date'] === $vU['date_prochain']){
                    $couleur = 'info';
				}elseif ($dateDuJour - (strtotime($vU['date_prochain'])) >= 0 ){
                    // si la date rappel est dépassé
                    $couleur = 'danger';
				}elseif ((strtotime($vU['date_prochain']) - $dateDuJour) <= $troisMois){
					// si il reste moins de 3 mois
                    $couleur = 'warning';
				}else{
                    $couleur = 'success';
            }?>
          <div class="block">
              <div class="info_vaccin">
                  <div class="vaccin">
                      <h2>Nom du vaccin : <?= '<span class="bold">'.$vU['libelle'].'</span>' ?></h2>
                      <h2>Date de <u>dernière injection</u> : <?= '<span class="bold">'.$vU['premiere_date'].'</span>' ?></h2>
                  </div>
                  <div class="boutton"><a href="modificationVaccinUser.php?id=<?= $vU['idVaccin'] ?>" title="Modifier ce vaccin"><i class="fas fa-edit"></i></a></div>
              </div>
              <?php if ($couleur == 'info') { ?>
                    <div class="info">
                        <p><i class="fas fa-info-circle"></i>   Pas encore de rappel pour ce vaccin à ce jour, tout va bien !</p>
                    </div>
              <?php } elseif ($couleur == 'success') { ?>
                  <div class="success">
                      <p><i class="fas fa-check-circle"></i>   Pas encore de rappel pour ce vaccin à ce jour, tout va bien !</p>
                      <?= '<p><i class="fas fa-calendar-check"></i>    <u>Date du prochain rappel :</u> '.strftime('%A %e %B %Y',strtotime($vU['date_prochain'])).'</p>' ?>
                  </div>
              <?php } elseif ($couleur == 'danger') { ?>
                  <div class="danger">
                      <p><i class="fas fa-radiation-alt"></i> <span class="bold">Attention !</span> La date pour effectuer le rappel de ce vaccin sera a effectué dans <u>moins de 3 mois.</u></p>
                      <?= '<p><i class="far fa-calendar-times"></i>   <u>Date du prochain rappel :</u> '.strftime('%A %e %B %Y',strtotime($vU['date_prochain'])).'</p>' ?>
                          <form action="" method="post">
                              <input type="submit" name="<?= $vU['id'] ?>" class="uppercase" value="actualiser">
                          </form>
                          <?php if(!empty($_POST[$vU['id']])) {
                              // requette avec la date du jour
                              carnetAccutualizeByUser($vU['id'],$vU['mois']);
                              //header('location', 'listVaccinsUser.php?id='.$idUser);
                              echo '<script> location.replace("listVaccinsUser.php"); </script>';
                              break;
                              // rappel sur la page pour acutaliser les donnés

                          } ?>
                  </div>
              <?php } elseif ($couleur == 'warning') { ?>
                  <div class="warning">
                        <p><i class="fas fa-exclamation-circle"></i> <span class="bold">Attention !</span> La date pour effectuer le rappel de ce vaccin a été dépassé !</p>
                      <?= '<p><i class="far fa-calendar-times"></i>    <u>Date du prochain rappel :</u> '.strftime('%A %e %B %Y',strtotime($vU['date_prochain'])).'</p>' ?>
                          <form action="" method="post">
                              <input type="submit" name="<?= $vU['id'] ?>" class="uppercase" value="actualiser">
                          </form>
                          <?php if(!empty($_POST[$vU['id']])) {
                              // requette avec la date du jour
                              carnetAccutualizeByUser($vU['id'],$vU['mois']);
                              //header('location', 'listVaccinsUser.php?id='.$idUser);
                              echo '<script> location.replace("listVaccinsUser.php"); </script>';
                              break;
                              // rappel sur la page pour acutaliser les donnés

                          } ?>
                  </div>
              <?php } ?>
			</div>
<?php       } ?>

			<a href="add_vaccin_user.php" title="Ajouter un vaccin à mon carnet de vaccination">Ajouter <i class="fas fa-plus-circle"></i></a><?php
    }else{?>
			<div class="block">
				<h2>Vous n'avez encore renseigné de vaccin !</h2>
				<a href="add_vaccin_user.php">Créer un carnet de santé</a>
			</div> <?php
		}?>
	</div>
</section>
<?php
}else{
	die('404');
}
include ('inc/footer.php');
?>
<?php
