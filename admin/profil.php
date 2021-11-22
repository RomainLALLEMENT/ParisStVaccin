<?php
session_start();
require ('../inc/pdo.php');
require ('../inc/fonction.php');
require ('../inc/request.php');
error403();
$errors = [];

if (!empty($_GET['success']) && $_GET['success'] == 1 ) {
    $success = true;
} else {
    $success = false;
}

if (!empty($_SESSION['user']['id'])) {

    $id = $_SESSION['user']['id'];

    $sql = "SELECT * FROM psv_user WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->execute();
    $user = $query->fetch();

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
                    $sql_nom = "UPDATE psv_user SET nom=:nom WHERE id = :id";
                    $query = $pdo->prepare($sql_nom);
                    $query->bindValue(':nom',$nom, PDO::PARAM_STR);
                    $query->bindValue(':id',$id, PDO::PARAM_INT);
                    $query->execute();

                    header('Location: profil.php?success=1');
                    $success = true;
                } elseif (!empty($_POST['prenom'])) {
                    $sql_prenom = "UPDATE psv_user SET prenom=:prenom WHERE id = :id";
                    $query = $pdo->prepare($sql_prenom);
                    $query->bindValue(':prenom',$prenom, PDO::PARAM_STR);
                    $query->bindValue(':id',$id, PDO::PARAM_INT);
                    $query->execute();

                    header('Location: profil.php?success=1');
                } elseif (!empty($_POST['email'])) {
                    $sql_email = "UPDATE psv_user SET email=:email WHERE id = :id";
                    $query = $pdo->prepare($sql_email);
                    $query->bindValue(':email',$email, PDO::PARAM_STR);
                    $query->bindValue(':id',$id, PDO::PARAM_INT);
                    $query->execute();

                    header('Location: profil.php?success=1');
                    // Si on veut tout changer en renseignant forcément tous les champs
                } elseif (count($errors) == 0) {
                    $sql2 = "UPDATE psv_user SET nom=:nom, prenom=:prenom, email=:email WHERE id = :id";
                    $query = $pdo->prepare($sql2);
                    $query->bindValue(':nom',$nom, PDO::PARAM_STR);
                    $query->bindValue(':prenom',$prenom, PDO::PARAM_STR);
                    $query->bindValue(':email',$email, PDO::PARAM_STR);
                    $query->bindValue(':id',$id, PDO::PARAM_INT);
                    $query->execute();

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


include ('inc/header_back.php'); ?>

    <div class="page-wrapper">
    <?php debug($user); ?>
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Modifier votre profil</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
                        <li class="breadcrumb-item active">Profil</li>
                    </ol>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- Row -->
            <?php if (!$success) { ?>
            <div class="alert alert-info" role="alert">
                <i class="fas fa-info-circle"></i> <strong>Bienvenue <?= $user['prenom']?></strong> sur votre page d'édition de profil. Vous pouvez éditer seulement un champ si nécessaire mais veuillez confirmer votre mot de passe pour valider vos modifications.
            </div>
            <?php } else { ?>
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-thumbs-up"></i> Félicitations, vos modifications ont bien été pris en compte ! <br>
                    <u>Nous vous invitons à rafraichir la page pour voir vos modifications</u>
                </div>
            <?php } ?>
            <div class="row">
                <!-- Column -->
                <div class="col-lg-4 col-xlg-3 col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <center class="m-t-30"> <img src="assets/images/users/5.jpg" class="img-circle" width="150" />
                                <h4 class="card-title m-t-10"><?= $user['prenom'].' '.$user['nom'] ?></h4>
                                <h6 class="card-subtitle"><?= $user['role'];?></h6>
                                <div class="row text-center justify-content-md-center">
                                    <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">254</font></a></div>
                                    <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-lg-8 col-xlg-9 col-md-7">
                    <div class="card">
                        <!-- Tab panes -->
                        <div class="card-body">
                            <form class="form-horizontal form-material" method="post" novalidate>
                                <div class="form-group">
                                    <label class="col-md-12">Nom</label>
                                    <div class="col-md-12">
                                        <input type="text" name="nom" id="nom" placeholder="<?= $user['nom'] ?>" value="<?= recupInputValue('nom') ?>" class="form-control form-control-line">
                                        <?= viewError($errors,'nom') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Prénom</label>
                                    <div class="col-md-12">
                                        <input type="text" name="prenom" id="prenom" placeholder="<?= $user['prenom'] ?>" value="<?= recupInputValue('prenom') ?>" class="form-control form-control-line">
                                        <?= viewError($errors,'prenom') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" name="email" id="email" placeholder="<?= $user['email'] ?>" value="<?= recupInputValue('email') ?>" class="form-control form-control-line">
                                        <?= viewError($errors,'email') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Password</label>
                                    <div class="col-md-12">
                                        <input type="password" name="password" id="password" value="" class="form-control form-control-line">
                                    </div>
                                </div>
<!--                                <div class="form-group">-->
<!--                                    <label class="col-sm-12">Select Country</label>-->
<!--                                    <div class="col-sm-12">-->
<!--                                        <select class="form-control form-control-line">-->
<!--                                            <option>London</option>-->
<!--                                            <option>India</option>-->
<!--                                            <option>Usa</option>-->
<!--                                            <option>Canada</option>-->
<!--                                            <option>Thailand</option>-->
<!--                                        </select>-->
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input class="btn btn-success" type="submit" name="submitted" id="submitted" value="Update">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>

<?php
include ('inc/footer_back.php');
