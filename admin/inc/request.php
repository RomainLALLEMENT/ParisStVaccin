<?php

function getVaccinsUser(int $idUser):array
{
    global $pdo;
    $vaccins=[];
    $sql = "SELECT `id_vaccin` FROM `psv_carnet` WHERE `id_user` = :idUser;";
    $query = $pdo->prepare($sql);
    $query->bindValue(':idUser',$idUser,PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll();
}
