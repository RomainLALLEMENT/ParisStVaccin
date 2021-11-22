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

if (!empty($_GET['id'] && is_numeric($_GET['id']))) {

    $id = $_GET['id'];
    $myid = $_SESSION['user']['id'];

//    Récupère les infos de la personne qu'on souhaite modifier son profil (add role)
    $sql = "SELECT * FROM psv_user WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->execute();
    $user = $query->fetch();

//    Récupère les infos de la personne qui souhaite modifier un profil
    $sqlsession = "SELECT * FROM psv_user WHERE id=:id";
    $query = $pdo->prepare($sqlsession);
    $query->bindValue(':id',$myid,PDO::PARAM_INT);
    $query->execute();
    $myuser = $query->fetch();

//     Récupère tous les rôles
    $roles = ['admin','user'];

    if (!empty($user)) {

        if (!empty($_POST['submitted'])) {
            $password = cleanXss('password');
            $role = cleanXss('role');
//            $errors = textValidation($errors,$nom,'nom',2,250);
//            $errors = textValidation($errors,$prenom,'prenom',2,250);
//            $errors = emailValidation($errors,$email,'email');
            if (password_verify($password, $myuser['password'])) {

                    // Si on veut tout changer en renseignant forcément tous les champs
                if (count($errors) == 0) {
                    $sql2 = "UPDATE psv_user SET role=:role WHERE id = :id";
                    $query = $pdo->prepare($sql2);
                    $query->bindValue(':role',$role, PDO::PARAM_STR);
                    $query->bindValue(':id',$id, PDO::PARAM_INT);
                    $query->execute();

                    header('Location: role_user.php?id='.$id.'&success=1');
                    $success = true;
                }
            } else {
                $errors['role'] = 'Veuillez renseigner votre mot de passe pour confirmer';
            }
        }
    }
} else {
    header('Location: list_user.php?error=ID');
}


include ('inc/header_back.php'); ?>

    <div class="page-wrapper">
<?php debug($user); ?>
<?php debug($_SESSION); ?>
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Rôle(s) de <?= $user['pseudo']; ?></h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Rôle(s)</li>
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
            <i class="fas fa-info-circle"></i> <span style="font-weight: 700;">Bienvenue <?= $_SESSION['user']['prenom']?></span> sur la page pour <u>modifier le rôle de <?= $user['prenom'].' '.$user['nom'] ?></u> mais veuillez confirmer votre mot de passe pour valider vos modifications.
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
                                <input type="text" name="nom" id="nom" value="<?= $user['nom'] ?>" class="form-control form-control-line" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Prénom</label>
                            <div class="col-md-12">
                                <input type="text" name="prenom" id="prenom" value="<?= $user['prenom'] ?>" class="form-control form-control-line" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="email" name="email" id="email" value="<?= $user['email'] ?>" class="form-control form-control-line" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Votre mot de passe</label>
                            <div class="col-md-12">
                                <input type="password" name="password" id="password" value="" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12" for="role">Choisir le rôle</label>
                            <div class="col-sm-12">
                                <select class="form-control form-control-line" name="role" id="role">
                                    <option value="">Sélectionnez un rôle</option>
                                    <?php foreach ($roles as $role) { ?>
                                        <?php if(!empty($_POST['role']) ) { ?>
                                            <option value="<?php echo $role ?>"><?php echo $role; ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $role ?>"><?php echo $role; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php viewError($errors,'role')  ?>
                        </div>
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
