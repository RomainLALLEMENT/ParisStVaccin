<?php
require ('inc/pdo.php');
require ('inc/fonction.php');
require ('inc/request.php');

/*Vérification si le */
$errors = [];
if(!empty($_POST['submitted'])) {
	debug($_POST);
	echo 'formulaire soumis <br>';
	// Faille xss
 	$prenom = cleanXss('prenom');
 	$pseudo = cleanXss('pseudo');
 	$nom = cleanXss('nom');
 	$email = cleanXss('email');
 	$age = cleanXss('age');
 	$password = cleanXss('password');
	$passwordConfirmation = cleanXss('passwordConfirmation');
	// Validation
	$errors = textValidation($errors, $prenom,'prenom',2,150);
	$errors = textValidation($errors, $pseudo,'pseudo',1,150);
	$errors = textValidation($errors, $nom,'nom',2,150);
	$errors = textValidation($errors, $password,'password',4);
	$errors = emailValidation($errors,$email,'email');
    // confirmation que le deux mpd sont les mêmes
	$errors = passwordConfirmationValidation($errors,$passwordConfirmation,$password,'passwordConfirmation');

    debug($errors);
    /*requete*/
    /*FONCTION EMAIL ALLER VOIR DANS FONCTION.PHP*/
    $email_validation = emailValidationBdd($email);
    $pseudo_validation = pseudoValidationBdd($pseudo);



    /*MESSAGE D'ERREUR SI EXISTE PAS */
    if ($email_validation){
        $errors['email'] = 'l\'adresse mail existe déja !';
    }
    if ($pseudo_validation){
        $errors['pseudo'] = 'ce pseudo existe déja !';
    }

 if(count($errors) 	 == 0){
	 echo '0 erreur <br>';
     $token    = generateRandomString(255);
     $password = password_hash($password, PASSWORD_BCRYPT);
     // faire l'envoie des données
     putNewUser($nom,$prenom,$age,$email,$token,$password,$pseudo);
 }

}
include ('inc/header.php'); ?>

    <section id="home_register">
        <div class="wrap0">
            <div class="title_absolute uppercase">
                <h2 class="text-shadow">Inscrivez</h2>
                <h2 class="text-shadow">Vous !</h2>
            </div>
        </div>
    </section>

    <div class="wrap3">
        <form action="" method="post" novalidate>
            <div class="wrap4">

                <div class="input_group input_names">
                    <div class="input_prenom">
                        <label for="prenom">Prénom</label>

                        <input type="text" name="prenom" id="prenom" placeholder="John" value="<?= recupInputValue('prenom');?>">

                        <?php viewError($errors,'prenom')  ?>
                    </div>
                    <div class="input_nom">
                        <label for="nom">Nom</label>

                        <input type="text" name="nom" id="nom" placeholder="Doe" value="<?= recupInputValue('nom');?>">

                        <?php viewError($errors,'nom')  ?>
                    </div>
                </div>

                <div class="input_group">
                    <label for="email">Adresse mail</label>
                    <input type="email" name="email" id="email" placeholder="monemail@example.com" value="<?= recupInputValue('email');?>">
                    <?php viewError($errors,'email')  ?>
                </div>

                <div class="input_group">
                    <label for="nom">Pseudo</label>
                    <input type="text" name="pseudo" id="pseudo" placeholder="Doe" value="<?= recupInputValue('pseudo');?>">
                    <?php viewError($errors,'pseudo')  ?>
                </div>

                <div class="input_group">
                    <label for="age">Date de naissance</label>
                    <input type="date" name="age" id="age" value="<?= recupInputValue('age');?>">
                    <?php viewError($errors,'age')  ?>
                </div>

                <div class="input_group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="Mot de passe" value="">
                    <?php viewError($errors,'password')  ?>
                </div>

                <div class="input_group">
                    <label for="passwordConfirmation">Confirmer votre mot de passe</label>
                    <input type="password" name="passwordConfirmation" id="password" placeholder="Mot de passe" value="">
                    <?php viewError($errors,'password')  ?>
                </div>

                <input type="submit" name="submitted" id="submitted" value="S'inscrire">
            </div>
        </form>
    </div>

<?php
include ('inc/footer.php');