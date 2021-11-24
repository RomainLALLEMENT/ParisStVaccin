<?php

function debug($tableau)
{
    echo '<pre style="height:200px;overflow-y: scroll;font-size: .7rem;padding: .6rem;font-family: Consolas, Monospace;background-color: #000;color:#fff;">';
    print_r($tableau);
    echo '</pre>';
}

function cleanXss($key)
{
    return trim(strip_tags($_POST[$key]));
}

function textValidation($errors,$value,$key,$min = 3,$max = 50){
    if(!empty($value)) {
        if(mb_strlen($value) < $min) {
            $errors[$key] = 'Min '.$min.' caractères';
        } elseif (mb_strlen($value) > $max) {
            $errors[$key] = 'Max '.$max.' caractères';
        }
    } else {
        $errors[$key] = 'Veuillez renseigner ce champ.';
    }
    return $errors;
}

function radioValidation($errors,$value,$key){
    if(empty($value)) {
        $errors[$key] = 'Veuillez selectionner un etat';
    }
    return $errors;
}

function emailValidation($errors,$email,$key)
{
    if(!empty($email)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[$key] = 'Veuillez renseigner un email valid';
        }
    } else {
        $errors[$key] = 'Veuillez renseigner un email';
    }
    return $errors;
}

function numberValidation($errors,$value,$key,$min=3,$max=1000000)
{
    if(!is_numeric($value)){
        $errors[$key] = 'Veuillez rentrer un nombre';
        var_dump($value);
    }elseif($value > $max){
        $errors[$key] = 'Nombre trop grand';
        var_dump($value);
    }elseif($value < $min){
        $errors[$key] = 'Nombre trop petit';
        var_dump($value);
    }

    return $errors;
}

function dateValidation($errors,$value,$key){
    if(strtotime($value) >= strtotime(date('Y-m-d'))){
        $errors[$key] = 'Veuillez rentrer une date valide';
    }
    if(empty($value)){
        $errors[$key] = 'Veuillez selectioner une date';
    }
    return $errors;
}

function selectValidation($errors,$value,$key){
    if($value<=0){
        $errors[$key] = 'Veuillez selectionner un vaccin';
    }
    return $errors;
}

function recupInputValue($key){
    if(!empty($_POST[$key]))return $_POST[$key];
}

function viewError($errors,$key)
{
    if(!empty($errors[$key])) {
        echo '<span class="error">'.$errors[$key];'</span>';
    }
}

function recupInputValueForUpdate($key,$data)
{
    if(!empty($_POST[$key])) {
        echo $_POST[$key];
    } else {
        echo $data;
    }
}
function passwordConfirmationValidation($errors,$value,$value2,$key){
    if($value !== $value2){
        $errors[$key] = 'Mots de passe différents !';
    }return $errors;
}

function generateRandomString(int $length = 200) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function isLogged()
{
    if(!empty($_SESSION['user'])) {
        if (!empty($_SESSION['user']['id'])) {
            if (!empty($_SESSION['user']['email'])) {
                if (!empty($_SESSION['user']['pseudo'])) {
                    if (!empty($_SESSION['user']['nom'])) {
                        if (!empty($_SESSION['user']['prenom'])) {
                            if (!empty($_SESSION['user']['age'])) {
                                if (!empty($_SESSION['user']['role'])) {
                                    if (!empty($_SESSION['user']['ip'])) {
                                        if ($_SESSION['user']['ip'] == $_SERVER['REMOTE_ADDR']) {
                                            return true;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    return false;
}

function isAdmin()
{
    if(isLogged()) {
        if($_SESSION['user']['role'] == 'admin') {
            return true;
        }
    }
    return false;
}

function error403()
{
    if ($_SESSION['user']['role'] != 'admin') {/*Si l'utilisateur n'a pas le role admin ont le rediriger vers une erreur 403*/
        header('HTTP/1.0 403 Forbidden');
        header('Location:../error403.php');
    }
}

function error404()
{
        header('HTTP/1.0 404 Not Found');
        header('Location:../error404.php');
}

function verifyIdBdd($idUser,$idUsers){
    if(!empty($idUser)){
        if(is_numeric($idUser)){
            foreach ($idUsers as $user){
                if ($idUser == $user['id']) {
                    $idValide = true;
                    break;
                } else {
                    $idValide = false;
                }
            }
        }else{
            echo 'ko nombre non numéric';
            $idValide = false;
        }
    }else{
        echo 'Ko id vide';
        $idValide = false;
    }
    return $idValide;
}

function getPourcentage($numérateur, $diviseur){
    $resultat = round(($numérateur / $diviseur * 100),2);
    return $resultat;
}

function dateFormat($date)
{
    return strftime('%A %e %B %Y',strtotime($date));
}

