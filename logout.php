<?php
if (!isset($_SESSION)) {
    session_start();
}

unset($_SESSION['studentEmail']);
unset($_SESSION['studentPhone']);
unset($_SESSION['studentExam']);

session_destroy();
header("Location: index.php");
