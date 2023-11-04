<?php

$exam_id = $_GET['examsID'];

$data_q = "SELECT * FROM `results` WHERE exam_id = ?";

$data_stmt = mysqli_prepare($connection, $data_q);

mysqli_stmt_bind_param($data_stmt, "i",  $exam_id);

mysqli_stmt_execute($data_stmt);

$exam_results = mysqli_stmt_get_result($data_stmt);

