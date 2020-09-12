<?php
session_start();
session_destroy();
$redir = 'Location:/login.php';
header($redir);
die();
