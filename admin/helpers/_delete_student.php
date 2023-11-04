<?php

require 'admin_init.php';

$email = $_POST['email']; 

$delete_q = "DELETE FROM `students` WHERE `email` = ?";

$delete_stmt = mysqli_prepare($connection, $delete_q);

mysqli_stmt_bind_param($delete_stmt, 's', $email);

mysqli_stmt_execute($delete_stmt);

mysqli_stmt_close($delete_stmt);

?>
