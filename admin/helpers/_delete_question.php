<?php

require 'admin_init.php';

$subject_id = $_POST['subject_id']; 
$q_id = $_POST['q_id']; 

$delete_q = "DELETE FROM `questions` WHERE `subject_id` = ? AND `id` = ?";

$delete_stmt = mysqli_prepare($connection, $delete_q);

mysqli_stmt_bind_param($delete_stmt, 'ii', $subject_id, $q_id);

mysqli_stmt_execute($delete_stmt);

mysqli_stmt_close($delete_stmt);

?>
