<?php
session_start();
if ($_SESSION['loggined'] == true) {
    $redir = 'Location:/home.php';
    header($redir);
    die();
}
?>

<html>
<head>
    <link rel="stylesheet" href="main.css" type="text/css">
    <title>Log In</title>
</head>
<body>


<div class = "ins">
    <form action="reg.php" method="post">
        <input type="name" name="name" placeholder="Name" id="txt">
        <input type="email" name="email" placeholder="E-mail" id="txt">
        <input type="text" name="login" placeholder="Login" id="txt">
        <input type="password" name="pass1" placeholder="Password" id="psw">
        <input type="password" name="pass2" placeholder="Confirm password" id="psw">
        <p id="spn"><input type="submit" value="Register" id="sbm">
        <span id="na">Have account?  <a href="login.php" id="signup">Log In</a></span></p>
    </form>
    <span id="err">
        <?php
        echo $_SESSION['error'];
        unset($_SESSION['error']);
        ?>
    </span>
</div>
</body>
</html>