<?php
session_start();
require ('inc/pdo.php');
require ('inc/fonction.php');
require ('inc/request.php');
$errors = [];
if (!empty($_GET['success']) && $_GET['success'] == 1 ) {
    $success = true;
} else {
    $success = false;
}
//debug($errors);
if (!empty($_POST['submitted'])) {
    // Faille XSS
    $prenom = cleanXss('prenom');
    $nom = cleanXss('nom');
    $email = cleanXss('email');
    $subject = cleanXss('subject');
    $message = cleanXss('message');

    // Validation des champs
    $errors = textValidation($errors,$prenom,'prenom',1,50);
    $errors = textValidation($errors,$nom,'nom',1,50);
    $errors = emailValidation($errors,$email,'email');
    $errors = textValidation($errors,$subject,'subject',2,255);
    $errors = textValidation($errors,$message,'message',5,200);

    // Si aucune erreur, on envoi le mail
    if (count($errors) == 0 ) {
        $to = 'alexis.briet2003@gmail.com';
        $headers = $email;
//        mail($to,$subject,$message);
        header('Location: contact.php?success=1');
    }
}
include ('inc/header.php');
?>

	    <section id="home_contact">
	        <div class="wrap3">
                <?php if (!$success) { ?>
                    <div class="info"><i class="fas fa-info-circle"></i> Vous pouvez nous contacter en remplissant le formulaire ci-dessous. Nous vous répondrons dans les meilleurs délais.</div>
                <?php } else { ?>
                    <div class="success">
                        <i class="fas fa-thumbs-up"></i> Félicitations ! <br>
                        <u>Cependant, ceci est une démo donc le mail n'a pas pu s'envoyer.</u>
                    </div>
                <?php } ?>
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
	                        <label for="subject">Sujet</label>
	                        <input type="text" name="subject" id="subject" placeholder="Mon sujet" value="<?= recupInputValue('subject');?>">
	                        <?php viewError($errors,'subject')  ?>
	                    </div>

	                    <div class="input_group">
	                        <label for="message">Message</label>
	                        <textarea name="message" id="message" placeholder="Bonjour, je me permets de vous contacter..."><?= recupInputValue('message') ?></textarea>
	                        <?php viewError($errors,'message')  ?>
	                    </div>

	                    <input type="submit" name="submitted" id="submitted" value="Envoyer">
	                </div>
	            </form>
	        </div>
	    </section>



<?php
include ('inc/footer.php');