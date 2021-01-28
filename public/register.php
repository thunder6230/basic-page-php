<?php

require_once 'config/config.php';
require_once 'includes/handlers/register-handler.php';
require_once 'controller/register-form-config.php';
require_once 'includes/classes/Input.php';

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
                            <?php 
                            foreach($config_register as $config_input){
                                $input = new Input($config_input);
                                echo $input->render();
                            }
                            ?>
                        </div>
                        <button type="submit" name="register_button" class="btn btn btn-outline-light fw-bold border-white mt-4 mb-2">Register</button>
                        <br>
                        <a href="login.php">Have an account already? Click here!</a>
                    </form>
                </div>


                <?php include 'includes/footer.php' ?>