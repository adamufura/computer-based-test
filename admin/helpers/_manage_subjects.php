<?php

$subject_data_q = "SELECT * FROM `subjects`";

$subject_data_stmt = mysqli_prepare($connection, $subject_data_q);

mysqli_stmt_execute($subject_data_stmt);

$subject_res = mysqli_stmt_get_result($subject_data_stmt);

