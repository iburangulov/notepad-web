<?php
session_start();

if ($_SESSION['loggined'] == true) {
    $redir = 'Location:/home.php';
    header($redir);
    die();
}

if (!isset($_SESSION['loggined']) || $_SESSION['loggined'] == false) {
    session_destroy();
    $redir = 'Location:/login.php';
    header($redir);
    die();
}


