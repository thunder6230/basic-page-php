<?php
    //we get the pictures from the folder and add to a folder
    $def_prof_pic_path = 'assets/images/profile_pics/defaults';
    $def_prof_pics = scandir($def_prof_pic_path);
    $picture_url_array = [];
    foreach ($def_prof_pics as $url){
        if(strlen($url) > 5){
        $picture_url_array[]  = "<img src='assets/images/profile_pics/defaults/$url' alt='picture' onclick='selectPicture(this)' class='profile_pic_mini'>";
        }
    }
    
    //get uploaded pictures
    $sql = "SELECT `picture_path` FROM `uploaded_pictures` WHERE `username`='$userLoggedIn' ORDER BY `upload_date` DESC";
    $query = mysqli_query($con, $sql);
    $num_rows = mysqli_num_rows($query);
    if($num_rows != 0){
        while($row = mysqli_fetch_array($query)){
            $pic_path =  $row['picture_path'];
            
            $picture_url_array[] = "<img src='$pic_path' alt='picture' onclick='selectPicture(this)' class='profile_pic_mini'>";
        }
    }
?>