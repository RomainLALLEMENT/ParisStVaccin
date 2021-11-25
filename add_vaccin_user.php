<?php
session_start();
require ('inc/pdo.php');
require ('inc/fonction.php');
require ('inc/request.php');
if (isLogged()){
    if (!empty($_GET['danger']) && $_GET['danger'] == 1 ) {
        $danger = true;
    } else {
        $danger = false;
    }
	$errors=[];
	$occurence ='';
	// sql recup tous les vaccins pour la liste déroulante
	$vaccins = getAllVaccinName();

	// Soumission du formulaire
	if(!empty($_POST['submitted'])) {
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

//            $sql = "SELECT id FROM psv_carnet WHERE id_user = :id_session AND id_vaccin = :id_vaccin";
//            $query = $pdo->prepare($sql);
//            $query->bindValue(':id_session',$idUser);
//            $query->bindValue(':id_vaccin',$idVaccin);
//            $query->execute();
//            $idCarnet = $query->fetch();
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
                header('Location: listVaccinsUser.php?success=1');
            }else{
                /*redirection vers la page modif info vaccins*/
                $errors['vaccin'] = 'Ce vaccin est déjà renseigné';
//                header('Location: add_vaccin_user.php?danger=1');
                /*faire une rediction ou proposé au user de modif le vaccin renseingé*/
            }
        }
	}
    include ('inc/header.php');

	?>
	    <section id="home_add_vaccin">
	        <div class="wrap3">
                <?php if (!$danger) { ?>
                    <div class="info"><i class="fas fa-info-circle"></i> Veuillez renseigner une date d'injection et sélectionner le vaccin en question.</div>
                <?php } else { ?>
                    <div class="danger">
                        <i class="fas fa-thumbs-up"></i> <span class="bold">Attention !</span> Ce vaccin a déjà été renseigné. <br>
                        <u>Si vous souhaitez modifier la date d'injection de ce vaccin, <a href="modificationVaccinUser.php?id=<?php echo $idCarnet ?>">cliquez ici</a></u>
                    </div>
                <?php } ?>
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
	    </section>
	<?php
	include ('inc/footer.php');
}else{
    header('HTTP/1.0 403 Forbidden');
    header('Location:error403.php');
}