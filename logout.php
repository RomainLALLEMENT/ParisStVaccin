<?php
require ('inc/fonction.php');
session_start();
if (isLogged()) {
    $_SESSION = array();
    session_destroy();
    header('Location: index.php');
}else{
    header('HTTP/1.0 403 Forbidden');
    header('Location:error403.php');
}