<?php
if (isset($_POST['loginAdmin'])) {
    $username = mysqli_real_escape_string($connection, sanitizeInput($_POST['username']));
    $password = mysqli_real_escape_string($connection, sanitizeInput($_POST['password']));

    $adminErrors = [];
    // validate email
    if (empty($username)) {
        $adminErrors['usernameErr'] = "Username cannot be empty";
    }

    //  validate password
    if (empty($password)) {
        $adminErrors['passErr'] = "Password cannot be empty";
    }

    // validate credentials 
    if (!admin_exist($username, $password)) {
        $adminErrors['credentialErr'] = "Incorrect username or password";
    }

    if (count($adminErrors) < 1) {
        // login admin
        loginAdmin($username, $password);
    }
}