<?php
require 'includes/error-messages.php';

$errorArr = [];


$current_password = '';
$control_password = '';
$new_password = '';
$new_password2 = '';

function sanitizeInputNameOrAddress($input_value, $isName){
    $input = trim($input_value);
    $input = strip_tags($input);
    if($isName){
        $input = ucfirst(strtolower($input));
    }
    return $input;
}
    //Update profile form 
    if (isset($_POST['update_profile_button'])) {
    //Santize inputs
        foreach ($_POST as $key => &$post_value) {
            if($key == 'email' || $key == 'zip' || $key == 'username'){
                $post_value = sanitizeInputNameOrAddress($post_value, false);
            }else {
                $post_value = sanitizeInputNameOrAddress($post_value, true);
            }
        }
        extract($_POST);

        //name validations
        if (strlen($fname) < 2 || strlen($fname) > 25) {
            $errorArr[] = $fname_error;
        }

        if (strlen($lname) < 2 || strlen($lname) > 25) {
            $errorArr[] = $lname_error;
        }

        //email validation

        if (filter_var($email, FILTER_SANITIZE_EMAIL)) {
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            //check if new email is not in use
            //We want to check if the written email is different from the actual one, if yes we will check in database if somebody already use it
            $current_email = $user_data['email'];

            if($current_email != $email){
            $email_query = mysqli_query($con, "SELECT * FROM `users` WHERE `email`='$email'");
            if (mysqli_num_rows($email_error_taken) > 0) {
                $errorArr[] = $email_error_taken;
            }
        }
        } else {
            $errorArr[] = $email_error_format;
        }

    //username validation
    //We want to check if the written username is different from the actual one, if yes we will check in database if somebody already use it

        $current_username = $user_data['username'];
        if($username != $current_username){
            $username_query = mysqli_query($con, "SELECT * FROM `users` WHERE `username`='$username'");
            if(mysqli_num_rows($username_query) > 0 ){
                $errorArr = $username_error;
            }
        }
        
        
        //address validation
        
        $pattern_address = "/^[a-zA-Z0-9 \/\-ß]+$/i";
        if(!preg_match($pattern_address, $address)){
            $errorArr[] = $address_error;
        }

        //city validation

        $pattern_city = "/^[a-zA-Z]+$/i";
        if(!preg_match($pattern_city, $city)){
            $errorArr[] = $city_error;
        }
        //postal code validation
        $pattern_numbers_only = "/^[0-9]+$/";
        if(!preg_match($pattern_numbers_only, $zip)){
            $errorArr[] = $zip_error;
        }

         //if no error prepare database update
        if(empty($errorArr)){
            
            $sql = "UPDATE `users` SET `first_name`='$fname', `last_name`='$lname', `email`='$email', `username`='$username', `address`='$address', `country`='$country', `zip`='$zip', `city`='$city' WHERE `id`='$user_id' ";
            if(mysqli_query($con, $sql)){
                $errorArr[] = $success_message_data;
            } else {
                echo "error: " . $sql . "<br>" . mysqli_error($con);
            }
        }
    }

    //Change Password
    if(isset($_POST['update_password_button'])){

        foreach ($_POST as $post_value) {
            $post_value = sanitizeInputNameOrAddress($post_value, false);
        }

        //get current password from database
        $current_password = $user_data['password'];
        //encrypt control password to be able to compare 
        $control_password = md5($_POST['oldpass']);

        $new_password = $_POST['newpass'];
        $new_password2 = $_POST['newpass2']; 
       
        //validate the new Passwords
        if ($current_password == $control_password) {

            if($new_password == $new_password2){
                
                //length minimum 6 max 35 chars
                if (strlen($new_password) > 35 || strlen($new_password) < 6) {
                    $errorArr[] = $password_error_length;
                }
                //special character 
                $pattern_password = "/^[a-zA-Z0-9!§$%&()=?@* \/\-ß]+$/i";
                if (!preg_match($pattern_password, $new_password)) {
                    $errorArr[] = $password_error_format;
                }
                
                $new_password = md5($new_password);
                //comprate the new password with old. they can't be the same

                if($new_password == $current_password){
                    echo "yes";
                    $errorArr[] = $password_error_current_new_match;   
                }
                //if no error prepare database update
                if(empty($errorArr)){
                    
                    $sql = "UPDATE `users` SET `password`='$new_password' WHERE id='$user_id'";
                    if(mysqli_query($con, $sql)){
                        $errorArr[] = $success_message_password;
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($con, $sql);
                    }
                }
            }else {
                $errorArr[] = $password_error_match;
            }
        } else {
            $errorArr[] = $password_error_current_error;
        }

        
    }
    //Add payment info


?>