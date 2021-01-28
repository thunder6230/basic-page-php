<?php

require_once 'config/config.php';
require_once 'includes/classes/User.php';
require_once 'includes/error-messages.php';
require_once 'includes/classes/Input.php';
require_once 'includes/classes/Textarea.php';
require_once 'includes/classes/Select.php';

if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}

$user = new User($con, $userLoggedIn);
$user_data = $user->getUserData();

if ($user->isUserBlocked()) {
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en" class="min-vh-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Practice</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/todo.css">
    <link rel="stylesheet" href="assets/css/modal-window-profile.css">
</head>



<body class="d-flex min-vh-100 text-center text-white bg-dark">
    <div class="cover-container d-flex w-100 min-vh-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">Site Name</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end" id="nav_menu">
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    <a class="nav-link" href="my-apps.php">My Apps</a>
                    <a class="nav-link" href="contact.php
                    ">Contact</a>
                    <a class="nav-link" href="profile.php"><img src="<?php echo $user_data['profile_pic']; ?>" class="avatar mini"> Profile</a>
                    <?php if ($user->isAdmin()) echo "<a class='nav-link' href='admin.php'>Admin</a>" ?>
                    <a class="nav-link" href="includes/handlers/logout.php">Logout</a>
                </nav>
            </div>
        </header>

        <main class="px-3">