<?php

if(!isset($_GET['id']) || !subject_exist($_GET['id'])){
    header("Location: questions.php");
}

$questions_data_q = "SELECT * FROM `questions` WHERE `subject_id` = ?";

$questions_data_stmt = mysqli_prepare($connection, $questions_data_q);

mysqli_stmt_bind_param($questions_data_stmt, "i", $_GET['id']);

mysqli_stmt_execute($questions_data_stmt);

$questions_res = mysqli_stmt_get_result($questions_data_stmt);

