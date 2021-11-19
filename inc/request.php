<?php
require ('inc/pdo.php');
/* Partie User */
// SELECT

function emailValidationBdd($email)
{
    global $pdo;
    $sql = "SELECT * FROM psv_user WHERE email = :email";/*select= sectionne * = prend tous from= qui provient de la table choisi where= condition, si l'email correspond bien a l'email renseigne dans l'inscription*/
    $query = $pdo->prepare($sql); /*ont prepare la requete*/
    $query->bindValue(':email',$email,PDO::PARAM_STR); /*pour proteger avec les : pdo est la pour rerrifier si il n'a pas de parametre bizarre et que ca soit bien une chaine de caractere*/
    $query->execute();
    return $query->fetch();
}
function pseudoValidationBdd($pseudo)
{
    global $pdo;
    $sql2 = "SELECT * FROM psv_user WHERE pseudo = :pseudo";
    $query =$pdo->prepare($sql2);
    $query->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
    $query->execute();
    return $query->fetch();
}
/*fonction login*/
function selectEmailOrPseudo($login)
{
    global $pdo;
    $sql = "SELECT * FROM psv_user WHERE email = :login OR pseudo = :login";
    $query = $pdo->prepare($sql);
    $query->bindValue(':login',$login,PDO::PARAM_STR);
    $query->execute();
    return $query->fetch();
}

// INSERT
function putNewUser(string $nom,string $prenom,string $age,string $email, string $token, string $password, string $pseudo){
    global $pdo;
    $sql = "INSERT INTO `psv_user`(nom, prenom, age ,email, created_at, token, password, role, pseudo) 
            VALUES (:nom,:prenom,:age,:email,NOW(),:token,:password,'user',:pseudo)";
    $query = $pdo->prepare($sql);
    $query->bindValue(':nom',$nom,PDO::PARAM_STR);
    $query->bindValue(':prenom',$prenom,PDO::PARAM_STR);
    $query->bindValue(':age',$age,PDO::PARAM_STR);
    $query->bindValue(':email',$email,PDO::PARAM_STR);
    $query->bindValue(':token',$token,PDO::PARAM_STR);
    $query->bindValue(':password',$password,PDO::PARAM_STR);
    $query->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
    $query->execute();
    header('location: login.php');
}
// UPDATE


/* Partie vaccins */

// SELCT
function getAllVaccinName(): array
{
    global $pdo;
    $sql = "SELECT `libelle` FROM `psv_vaccin`";
    $query = $pdo->prepare($sql);
    $query->execute();
    $vaccinsSql = $query->fetchAll();
    $vaccins=[];
    foreach ($vaccinsSql as $vaccin){
        $vaccins[] .= $vaccin['libelle'];
    }
    return $vaccins;
}

function getMoisRappel(int $id):array
{
    global $pdo;
    $sql = "SELECT `temps_rappel` FROM `psv_vaccin` WHERE `id` = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->execute();
    return $query->fetch();
}
// INSERT

// UPDATE


/* Partie carnet */

// SELCT

function getVaccinsUser(int $idUser):array
{
    global $pdo;
    $vaccins=[];
    $sql = "SELECT `id_vaccin` FROM `psv_carnet` WHERE `id_user` = :idUser;";
    $query = $pdo->prepare($sql);
    $query->bindValue(':idUser',$idUser,PDO::PARAM_INT);
    $query->execute();
    $vaccinsSql = $query->fetchAll();
    foreach ($vaccinsSql as $vaccin){
        $vaccins[] .= $vaccin['id_vaccin'];
    }
    return $vaccins;
}

// INSERT

function putNewVaccinOnCarnet( int $idVaccin,int $idUser, string $date, int $mois):void
{
    global $pdo;
    $sql = "
        INSERT INTO `psv_carnet`(`id_vaccin`, `id_user`, `premiere_date`, `date_prochain`) 
        VALUES (:idVaccin,:idUser,:date,DATE_ADD(:date,INTERVAL +:mois MONTH))
        ";
    $query = $pdo->prepare($sql);
    $query->bindValue(':idVaccin',$idVaccin,PDO::PARAM_INT);
    $query->bindValue(':idUser',$idUser,PDO::PARAM_INT);
    $query->bindValue(':date',$date);
    $query->bindValue(':mois',$mois,PDO::PARAM_INT);
    $query->execute();
}


// UPDATE

/*Verif*/
function verifOccurenceUserVaccin( int $idVaccin,int $idUser):bool
{
    $bool = true;
    $vaccins = getVaccinsUser($idUser);
    foreach ($vaccins as $v){
        if($v = $idVaccin){
            $bool = false;
            break;
        }
    }
    return $bool;
}



