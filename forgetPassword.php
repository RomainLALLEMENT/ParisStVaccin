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
            $sql = "SELECT * FROM psv_user WHERE email = :email";
            $query = $pdo->prepare($sql);
            $query->bindValue(':email',$email,PDO::PARAM_STR);
            $query->execute();
            $user = $query->fetch();
//            header('Location: forgetPassword.php?success=1');
            $token = $user['token'];
            header("Location: resetPassword.php?email=$email&token=$token");
//            header("Location: forgetPassword.php?success=1");
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
                <div class="danger">
                    <i class="fas fa-thumbs-up"></i> <span class="bold">Attention !</span> Ceci est une démo et étant donné que la fonction mail ne fonctionne pas en local, voici le lien que la personne aurait reçu par mail<br>
                    <u><a href="resetPassword.php?email=<?= $user['email'] ?>&token=<?= $user['token'] ?>">test</a></u>
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