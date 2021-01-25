<?php

require 'config/config.php';

//here we have to read out the get array and make a query to check the datas
$confirm_email = '';
$confirm_hash = '';
$confirm_message = '';
if(!empty($_GET)){
    $confirm_email = $_GET['email'];
    $confirm_hash = $_GET['hash'];
    //create the query to read out the hash with the confirmation email address
    $hash_sql = "SELECT * FROM `users` WHERE `email`='$confirm_email'";
    $hash_query = mysqli_query($con, $hash_sql);
    if($hash_query){
        $data = mysqli_fetch_array($hash_query);
        $user_hash = $data['activation_code'];
        //we have to compare the hash codes
        if($user_hash == $confirm_hash){
            //if everything going well we can update the table to active
            $is_active = "yes";
            $update_sql = "UPDATE `users` SET `is_active`='$is_active' WHERE `email`='$confirm_email'";
            if(mysqli_query($con, $update_sql)){
                session_unset();
                $_SESSION['message'] = "Thank you! Your account has been activated!";
                $_SESSION['email'] = $confirm_email;
                header("Location: login.php");
            } else {
                echo "Error: " . $update_sql . "<br>" . mysqli_error($con);
            }
        }

    } else {
        echo "Error: ". $hash_sql . "<br>" . mysqli_error($con);
    }
} else {
    header("Location: index.php");
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
                    <h4 class="mb-3">Login to continue</h4>
                    
                </div>
<?php include 'includes/footer.php' ?>