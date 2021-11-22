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
echo 'session';
//debug($_SESSION);
echo 'post';
//debug($_POST);
echo 'carnet';
//debug($carnet);
if($carnet) $vaccinsUser = getVaccinsUserByCarnet($idUser);
//debug($vaccinsUser);

$dateDuJour = strtotime(date('Y-m-d'));
echo $dateDuJour;
$troisMois  = 7884000;


include ('inc/header.php');
if($idValide === true){?>
<section id="list_vaccins_user">
	<div class="wrap2">
<?php
		if($carnet){	?>
			<a class="bouttonAjout" href="add_vaccin_user.php">ajouter</a><?php
			foreach ($vaccinsUser as $vU){
				$obligatoire = (bool)$vU['obligatoire']; // determine si le vaccin est obligatoire ou non
				/*condition pour determiner la couleur de la div*/
				if($vU['premiere_date'] === $vU['date_prochain']){
						$couleur = 'bleu';
				}elseif ($dateDuJour - (strtotime($vU['date_prochain'])) >= 0 ){
					// si la date rappel est dépassé
            $couleur = 'rouge';
				}elseif ((strtotime($vU['date_prochain']) - $dateDuJour) <= $troisMois){
					// si il reste moins de 3 mois
            $couleur = 'orange';
				}else{
						$couleur = 'vert';
				}?>
          <div class="block">
					<div class="info_vaccin">
							<div class="vaccin">
								 <div class="html">
									 <div class="nom">Nom du vaccin</div>
									 <div class="date"> Date de dernière injection</div>
								 </div>
								 <div class="php">
									 <div class="nom"> <?= $vU['libelle'] ?> </div>
									 <div class="date"><?= $vU['premiere_date'] ?> </div>
								 </div>

							</div>
							<div class="boutton"><a href="modificationVaccinUser.php?vaccin= <?= $vU['idVaccin'] ?>" >M</a></div>
					</div>
					<div class="rappel_vaccin <?= $couleur ?>">
						<div class="info_rappel">
							<div class="rappel uppercase"><span class="img">IMAGE WARNING</span> rappel </div>
							<div class="date">Date rappel : <?php if($couleur == 'bleu'){echo 'pas de rappel pour ce vaccin'; }else{echo  $vU['date_prochain'];}?> </div>
						</div>
						<?php if($couleur == 'rouge' || $couleur == 'orange') {?>
						<form action="" method="post"><input type="submit" name="<?= $vU['id'] ?>" class="uppercase" value="actualiser"></form> <?php
                if(!empty($_POST[$vU['id']])) {
									// requette avec la date du jour
                    carnetAccutualizeByUser($vU['id'],$vU['mois']);
                    //header('location', 'listVaccinsUser.php?id='.$idUser);
                    echo '<script> location.replace("listVaccinsUser.php"); </script>';
										break;
								 // rappel sur la page pour acutaliser les donnés

								}
						} ?>
					</div>
			</div>
<?php
			}
			/*vaccin obligatoire*/

				?>

			<a class="bouttonAjout" href="add_vaccin_user.php">ajouter</a><?php
    }else{?>
			<div class="block">
				<h2>Vous n'avez encore renseigné de vaccin !</h2>
				<a class="bouttonAjout" href="add_vaccin_user.php">Créer un carnet de santé</a>
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
