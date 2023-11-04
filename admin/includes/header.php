<?php if (!isAdminLoggedIn()) {
    header("Location: login.php");
} 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"
      name="viewport"
    />
    <title><?php echo $variable['title']; ?></title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/components.css" />
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css" />
    <link rel="stylesheet" href="assets/css/sweetalert2.css">
    <link rel="stylesheet" href="assets/bundles/summernote/summernote-bs4.css">
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="assets/images/logo.png"
    />
  </head>