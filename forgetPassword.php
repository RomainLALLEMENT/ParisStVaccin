<?php
session_start();
require ('inc/pdo.php');
require ('inc/fonction.php');
require ('inc/request.php');
$errors = [];
//debug($errors);
if (!empty($_GET['success']) && $_GET['success'] == 1 ) {
    $success = true;
} else {
    $success = false;
}

if (empty($_SESSION['user'])) {
    if (!empty($_POST['submitted'])) {
        // Faille XSS
        $email = cleanXss('email');

        // Validation des champs
        $errors = textValidation($errors,$email,'email',2,255);

        if (count($errors) == 0 ) {
            // Envoie du mail de réinitialisation à l'email de l'user
            header('Location: forgetPassword.php?success=1');
        }
    }
} else {
    header('Location: index.php');
}
include ('inc/header.php');

?>

    <section id="home_login">
        <div class="wrap3">
            <?php if (!$success) { ?>
                <div class="info"><i class="fas fa-info-circle"></i> Vous avez perdu votre mot de passe ? Pas d'inquiétude, vous pouvez le récupérer. <span class="bold">Veuillez renseigner votre adresse mail ci-dessous.</span></div>
            <?php } else { ?>
                <div class="success">
                    <i class="fas fa-thumbs-up"></i> Félicitations, un mail de réinitialisation vous a été envoyé ! <br>
                    <u>Veuillez vérifier dans vos spams</u>
                </div>
            <?php } ?>
            <form action="" method="post" novalidate>
                <div class="wrap4">

                    <div class="input_group">
                        <label for="email">Adresse mail</label>
                        <input type="email" name="email" id="email" placeholder="Adresse mail" value="<?= recupInputValue('email'); ?>">
                        <?php viewError($errors,'email')  ?>
                    </div>

                    <input type="submit" name="submitted" id="submitted" value="Valider">
                </div>
            </form>
        </div>
    </section>



<?php
include ('inc/footer.php');