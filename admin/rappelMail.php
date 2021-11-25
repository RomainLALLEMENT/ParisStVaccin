<?php
session_start();
require ('../inc/pdo.php');
require ('../inc/fonction.php');
require ('../inc/request.php');
error403();

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {

    $id = $_GET['id'];

    $user = getUser($id);
    $to = $user['email'];
    $subject = '[Relance] - Vous devez aboslument effectuer votre rappel de vaccin';
    $message = 'Bonjour, \n Vous devez absolument réaliser votre rappel à propos de votre vaccin.';

//    mail($to,$subject,$message);
    header('Location: taux_vaccination.php?succcess=1');
}

?>