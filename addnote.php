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

$note = $_POST['note'];
$notename = $_POST['notename'];
$redir = 'Location:/home.php';

if (strlen($note) < 1) {
    $_SESSION['error'] = 'Note must be filled';
    header($redir);
    die();
}

if (strlen($note) > 26000) {
    $_SESSION['error'] = 'Note must be shorter';
    header($redir);
    die();
}

if (strlen($notename) < 1) {
    $_SESSION['error'] = 'Note name must be filled';
    header($redir);
    die();
}

if (strlen($notename) > 64) {
    $_SESSION['error'] = 'Note name must be shorter';
    header($redir);
    die();
}

require 'cfg.php';

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$pass = $_SESSION['password'];
$today = date("Y-m-d H:i:s");

$query = "INSERT INTO notes (passkey, notename, note, writed) VALUES ('$pass', '$notename', '$note', '$today')";
$ins = mysqli_query($db, $query);

$redir = 'Location:/home.php';
header($redir);
die();
