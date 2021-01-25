<?php
    require 'includes/error-messages.php';
    $email = '';
    $password = '';
    $loggedIn = false;
    $userLoggedIn = '';
    $msg = '';


    //read inputs

    if(isset($_POST['login_button'])){
        $email = trim($_POST['log_email']);
        $_SESSION['login_email'] = $email;
        $password = $_POST['log_password'];
        $password = md5($password);

        //check database if user exists
        $user_query = mysqli_query($con, "SELECT * from `users` where email='$email'");
        $row = mysqli_fetch_array($user_query);
        $user_email = $row['email'];
        $user_password = $row['password'];
        $user_username = $row['username'];

        //check if user is $is_blocked
        $user_blocked = $row['is_blocked'];
        if($user_blocked != "yes"){
            if ($email == $user_email) {
                if ($password == $user_password) {
                    session_destroy();
                    session_start();
                    $_SESSION['userLoggedIn'] = $user_username;
                } else {
                    $msg = "<span class='error'>Invalid Email or Password!</span>";
                }
            } else {
                $msg = "<span class='error'>Invalid Email or Password!</span>";
            }

            if (isset($_SESSION['userLoggedIn'])) {
                header("Location: index.php");
            }
        } else {
            $msg = "<span class='error'>This account has been suspended!</span>";
        }

        
        
    }
