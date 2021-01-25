<?php

require 'config/config.php';
require 'includes/handlers/register-handler.php';
?>
<!DOCTYPE html>
<html lang="de" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Practice</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

    <body class="d-flex h-100 text-center text-white bg-dark">
        <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
            <header class="mb-auto">
                <h1>Welcome to Site</h1>
            </header>
            <main class="px-3">
                <div class="col-md-7 col-lg-8 centered">
                    <h4 class="mb-3">Create an account to continue</h4>
                    <form class="needs-validation" action="register.php" method="POST">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <!-- Error message appears always under the input or input groups -->
                                <!-- the values come from session variables -->

                                <label for="fname" class="form-label">First name</label>
                                <input type="text" class="form-control" id="fname" placeholder="" name="fname" value="<?php if (isset($_SESSION['fname'])) echo $_SESSION['fname'] ?>" required>
                                <!-- first name error message -->
                                <div class="invalid-feedback">
                                    <?php if (in_array($fname_error, $errorArr)) echo $fname_error ?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="lname" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="lname" placeholder="" name="lname" value="<?php if (isset($_SESSION['lname'])) echo $_SESSION['lname'] ?>" required>
                                <!-- lastm name error message -->
                                <div class="invalid-feedback">
                                    <?php if (in_array($lname_error, $errorArr)) echo $lname_error ?>
                                </div>
                            </div>

                            <!-- Emails -->

                            <div class="col-12">
                                <label for="reg_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="reg_email" name="reg_email" placeholder="you@example.com" value="<?php if (isset($_SESSION['email'])) echo $_SESSION['email'] ?>">
                            </div>
                            <div class="col-12">
                                <label for="reg_email2" class="form-label">Confirm Email</label>
                                <input type="email" class="form-control" id="reg_email2" name="reg_email2" placeholder="you@example.com" value="<?php if (isset($_SESSION['email2'])) echo $_SESSION['email2'] ?>">
                                <div class="invalid-feedback">
                                    <?php
                                    if (in_array($email_error_taken, $errorArr)) echo $email_error_taken;
                                    if (in_array($email_error_format, $errorArr)) echo $email_error_format;
                                    if (in_array($email_error_match, $errorArr)) echo $email_error_match;
                                    ?>
                                </div>
                            </div>

                            <!-- Passwords -->
                            <div class="col-12">
                                <label for="reg_password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="reg_password" name="reg_password" required>
                            </div>
                            <div class="col-12">
                                <label for="reg_password2" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="reg_password2" name="reg_password2" required>
                                <div class="invalid-feedback">
                                    <?php
                                    if (in_array($password_error_match, $errorArr)) echo $password_error_match;
                                    if (in_array($password_error_format, $errorArr)) echo $password_error_format;
                                    if (in_array($password_error_length, $errorArr)) echo $password_error_length ?>
                                </div>
                            </div>

                        </div>
                        <button type="submit" name="register_button" class="btn btn btn-outline-light fw-bold border-white mt-4 mb-2">Register</button>
                        <br>
                        <a href="login.php">Have an account already? Click here!</a>
                    </form>
                </div>


                <?php include 'includes/footer.php' ?>