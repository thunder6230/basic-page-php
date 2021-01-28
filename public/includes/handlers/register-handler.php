<?php
    // Load error messages
    require 'includes/error-messages.php';
    
    $date = '';
    $errorArr = [];

    //sanitizing function with boolean to make the first letter capital

    function sanitizeInputNameOrAddress($input_value, $isName) {
        $input = trim($input_value);
        $input = strip_tags($input);
        if ($isName) {
            $input = ucfirst(strtolower($input));
        }
        return $input;
    }   
    
    //a function to create confirmation email
    //the logic behind written down before the query
    function sendConfirmationEmail($confirm_email, $fname, $lname, $hash){

        $link = "http://localhost/customers/confirm-email.php?email=$confirm_email&hash=$hash";
        $subject = "confirm you account";
        $msg = "Thank you $fname $lname for your registration on the 'SITE'! \n\n Please click on the link below to confirm your account \n
        $link \n Best regards, \n\n The Team";
        $headers = "From: Admin <noreply@thissite.com>\r\n";
        $sent_mail = mail($confirm_email, $subject, $msg, $headers);
        if(!$sent_mail){
            echo "Error sending email!";
        }
    }
   
    if( !empty($_POST)){
    // sanitize form inputs and extract them from POST assigned by $key and the $value like in the loop below
        foreach ($_POST as $key => &$post_value) {
            if ($key == 'email' || $key == 'email2' || $key == 'password' || $key == 'password2') {
                $post_value = sanitizeInputNameOrAddress($post_value, false);
            } else {
                $post_value = sanitizeInputNameOrAddress($post_value, true);
            }
        }

        //creating new variables assigned by $key => $value
        extract($_POST);
       
        //session variables to load them in input values exceps passwords
        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;
        $_SESSION['email'] = $email;
        $_SESSION['email2'] = $email2;

        //registration date
        $date_added = date("Y-m-d");

        //firstname and lastname validation min 2 max 25 chars
        if(strlen($fname) < 2 || strlen($fname) > 25){
            $errorArr[] = $fname_error;
        }

        if (strlen($lname) < 2 || strlen($lname) > 25) {
            $errorArr[] = $lname_error;
        }

        //email validation
        if( $email == $email2){
            //check email in database
            $email_query = mysqli_query($con, "SELECT * from `users` WHERE `email`='$email'");

            //if query num rows > 0 then the email is in use
            if(mysqli_num_rows($email_query) > 0){
                $errorArr[] = $email_error_taken;
            }
            if (filter_var($email, FILTER_SANITIZE_EMAIL)) {
                $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            } else { 
                $errorArr[] = $email_error_format;
            }  
        } else {
            
            $errorArr[] = $email_error_match;
        }

        //password validation
        if($password == $password2){
        //length minimum 6 max 35 chars
            if(strlen($password) > 35 || strlen($password) < 6){
                $errorArr[] = $password_error_length;
            }
            //special character 
            $pattern_password = "/^[a-zA-Z0-9!§$%&()=?@* \/\-ß]+$/i";
            if (!preg_match($pattern_password, $password)) {
                $errorArr[] = $password_error_format;
            }
            //encrypt password
            $password = md5($password);
        }else {
            $errorArr[] = $password_error_match;
        }

        //basic user rank
        //only admin can change it from admin panel (future plan)
        $user_role = "generic";

        //create username
        $username = strtolower($fname) . "_" . strtolower($lname);
       
        //check username in db
        $username_sql = "SELECT `username` FROM `users` WHERE `username`='$username'";
        $username_query = mysqli_query($con, $username_sql);
        $counter = 0;
        if(!$username_query){
            echo "Error: " .$username_sql . "<br>" . mysqli_error($con);
        }else{
            while (mysqli_num_rows($username_query) != 0) {
                $counter++;

                if ($counter > 1) {
                    if ($counter > 9) {
                        $username = substr($username, 0, -3);
                    } else {
                        $username = substr($username, 0, -2);
                    }
                }
                $username = $username . "_" . $counter;
                $username_sql = "SELECT `username` FROM `users` WHERE `username`='$username'";
                $username_query = mysqli_query($con, $username_sql);
            }
        }
    //we will add a default profile pic to all accounts. we make a logic to be the selection dynamic from the folder.
        $def_prof_pic_path = 'assets/images/profile_pics/defaults';
        $def_prof_pics = scandir($def_prof_pic_path);
        $random_num = mt_rand(0, count($def_prof_pics) - 1);
        $profile_pic = "assets/images/profile_pics/defaults/" . $def_prof_pics[$random_num];
        //all accounts are inactive to verify them // there will be more messages to the user to do it
        //we have to create a unique 32 char hash tag for the account and add to the account. we create a confirmation link with it and with a post method we will check if the user has it in db. If yes the account will be verified with an update query.
        $hash = md5 (rand(0,1000));
        $is_active = "no";
        $is_blocked = "no";

        //insert to database if there is no error
    
        if(empty($errorArr)) {
            
            $sql = "INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`,`profile_pic`, `date_added`,  `username`, `address`, `country`, `zip`, `city`, `role`, `activation_code`, `is_active`, `is_blocked`) VALUES (NULL, '$fname', '$lname', '$email', '$password','$profile_pic', '$date_added', '$username', '', '', '', '', '$user_role', '$hash', '$is_active', '$is_blocked')";
 
            if (mysqli_query($con, $sql)){
                //clear session variables and create new ones for the login page
                session_unset();
                sendConfirmationEmail($email, $fname, $lname, $hash);
                $_SESSION['login_email'] = $email;
                $_SESSION['message'] = "Registration successfull!<br>We sent a verification email to your address!";
                //go to login
                header("Location: login.php");
            } else {
                echo "error: " . $sql . "<br>" . mysqli_error($con);
            }

            

        }
    }
?>
