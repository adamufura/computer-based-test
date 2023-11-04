<?php
if (isset($_POST['addStudent'])) {
    $email = mysqli_real_escape_string($connection, sanitizeInput($_POST['email']));
    $phonenumber = mysqli_real_escape_string($connection, sanitizeInput($_POST['phonenumber']));
    $fullname = mysqli_real_escape_string($connection, sanitizeInput($_POST['fullname']));

    $messages = [];

    if (empty($email) || empty($phonenumber) || empty($fullname)) {
        $messages['msgErr'] = "Inputs cannot be blank";
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $messages['msgErr'] = "Invalid email address";
    }  else if (strlen($phonenumber) > 11 || strlen($phonenumber) < 11) {
        $messages['msgErr'] = "Phone number must be 11 digits";
    } elseif (strpos($phonenumber, " ")) {
        $messages['msgErr'] = "Phone number cannot have spaces";
    } elseif (strlen($fullname) < 5 || strlen($fullname) > 100) {
        $messages['msgErr'] = "Full name must be between 5 and 100 characters";
    }else if (student_email_exist($email)) {
        $messages['msgErr'] = "student exist with same EMAIL";
    }else if (student_phone_exist($phonenumber)){
        $messages['msgErr'] = "student exist with same PHONE NUMBER";
    }

    $avatar = '../assets/images/avatars/avatar.png';

    // prepare image upload
    if ($_FILES['avatar']['error'] < 1 && isset($_FILES['avatar'])) {
        $avatar_name = $email;
        $file_input = 'avatar';
        $upload_dir = '../assets/images/avatars/';

        $target_file = $upload_dir .  basename($_FILES["avatar"]["name"]);
        $image_temp = $_FILES[$file_input]['tmp_name'];
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // return false if error occurred
        $error = $_FILES[$file_input]['error'];

        if ($error !== UPLOAD_ERR_OK) {
            $messages['msgErr'] = "Error Uploading image";
        }

          // resize image
        $maxDimW = 360;
        $maxDimH = 360;
        list($width, $height, $type, $attr) = getimagesize( $image_temp );
        if ( $width > $maxDimW || $height > $maxDimH ) {
            $target_filename = $image_temp;
            $fn = $image_temp;
            $size = getimagesize( $fn );
            $ratio = $size[0]/$size[1]; // width/height
            if( $ratio > 1) {
                $width = $maxDimW;
                $height = $maxDimH/$ratio;
            } else {
                $width = $maxDimW*$ratio;
                $height = $maxDimH;
            }
            $src = imagecreatefromstring(file_get_contents($fn));
            $dst = imagecreatetruecolor( $width, $height );
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
            imagejpeg($dst, $target_filename); // adjust format as needed
        }

        // move the uploaded file to the upload_dir
        $new_file = $upload_dir . $avatar_name . '.' . $imageFileType;

    if (move_uploaded_file($image_temp, $new_file)) {
            $avatar = $new_file;
        };
    }

    if (count($messages) < 1) {
        $add_student_query = "INSERT INTO `students`(`email`, `phonenumber`, `fullname`, `avatar`) VALUES (?, ?, ?, ?)";

        $add_student_stmt = mysqli_prepare($connection, $add_student_query);

        mysqli_stmt_bind_param(
            $add_student_stmt,
            "ssss",
            $email,
            $phonenumber,
            $fullname,
            $avatar
        );

        $exec_add_student = mysqli_stmt_execute($add_student_stmt);

        mysqli_stmt_close($add_student_stmt);

        if ($exec_add_student) {
            $messages['msgSucc'] = "Student Added Successfully...";
        } else {
            $messages['msgErr'] = "Error Occured adding student, try again";
        }
    }
}
