<?php

require 'config/config.php';
require 'includes/handlers/login-handler.php';

//Here we check if the user came directly after registration. If yes we create variables from the saved session variables.
$email = '';
$message = '';
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
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
                    <?php if($message != '') echo "<h4 class='mb-5 mt-auto'>$message</h4>" ?>
                    <h4 class="mb-3">Login to continue</h4>
                    <form class="needs-validation" action="login.php" method="POST">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="log_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="log_email" name="log_email" placeholder="you@example.com" 
                                value="<?php
                                if (isset($_SESSION['login_email'])){
                                    echo $_SESSION['login_email'];
                                } else if($email != ""){
                                    echo $email;
                                }?>" required>
                                <div class="invalid-feedback">
                                    <?php if ($msg != "") echo $msg ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="log_password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="log_password" name="log_password" required>
                            </div>
                        </div>
                        <button type="submit"  name="login_button" class="btn btn btn-outline-light fw-bold border-white mt-4 mb-2">Login</button>
                                <br>
                                <a href="register.php">Haven't registered yet? Click here!</a>
                                <br>

                                
                    </form>
                </div>
<?php include 'includes/footer.php' ?>