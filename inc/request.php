<?php
require ('inc/pdo.php');
/* Partie User */

// SELCT

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
function getAllVaccinName(){
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
// INSERT

// UPDATE


/* Partie carnet */

// SELCT

// INSERT

// UPDATE
