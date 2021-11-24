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

if (isLogged()) {

    if (!empty($_SESSION['user']['id'])) {

        $id = $_SESSION['user']['id'];

        $user = getUser($id);

        if (!empty($user)) {

            if (!empty($_POST['submitted'])) {
                $nom = cleanXss('nom');
                $prenom = cleanXss('prenom');
                $email = cleanXss('email');
                $password = cleanXss('password');

    //            $errors = textValidation($errors,$nom,'nom',2,250);
    //            $errors = textValidation($errors,$prenom,'prenom',2,250);
    //            $errors = emailValidation($errors,$email,'email');
                if (password_verify($password, $user['password'])) {
                    if (!empty($_POST['nom'])) {
                        updateNom($nom,$id);

                        header('Location: profil.php?success=1');
                        $success = true;
                    } elseif (!empty($_POST['prenom'])) {
                        updatePrenom($prenom,$id);

                        header('Location: profil.php?success=1');
                    } elseif (!empty($_POST['email'])) {
                        updateMail($email,$id);

                        header('Location: profil.php?success=1');
                        // Si on veut tout changer en renseignant forcément tous les champs
                    } elseif (count($errors) == 0) {
                        updateAllInput($nom,$prenom,$email,$id);

                        header('Location: profil.php?success=1');
                        $success = true;
                    }
                } else {
                    $errors['nom'] = 'Veuillez renseigner votre mot de passe pour confirmer';
                    $errors['prenom'] = 'Veuillez renseigner votre mot de passe pour confirmer';
                    $errors['email'] = 'Veuillez renseigner votre mot de passe pour confirmer';
                }
            }
        }
    }


    include ('inc/header.php'); ?>

    <section id="home_profil">
        <div class="wrap3">
            <?php if (!$success) { ?>
                <div class="info"><i class="fas fa-info-circle"></i> Vous pouvez modifier le contenu de votre profil mais vous devrez confirmer vos modifications en entrant votre mot de passe.</div>
            <?php } else { ?>
                <div class="success">
                    <i class="fas fa-thumbs-up"></i> Félicitations, vos modifications ont bien été pris en compte ! <br>
                    <u>Nous vous invitons à rafraichir la page pour voir vos modifications</u>
                </div>
            <?php } ?>
            <form action="" method="post" novalidate>
                <div class="wrap4">

                    <div class="input_group input_names">
                        <div class="input_prenom">
                            <label for="prenom">Prénom</label>

                            <input type="prenom" name="prenom" id="prenom" placeholder="<?= $user['prenom']; ?>" value="<?= recupInputValue('prenom'); ?>">
                            <?php viewError($errors,'prenom')  ?>
                        </div>
                        <div class="input_nom">
                            <label for="nom">Nom</label>

                            <input type="nom" name="nom" id="nom" placeholder="<?= $user['nom']; ?>" value="<?= recupInputValue('nom'); ?>">
                            <?php viewError($errors,'nom')  ?>
                        </div>
                    </div>

                    <div class="input_group">
                        <label for="email">Adresse mail</label>
                        <input type="email" name="email" id="email" placeholder="<?= $user['email']; ?>" value="<?= recupInputValue('email'); ?>">
                        <?php viewError($errors,'email')  ?>
                    </div>

                    <div class="input_group">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password" placeholder="Mot de passe" value="">
                    </div>

                    <input type="submit" name="submitted" id="submitted" value="Modifier">
                </div>
            </form>
        </div>
    </section>
<?php
include ('inc/footer.php');
} else {
    header('HTTP/1.0 403 Forbidden');
    header('Location:error403.php');
}
