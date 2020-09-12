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
    <form action="log.php" method="post">
        <input type="text" name="login" placeholder="Login" id="txt">
        <input type="password" name="pass" placeholder="Password" id="psw">
        <p id="spn"><input type="submit" value="Log In" id="sbm">
            <span id="na">Need account?  <a href="register.php" id="signup">Register</a></span></p>
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