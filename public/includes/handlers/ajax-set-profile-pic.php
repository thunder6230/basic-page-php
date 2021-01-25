<?php 
    require '../../config/config.php';
    require '../classes/User.php';

    $username = "";
    $pic_path = "";

    if(!empty($_REQUEST)){
    $username = $_REQUEST['userLoggedIn'];
    $pic_path = $_REQUEST['picture_path'];
    }
    $user = new User($con, $username);
    if($user->updateProfilePic($pic_path, $username)){
        echo "1";
    } else {
        echo "Something went wrong!";
    }
?>