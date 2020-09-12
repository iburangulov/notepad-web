<?php
session_start();
if (!isset($_SESSION['loggined']) || $_SESSION['loggined'] == false) {
    session_destroy();
    $redir = 'Location:/login.php';
    header($redir);
    die();
}

if (!isset($_SESSION['id']) || !isset($_SESSION['name']) || !isset($_SESSION['email']) || !isset($_SESSION['login']) ||
    !isset($_SESSION['password'])) {
    session_destroy();
    $redir = 'Location:/login.php';
    header($redir);
    die();
}
$redir = 'Location:/home.php';
$delid =  $_POST['delid'];
require 'cfg.php';

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$notel = "SELECT * FROM notes WHERE id = '$delid'";
$delrequest = "DELETE FROM notes WHERE id = '$delid'";
$notel = mysqli_query($db, $notel);
$notel = mysqli_fetch_assoc($notel);

if ($_SESSION['password'] != $notel['passkey']) {
    session_destroy();
    header($redir);
    die();
} else {
    $query = mysqli_query($db, $delrequest);
    header($redir);
    die();
}
