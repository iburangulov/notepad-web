<?php
session_start();
require 'cfg.php';

$name = trim(htmlspecialchars($_POST['name']));
$email = trim(htmlspecialchars($_POST['email']));
$login = trim(htmlspecialchars($_POST['login']));
$pass1 = trim(htmlspecialchars($_POST['pass1']));
$pass2 = trim(htmlspecialchars($_POST['pass2']));

$redir = 'Location:/register.php';

if (strlen($name) < 5) {
    $_SESSION['error'] = 'Name must be longer';
    header($redir);
    die();
}

if (strlen($name) > 24) {
    $_SESSION['error'] = 'Name must be shorter';
    header($redir);
    die();
}

if (strlen($email) < 5) {
    $_SESSION['error'] = 'E-mail must be longer';
    header($redir);
    die();
}

if (strlen($email) > 48) {
    $_SESSION['error'] = 'E-mail must be shorter';
    header($redir);
    die();
}

if (strlen($login) < 5) {
    $_SESSION['error'] = 'Login must be longer';
    header($redir);
    die();
}

if (strlen($login) > 24) {
    $_SESSION['error'] = 'Login must be shorter';
    header($redir);
    die();
}

if ($pass1 != $pass2) {
    $_SESSION['error'] = 'Passwords must match';
    header($redir);
    die();
}

if (strlen($pass1) < 5) {
    $_SESSION['error'] = 'Password must be longer';
    header($redir);
    die();
}

if (strlen($pass1) > 24) {
    $_SESSION['error'] = 'Password must be shorter';
    header($redir);
    die();
}

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$check_name = "SELECT name FROM users WHERE name = '$name'";
$check_email = "SELECT name FROM users WHERE email = '$email'";
$check_login = "SELECT name FROM users WHERE login = '$login'";

$query = mysqli_query($db, $check_name);
$result = mysqli_fetch_assoc($query);

if (is_array($result)) {
    $_SESSION['error'] = 'Name is taken';
    header($redir);
    die();
}

$query = mysqli_query($db, $check_email);
$result = mysqli_fetch_assoc($query);

if (is_array($result)) {
    $_SESSION['error'] = 'E-mail is taken';
    header($redir);
    die();
}

$query = mysqli_query($db, $check_login);
$result = mysqli_fetch_assoc($query);

if (is_array($result)) {
    $_SESSION['error'] = 'Login is taken';
    header($redir);
    die();
}

$password = md5($pass1);

$query = "INSERT INTO users (name, email, login, password) VALUES ('$name', '$email', '$login', '$password')";
$reg_user = mysqli_query($db, $query);

$_SESSION['error'] = 'Registered!';
header($redir);
die();
