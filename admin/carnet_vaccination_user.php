<?php
//afficher la listes des carnets (extrait)
require ('../inc/pdo.php');
require ('../inc/request.php');
require ('../inc/fonction.php');
include('inc/header_back.php');
// verifier l'id corespnd à un user présent en base
$idUsers = getAllIdUsers();
$idUser = $_GET['id'];
if (!empty($_GET['id'])){
    $test1 = 'id non vide <br>';
    if (is_numeric($idUser)){
        $test2 = 'id numérique <br>';
        foreach ($idUsers as $user){
            if ($idUser == $user['id']){
                $idValide = true;
                break;
            } else {
                $idValide = false;
            }
        }
        if ($idValide == true){
            ?>
 <div class="page-wrapper">
 <!-- ============================================================== -->
 <!-- Container fluid  -->
 <!-- ============================================================== -->
 <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Blank Page</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Blank Page</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body"><?php
                                $infoUser = getUser($idUser);
                                if(!empty(getVaccinsUser($idUser))){ ?>
                                    <h2><?php echo ('Carnet de santé de : '. $infoUser['prenom'].' '.$infoUser['nom']); ?></h2>
                                    <?php
                                    // avec l'idUser afficher les vaccins de l'utilisateur avec date d'injection et de rappel
                                    $infoVaccinUser = getInfoVaccinUser($idUser);
                                    debug($infoVaccinUser);
                                    $infoVaccin = getVaccin($infoVaccinUser[1]['id_vaccin']);
                                    debug($infoVaccin); ?>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>libelle</th>
                                                    <th>Obligatoire</th>
                                                    <th>Premiere Date</th>
                                                    <th>Prochaine Date</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            foreach ($infoVaccin as $if){foreach ($infoVaccinUser as $ifv){ ?>
                                            <tr>
                                                <td><?=$if['libelle']?></td>
                                                <td><?=$if['obligatoire']?></td>
                                                <td><?=$ifv['premiere_date']?></td>
                                                <td><?php if(!empty($ifv['date_prochain'])){echo $ifv['date_prochain'];}else{echo 'Pas de rappel pour ce vaccin';}?></td>
                                            </tr>
                                        <?php
                                        }}?>
                                        </table>
                                    </div><?php
                                }else{?>
                                    <p><?php echo ($infoUser['prenom'].' '.$infoUser['nom'].' n\'a pas de carnet de santé.'); ?></p><?php
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        } else{
            die('404');
        }
    }else{
        die('404');
    }
}else{
    die('404');
}
?>
<?php
include('inc/footer_back.php');