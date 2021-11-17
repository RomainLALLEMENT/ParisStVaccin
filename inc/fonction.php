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

function recupInputValue($key){
    if(!empty($_POST[$key]))return $_POST[$key];
}

function viewError($errors,$key)
{
    if(!empty($errors[$key])) {
        echo $errors[$key];
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