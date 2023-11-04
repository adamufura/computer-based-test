<?php


if (isset($_GET['activate'])) {
    global $connection;

    $email = $_GET['email'];

    $updateQuery = "UPDATE `students` SET `status`='ACTIVE' WHERE `email` = ?";

    $update_stmt = mysqli_prepare($connection, $updateQuery);

    mysqli_stmt_bind_param($update_stmt, "s", $email);

    if (mysqli_stmt_execute($update_stmt)) {
            $msg = "success";
    }
}

if (isset($_GET['deactivate'])){ 
    global $connection;

    $email = $_GET['email'];

    $updateQuery = "UPDATE `students` SET `status`='INACTIVE' WHERE `email` = ?";

    $update_stmt = mysqli_prepare($connection, $updateQuery);

    mysqli_stmt_bind_param($update_stmt, "s", $email);

    if (mysqli_stmt_execute($update_stmt)) {
            $msg = "error";
    }
}