<?php


if (isset($_GET['allocate'])) {
    global $connection;

    $examsID = $_GET['examsID'];

    $email = $_GET['allocate'];

    if (getStudentByEmail($email)['status'] != "ACTIVE") {
        $msg = $email . " is <span class='text-danger'>INACTIVE</span> and cannot be allocated.";
        return;
    }

$updateQuery = "UPDATE `students` SET `allocation`= ? WHERE `email` = ? AND `status` = 'ACTIVE'";

    $update_stmt = mysqli_prepare($connection, $updateQuery);

    mysqli_stmt_bind_param($update_stmt, "is", $examsID, $email);

    if (mysqli_stmt_execute($update_stmt)) {
        $msg = $email . " is successfully Allocated";
    }
}

if (isset($_GET['deallocate'])){ 
    global $connection;

    $email = $_GET['deallocate'];

    $updateQuery = "UPDATE `students` SET `allocation`= '0' WHERE `email` = ? AND `status` = 'ACTIVE'";

    $update_stmt = mysqli_prepare($connection, $updateQuery);

    mysqli_stmt_bind_param($update_stmt, "s", $email);

    if (mysqli_stmt_execute($update_stmt)) {
        $msg = $email . " is successfully Deallocated.";
    }
}