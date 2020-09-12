<?php
session_start();
require 'cfg.php';

$login = trim(htmlspecialchars($_POST['login']));
$pass = trim(htmlspecialchars($_POST['pass']));

$redir = 'Location:/login.php';

if (strlen($login) < 5) {
    $_SESSION['error'] = 'Name must be longer';
    header($redir);
    die();
}

if (strlen($login) > 24) {
    $_SESSION['error'] = 'Name must be shorter';
    header($redir);
    die();
}

if (strlen($pass) < 5) {
    $_SESSION['error'] = 'Password must be longer';
    header($redir);
    die();
}

if (strlen($pass) > 24) {
    $_SESSION['error'] = 'Password must be shorter';
    header($redir);
    die();
}

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$user_data = "SELECT * FROM users WHERE login = '$login'";
$user_data = mysqli_query($db, $user_data);
$user_data = mysqli_fetch_assoc($user_data);

if (!is_array($user_data)) {
    $_SESSION['error'] = 'Uncorrect login or password';
    header('Location:/login.php');
    die();
}
$pass = md5($pass);

if ($user_data['password'] != $pass) {
    $_SESSION['error'] = 'Uncorrect login or password';
    header('Location:/login.php');
    die();
}

$_SESSION['id'] = $user_data['id'];
$_SESSION['name'] = $user_data['name'];
$_SESSION['email'] = $user_data['email'];
$_SESSION['login'] = $user_data['login'];
$_SESSION['password'] = $user_data['password'];
$_SESSION['loggined'] = true;

header('Location:/home.php');
die();