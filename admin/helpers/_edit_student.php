<?php
if (isset($_POST['editStudent'])) {
    $phonenumber = mysqli_real_escape_string($connection, sanitizeInput($_POST['phonenumber']));
    $fullname = mysqli_real_escape_string($connection, sanitizeInput($_POST['fullname']));

    $messages = [];

    $email = $_GET['email'];

    if (empty($phonenumber) || empty($fullname)) {
        $messages['msgErr'] = "Inputs cannot be blank";
    }else if (strlen($phonenumber) > 11 || strlen($phonenumber) < 11) {
        $messages['msgErr'] = "Phone number must be 11 digits";
    } elseif (strpos($phonenumber, " ")) {
        $messages['msgErr'] = "Phone number cannot have spaces";
    } elseif (strlen($fullname) < 5 || strlen($fullname) > 100) {
        $messages['msgErr'] = "Full name must be between 5 and 100 characters";
    }else if (not_current_student_phone_exist($phonenumber, $email)){
        $messages['msgErr'] = "student exist with same PHONE NUMBER";
    }

    if (count($messages) < 1) {
    $edit_student_query = "UPDATE `students` SET `phonenumber`=?,`fullname`=? WHERE `email` = ?";

        $edit_student_stmt = mysqli_prepare($connection, $edit_student_query);

        mysqli_stmt_bind_param(
            $edit_student_stmt,
            "sss",
            $phonenumber,
            $fullname,
            $email
        );

        $exec_edit_student = mysqli_stmt_execute($edit_student_stmt);

        mysqli_stmt_close($edit_student_stmt);

        if ($exec_edit_student) {
            $messages['msgSucc'] = "Student Updated Successfully...";
        } else {
            $messages['msgErr'] = "Error Occured updating student, try again";
        }
    }
}


function not_current_student_phone_exist($phone, $email)
{
    global $connection;

    $student_data_q = "SELECT * FROM `students` WHERE `phonenumber` = ? AND email <> ?";

    $student_data_stmt = mysqli_prepare($connection, $student_data_q);

    mysqli_stmt_bind_param($student_data_stmt, 'ss', $phone, $email);

    mysqli_stmt_execute($student_data_stmt);

    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($student_data_stmt));

    mysqli_stmt_close($student_data_stmt);

    $studentPhoneExist = false;

    $db_studentID = isset($result['phonenumber']) ? $result['phonenumber'] : NULL;

    if ($db_studentID == $phone) {
        $studentPhoneExist = true;
    } else {
        $studentPhoneExist = false;
    }
    return $studentPhoneExist;
}