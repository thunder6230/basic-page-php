<?php
require 'includes/error-messages.php';

$full_name = '';
$email_address = '';
$email_subject = '';
$email_body = '';
$to = 'andrasmargittai@gmail.com';


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

    $full_name = $_POST['reply_name'];
    $email_address = $_POST['reply_email'];
    $email_subject = $_POST['email_subject'];
    $email_body = $_POST['email_body'];

    $headers = "From: $email_address";
    $email_body = str_replace("\n.", "\n..", $email_body);
    $email_body = wordwrap($email_body, 70);

    $msg = "Name: $full_name\nEmail: $email_address\n\n$email_body";
    $send_mail = mail($to, $email_subject, $msg, $headers);

    if(!$send_mail){
        //error message

    } else {
        //succes message
    }
}
?>