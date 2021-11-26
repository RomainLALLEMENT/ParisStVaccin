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
    $token = $_GET['token'];
    $email = $_GET['email'];

    $sql = "SELECT * FROM psv_user WHERE email = :email";
    $query = $pdo->prepare($sql);
    $query->bindValue(':email',$email,PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

    if (!empty($_GET['token']) && $token == $user['token']) {
        if (!empty($_POST['submitted'])) {



        // Faille XSS
        $password = cleanXss('password');
        $confirmpassword = cleanXss('confirmpassword');

            // Validation des champs
        $errors = textValidation($errors,$password,'password',4);
        $errors = passwordConfirmationValidation($errors, $confirmpassword, $password, 'confirmpassword');


        if (count($errors) == 0) {
           $token = generateRandomString(255);
           $password = password_hash($password, PASSWORD_BCRYPT);
           // faire l'envoie des données
           $sql2 = "UPDATE psv_user SET password = :password WHERE email = :email";
           $query = $pdo->prepare($sql2);
           $query->bindValue(':email',$email, PDO::PARAM_STR);
           $query->bindValue(':password',$password, PDO::PARAM_STR);
           $query->execute();
           header('Location: login?success=1');
           }
        }
    } else {
        header('Location: error403.php');
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
                        <label for="password">Nouveau mot de passe</label>
                        <input type="password" name="password" id="password" value="">
                        <?php viewError($errors,'password')  ?>
                    </div>
                    <div class="input_group">
                        <label for="confirmpassword">Confirmer le mot de passe</label>
                        <input type="password" name="confirmpassword" id="confirmpassword" value="">
                        <?php viewError($errors,'password')  ?>
                    </div>

                    <input type="submit" name="submitted" id="submitted" value="Valider">
                </div>
            </form>
        </div>
    </section>



<?php
include ('inc/footer.php');