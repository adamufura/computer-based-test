<?php

require 'admin_init.php';

$id = $_POST['id']; 

$delete_q = "DELETE FROM `exams` WHERE `id` = ?";

$delete_stmt = mysqli_prepare($connection, $delete_q);

mysqli_stmt_bind_param($delete_stmt, 's', $id);

mysqli_stmt_execute($delete_stmt);

mysqli_stmt_close($delete_stmt);

?>
