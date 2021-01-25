<?php
require 'assets/includes/header.php';
// We have to collect datas if the account has been activated
//if not a button will appear to resend the verification email
//we will need the stored hash tag to do that.



//the function from registration process
function sendConfirmationEmail($confirm_email, $fname, $lname, $hash)
{

    $link = "http://localhost/customers/confirm-email.php?email=$confirm_email&hash=$hash";
    $subject = "confirm you account";
    $msg = "Thank you $fname $lname for your registration on the 'SITE'! \n\n Please click on the link below to confirm your account \n
        $link \n Best regards, \n\n The Team";
    $headers = 'FROM:noreply@thissite.com' . "\r\n";
    $sent_mail = mail($confirm_email, $subject, $msg, $headers);
    if (!$sent_mail) {
        echo "Error sending email!";
    } else {
        header("Location: profile.php");
    }

}
$confirm_email = $user_data['email'];
$fname = $user_data['first_name'];
$lname = $user_data['last_name'];
$hash = $user_data['activation_code'];


sendConfirmationEmail($confirm_email, $fname, $lname, $hash);
?>
