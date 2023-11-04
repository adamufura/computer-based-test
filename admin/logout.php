<?php
if (!isset($_SESSION)) {
    session_start();
}

$s_id = $_SESSION['s_adminID'];
$s_username = $_SESSION['s_adminUsername'];

$s_id = null;
$s_username = null;

unset($s_id);
unset($s_username);

session_destroy();
header("Location: login.php");
