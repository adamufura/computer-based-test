<?php

$student_data_q = "SELECT * FROM `students`";

$student_data_stmt = mysqli_prepare($connection, $student_data_q);

mysqli_stmt_execute($student_data_stmt);

$student_res = mysqli_stmt_get_result($student_data_stmt);

