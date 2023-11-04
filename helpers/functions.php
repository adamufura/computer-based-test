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

function getStudentByPhone($phone)
{
    global $connection;

    $student_data_q = "SELECT * FROM `students` WHERE `phonenumber` = ?";

    $student_data_stmt = mysqli_prepare($connection, $student_data_q);

    mysqli_stmt_bind_param($student_data_stmt, 's', $phone);

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

function loginStudent($email, $phone, $exam){
    session_start();
    $_SESSION['studentEmail'] = $email;
    $_SESSION['studentPhone'] = $phone;
    $_SESSION['studentExam'] = $exam;

    header("Location: instructions.php");
}


function isStudentLoggedIn()
{
    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_SESSION['studentEmail']) && isset($_SESSION['studentPhone']) && isset($_SESSION[$_SESSION['studentExam']])) {
        return true;
    } else {
        return false;
    }
}

function hasStudentTakenExam($examID, $email){
    global $connection;

    $student_data_q = "SELECT * FROM `results` WHERE `exam_id` = ? AND student_id = ?";

    $student_data_stmt = mysqli_prepare($connection, $student_data_q);

    mysqli_stmt_bind_param($student_data_stmt, 'is', $examID, $email);

    mysqli_stmt_execute($student_data_stmt);

    $result = mysqli_stmt_get_result($student_data_stmt);

    mysqli_stmt_close($student_data_stmt);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
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

function getQuestionByNumber($subjectId, $questionNumber){
    global $connection;

    $data_q = "SELECT * FROM `questions` WHERE `id` = ? AND subject_id = ?";

    $data_stmt = mysqli_prepare($connection, $data_q);

    mysqli_stmt_bind_param($data_stmt, 'ii', $questionNumber, $subjectId);

    mysqli_stmt_execute($data_stmt);

    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($data_stmt));

    mysqli_stmt_close($data_stmt);

    return $result;
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