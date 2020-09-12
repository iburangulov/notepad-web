<?php
session_start();

require 'cfg.php';

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

$passkey = $_SESSION['password'];
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$query = "SELECT * FROM notes WHERE passkey = '$passkey'";
$data = mysqli_query($db, $query);
$num = mysqli_num_rows($data);
$result = array();

for ($i = 0; $i < $num; $i++) {
    $result[$i] = mysqli_fetch_assoc($data);
}

?>
<html>
<head>
    <link rel="stylesheet" href="home.css" type="text/css">
    <title>Home</title>
</head>
<body>

<div id="top">
    <?php
    echo '<span>';
    echo 'Name: ' . $_SESSION['name'] . '</span><span>';
    echo 'E-mail: ' . $_SESSION['email'] . '</span><span>';
    echo 'Identeficator: ' . $_SESSION['id'] . '</span>';
    ?>
    <span>
        <?php
        echo 'Login: ' . $_SESSION['login'] . '   ';
        ?>
    <a href="logout.php">Logout</a></span>
</div>
<div id="cont">

    <form action="addnote.php" method="post" id="addn">
        <textarea id="inp" name="note" placeholder="Note text"></textarea><span id="bot_inp">
        <input type="text" name="notename" placeholder="Note name" id="notename" maxlength="64">
        <button type="submit" id="smb">Save</button>
        <span id="errors">
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>

        </span> </span>
    </form>

    <?php
    for ($i = 0; $i < $num; $i++) {
        $temp = $result[$i];
        echo '<div id=\'boxx\'><span id="notename">';
        echo $temp['notename'] . '</span><br><span id="timebox"><span id="time">'
            . $temp['writed'] . '</span><form action="delnote.php" method="post"><input type="text" hidden name="delid" 
value="' . $temp['id'] . '"><input type="submit" value="Delete"></form></span><br><div id="note_cont">
 '. $temp['note'] .' 
</div></div>';
    }
        ?>
</div>
<div id="cpr">
© <?php
echo date('Y') . ' Insaf Burangulov';
?>
</div>
</body>
</html>