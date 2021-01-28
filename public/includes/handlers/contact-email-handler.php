<?php
require 'includes/error-messages.php';

$full_name = '';
$email_address = '';
$email_subject = '';
$email_body = '';
$to = 'andrasmargittai@gmail.com';
$errorArr = [];
$isSent = false;

function sanitizeInputNameOrAddress($input_value, $isName)
{
    $input = trim($input_value);
    $input = strip_tags($input);
    if ($isName) {
        $input = ucfirst(strtolower($input));
    }
    return $input;
}
if(!empty($_POST)){

    foreach ($_POST as $key => &$post_value) {
        $post_value = sanitizeInputNameOrAddress($post_value, false);
    }

    $full_name = trim($_POST['reply_name']);
    $email_address = trim($_POST['reply_email']);
    $email_subject = trim($_POST['email_subject']);
    $email_body = trim($_POST['email_body']);

    $name_regex = "/^[a-zA-Z ]*$/";
    if(!preg_match($name_regex, $full_name)){
        $errorArr[] = $name_error;
    }
    if (filter_var($email_address, FILTER_SANITIZE_EMAIL)) {
        $email_address = filter_var($email_address, FILTER_SANITIZE_EMAIL);
    } else {
        $errorArr[] = $email_error_format;
    }
    $headers = "From: $email_address";
    $email_body = str_replace("\n.", "\n..", $email_body);
    $email_body = wordwrap($email_body, 70);

    $msg = "Name: $full_name\nEmail: $email_address\n\n$email_body";
    $send_mail = mail($email_address, $email_subject, $msg, $headers);

    if(empty($errorArr)){
        if($send_mail){
            $errorArr[] = $email_sent;
        } else {
            echo "Error";
        }
    }
    
}
?>