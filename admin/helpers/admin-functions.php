<?php

include 'setup.php';

function sanitizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = stripslashes($data);
    $data = filter_var($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    return $data;
}


function haveSpecialChar($data)
{
    return preg_match('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $data);
}

function getCount($table)
{

    global $connection;

    $data_q = "SELECT * FROM `$table`";

    $data_stmt = mysqli_prepare($connection, $data_q);

    mysqli_stmt_execute($data_stmt);

    $result = mysqli_stmt_get_result($data_stmt);

    return mysqli_num_rows($result);
}


// --------------------- ADMIN -------------------------------

function getAdminByUsername($username)
{
    global $connection;

    $admin_data_q = "SELECT * FROM `admin` WHERE `username` = ?";

    $admin_data_stmt = mysqli_prepare($connection, $admin_data_q);

    mysqli_stmt_bind_param($admin_data_stmt, 's', $username);

    mysqli_stmt_execute($admin_data_stmt);

    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($admin_data_stmt));

    mysqli_stmt_close($admin_data_stmt);

    return $result;
}

function getAdminByEmail($email)
{
    global $connection;

    $admin_data_q = "SELECT * FROM `admin` WHERE `email` = ?";

    $admin_data_stmt = mysqli_prepare($connection, $admin_data_q);

    mysqli_stmt_bind_param($admin_data_stmt, 's', $email);

    mysqli_stmt_execute($admin_data_stmt);

    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($admin_data_stmt));

    mysqli_stmt_close($admin_data_stmt);

    return $result;
}

function admin_exist($username, $password)
{
    $adminExist = false;

    $result = getAdminByUsername($username);

    $db_username = isset($result['username']) ?  $result['username'] : NULL;
    $is_password = isset($result['password']) ? password_verify($password, $result['password']) : NULL;

    if ($db_username == $username && $is_password) {
        $adminExist = true;
    } else {
        $adminExist = false;
    }
    return $adminExist;
}

function email_exist($email)
{
    $emailExist = false;

    $result = getAdminByEmail($email);

    $db_email = $result['email'];

    if ($db_email == $email) {
        $emailExist = true;
    } else {
        $emailExist = false;
    }
    return $emailExist;
}


function loginAdmin($username, $password)
{
    if (admin_exist($username, $password)) {
        $result = getAdminByUsername($username);

        session_start();
        $_SESSION['s_adminID'] = $result['id'];
        $_SESSION['s_adminUsername'] = $result['username'];
        header("Location: index.php");
    }
}

function isAdminLoggedIn()
{
    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_SESSION['s_adminID']) && isset($_SESSION['s_adminUsername'])) {
        return true;
    } else {
        return false;
    }
}


function logoutAdmin()
{
    if (!isset($_SESSION)) {
        session_start();
    }

    $s_id = $_SESSION['s_adminID'];
    $s_username = $_SESSION['s_adminUsername'];

    $s_id = null;
    $s_username = null;

    unset($s_id);
    unset($s_username);

    session_destroy();
    header("Location: login.php");
}



// --------------------- STUDENT -------------------------------

function getStudentByEmail($email)
{
    global $connection;

    $student_data_q = "SELECT * FROM `students` WHERE `email` = ?";

    $student_data_stmt = mysqli_prepare($connection, $student_data_q);

    mysqli_stmt_bind_param($student_data_stmt, 's', $email);

    mysqli_stmt_execute($student_data_stmt);

    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($student_data_stmt));

    mysqli_stmt_close($student_data_stmt);

    return $result;
}

function student_email_exist($email)
{
    $emailExist = false;

    $result = getStudentByEmail($email);

    $db_email = isset($result['email']) ? $result['email'] : NULL;

    if ($db_email == $email) {
        $emailExist = true;
    } else {
        $emailExist = false;
    }
    return $emailExist;
}

function student_phone_exist($phone)
{
    global $connection;

    $student_data_q = "SELECT * FROM `students` WHERE `phonenumber` = ?";

    $student_data_stmt = mysqli_prepare($connection, $student_data_q);

    mysqli_stmt_bind_param($student_data_stmt, 's', $phone);

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

function getAllocatedStudents($examID){

    global $connection;

    $data_q = "SELECT * FROM `students` WHERE `allocation` = ?";

    $data_stmt = mysqli_prepare($connection, $data_q);

    mysqli_stmt_bind_param($data_stmt, 'i', $examID);

    mysqli_stmt_execute($data_stmt);

    $result = mysqli_stmt_get_result($data_stmt);

    mysqli_stmt_close($data_stmt);

    return mysqli_num_rows($result);
}


// --------------------- SUBJECT -------------------------------

function getSubjectByID($id){
    global $connection;

    $data_q = "SELECT * FROM `subjects` WHERE `id` = ?";

    $data_stmt = mysqli_prepare($connection, $data_q);

    mysqli_stmt_bind_param($data_stmt, 's', $id);

    mysqli_stmt_execute($data_stmt);

    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($data_stmt));

    mysqli_stmt_close($data_stmt);

    return $result;
}

function subject_exist($id)
{
    $subjectExist = false;

    $result = getSubjectByID($id);

    $db_subject = isset($result['id']) ? $result['id'] : NULL;

    if ($db_subject == $id) {
        $subjectExist = true;
    } else {
        $subjectExist = false;
    }
    return $subjectExist;
}

// --------------------- QUESTION -------------------------------

function getQuestionCorrectAnswer($id, $option){

    global $connection;

    $data_q = "SELECT * FROM `questions` WHERE `id` = ?";

    $data_stmt = mysqli_prepare($connection, $data_q);

    mysqli_stmt_bind_param($data_stmt, 'i', $id);

    mysqli_stmt_execute($data_stmt);

    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($data_stmt));

    mysqli_stmt_close($data_stmt);

    return $result[$option];
}

function getTotalQUestionsForSubject($subjectID){

    global $connection;

    $data_q = "SELECT * FROM `questions` WHERE `subject_id` = ?";

    $data_stmt = mysqli_prepare($connection, $data_q);

    mysqli_stmt_bind_param($data_stmt, 'i', $subjectID);

    mysqli_stmt_execute($data_stmt);

    $result = mysqli_stmt_get_result($data_stmt);

    mysqli_stmt_close($data_stmt);

    return mysqli_num_rows($result);
}

// --------------------- EXAMS -------------------------------


function getExamsByID($id){
    global $connection;

    $data_q = "SELECT * FROM `exams` WHERE `id` = ?";

    $data_stmt = mysqli_prepare($connection, $data_q);

    mysqli_stmt_bind_param($data_stmt, 's', $id);

    mysqli_stmt_execute($data_stmt);

    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($data_stmt));

    mysqli_stmt_close($data_stmt);

    return $result;
}

function exams_exist($id)
{
    $examsExist = false;

    $result = getExamsByID($id);

    $db_Exams = isset($result['id']) ? $result['id'] : NULL;

    if ($db_Exams == $id) {
        $examsExist = true;
    } else {
        $examsExist = false;
    }
    return $examsExist;
}   