<?php
require ('inc/pdo.php');
require ('inc/fonction.php');
require ('inc/request.php');
include ('inc/header.php');
$errors=[];
$occurence ='';
// sql recup tous les vaccins pour la liste déroulante
$vaccins = getAllVaccinName();
// verif id USER
/*a réaliser*/

// Soumission du formulaire
if(!empty($_POST['submitted'])) {
    echo 'formulaire soumis <br>';
    // Faille xss
    $date   = cleanXss('date');
    $vaccin = cleanXss('vaccin');
		// validation
   $errors  =  dateValidation($errors, $date,'date');
	 $errors  = selectValidation($errors,$vaccin,'vaccin');
	 $idVaccin = $vaccin;
    if(count($errors)== 0){
			/*On recupêrer les donnés pour l'insert*/
        $idVaccin         = intval($vaccin);
        $idUser           = $_SESSION['user']['id'];
				$nombreMoisrappel = getMoisRappel($idVaccin)['temps_rappel'];
				/*faire une vérife qu'il n'existe déjà pas une occurence entre id vaccin et id user si oui rediriger le user dans la liste de vaccins pourqu'il puisse si besoin modifier les information quand a sa vaccination sinon on envoie les données*/
			//	$succes = verifOccurenceUserVaccin($idVaccin,$idUser);
				$verifVaccinsUser = getVaccinsUser($idUser);
				if(!empty($verifVaccinsUser) === true){
					for ($i=0 ; $i <= (count($verifVaccinsUser)-1);$i++){
						if(intval($verifVaccinsUser[$i]) === $idVaccin){
							$occurence = true;
							break;
						}else{
							$occurence = false;
						}
					}
				}else{
            $occurence = false;
				}
				/*si il n'y a pas d'occurence dans la bdd on applique la requette*/
				if($occurence === false){
					putNewVaccinOnCarnet($idVaccin,$idUser,$date,$nombreMoisrappel);
        	echo 'vaccin non renseigné !';
				}else{
					/*redirection vers la page modif info vaccins*/
         echo 'vaccin déja renseigné !';
						/*faire une rediction ou proposé au user de modif le vaccin renseingé*/
				}
		}
}


?>

<div class="wrap3">
    <form action="" method="post" novalidate>
        <div class="wrap4">
            <div class="input_group">
                <label for="date">Date d'injection</label>
                <input type="date" name="date" id="date" value="<?php echo recupInputValue('date')  ?>">
                <?php viewError($errors,'date')  ?>
            </div>
            <div class="input_group">
                <label for="vaccin">Choisir le vaccin</label>
                <select name="vaccin" id="vaccin">
                    <option value="">Sélectionnez un vaccin</option>
                    <?php foreach ($vaccins as $key => $vaccin) { ?>
                        <?php if(!empty($_POST['vaccin']) && $_POST['vaccin'] == $key ) { ?>
                            <option value="<?php echo $key+1 ?>"><?php echo $vaccin; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $key+1 ?>"><?php echo $vaccin; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
                <?php viewError($errors,'vaccin')  ?>
            </div>

            <input type="submit" name="submitted" id="submitted" value="Enregistrer">
        </div>
    </form>
</div>
<?php
include ('inc/footer.php');