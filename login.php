<?php
session_start();
require ('inc/pdo.php');
require ('inc/fonction.php');
require ('inc/request.php');
$errors = [];
//debug($errors);
if (empty($_SESSION['user'])) {
    if (!empty($_POST['submitted'])) {
        // Faille XSS
        $login = cleanXss('login');
        $password = cleanXss('password');

        // Validation des champs
        $errors = textValidation($errors,$login,'login',2,255);

        // Request
        $user = selectEmailOrPseudo($login);

//    debug($user);
        // Si User existe
        if (!empty($user)) {
            // Password verify
            if (password_verify($password, $user['password'])) {
                echo 'MDP OK';
                // true =>
                $_SESSION['user'] = array(
                    'id'      => $user['id'],
                    'email'   => $user['email'],
                    'pseudo'   => $user['pseudo'],
                    'nom'  => $user['nom'],
                    'prenom'  => $user['prenom'],
                    'age'  => $user['age'],
                    'role'    => $user['role'],
                    'ip'      => $_SERVER['REMOTE_ADDR'] // ::1
                );
                debug($_SESSION);
                header('Location: index.php');
//
            } else {
                $errors['login'] = 'Quelque chose a bug';
            }
        } else {
            $errors['login'] = 'Problèmes';
        }
    }
} else {
    header('Location: index.php');
}
include ('inc/header.php');

 ?>

    <section id="home_login">
        <div class="wrap3">
            <form action="" method="post" novalidate>
                <div class="wrap4">

                    <div class="input_group">
                        <label for="login">Username or email</label>
                        <input type="login" name="login" id="login" placeholder="Username or email" value="<?= recupInputValue('login'); ?>">
                        <?php viewError($errors,'login')  ?>
                    </div>

                    <div class="input_group">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password" placeholder="Mot de passe" value="">
                    </div>

                    <input type="submit" name="submitted" id="submitted" value="Se connecter">
                </div>
            </form>
        </div>
    </section>



<?php
include ('inc/footer.php');