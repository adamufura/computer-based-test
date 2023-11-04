<?php

// get exams
$exams_data_q = "SELECT * FROM `exams`";

$exams_data_stmt = mysqli_prepare($connection,$exams_data_q);

mysqli_stmt_execute($exams_data_stmt);

$exams_res = mysqli_stmt_get_result($exams_data_stmt);

mysqli_stmt_close($exams_data_stmt);

if (isset($_POST['loginStudent'])) {
    $loginType = mysqli_real_escape_string($connection, sanitizeInput($_POST['loginType']));
    $examType = mysqli_real_escape_string($connection, sanitizeInput($_POST['examType']));
    $emailphone = mysqli_real_escape_string($connection, sanitizeInput($_POST['emailphone']));

    $studentMessages = "";
    if (empty($emailphone)) {
        $studentMessages = "Email/Phone cannot be empty";
        return;
    }

    // validate credentials 
    if ($loginType == 'email') {
        // EMAIL LOGIN
        if (student_email_exist($emailphone)) {
            // login student
            $studentEmail = getStudentByEmail($emailphone);
            $isActive = $studentEmail['status'];
            if ($isActive == "ACTIVE") {
                if ($studentEmail['allocation'] == $examType) {
                    if(!hasStudentTakenExam($examType, $emailphone)){
                        loginStudent($emailphone, $studentEmail['phone'], $examType);
                    }else{
                    $studentMessages = "You have already taken this EXAMS!";
                    }
                }else{
                    $studentMessages = "You did not register for this EXAMS, <a href='complain.php'>Send a complain to admin</a>";
                }
            }else{
                $studentMessages = "Your account is INACTIVE, <a href='complain.php'>Send a complain to admin</a>";
            }
        }else {
            $studentMessages = "Incorrect Email Address";
        }
    }

    if ($loginType == 'phonenumber') {
        // phone number LOGIN
        if (student_phone_exist($emailphone)) {
            // login student
            $studentPhone = getStudentByPhone($emailphone);
            $isActive = $studentPhone['status'];
            if ($isActive == "ACTIVE") {
                if ($studentPhone['allocation'] == $examType) {
                    if(!hasStudentTakenExam($examType, $studentPhone['email'])){
                    loginStudent($studentPhone['email'], $studentPhone['phonenumber'], $examType);
                    }else{
                    $studentMessages = "You have already taken this EXAMS!";
                    }
                }else{
                    $studentMessages = "You did not register for this EXAMS, <a href='complain.php'>Send a complain to admin</a>";
                }
            }else{
                $studentMessages = "Your account is INACTIVE, <a href='complain.php'>Send a complain to admin</a>";
            }
        }else {
            $studentMessages = "Incorrect Phone Number";
        }
    }

}
