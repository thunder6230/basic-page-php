<?php
    
    $errorArr = [];
    //image validation for upload
    //In Post request do we send the name of picture
    //we generate a hash and replace a file name against abuse
    if(!empty($_FILES) && !empty($_POST)){
        $name_hash = md5(rand(0,1000));
        $target_path = "uploads/images/";

        //we check the file type
        $target_file = $target_path . basename($_FILES['uploaded_pic']['name']);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        //the ultimate file name
        $new_file_path = $target_path . $name_hash . "." . $file_type;

        $file_size = $_FILES['uploaded_pic']['size'];

        //check if the file is in image format
        $check = getimagesize($_FILES['uploaded_pic']['tmp_name']);
        if(!$check){
            $errorArr[] = $file_upload_type_error;
        } else {
            echo "The file is an image - " . $file_type . ".<br>";
        }


        if($file_size > 2097152){
            $errorArr[] = $file_upload_large_size;
        }
        if($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg" && $file_type != "gif"){
            $errorArr[] = $file_upload_extension_error;
        }

        if(empty($errorArr)){
           if( move_uploaded_file($_FILES['uploaded_pic']['tmp_name'], $new_file_path)){
            $file_name = trim($_POST['picture_label']);
            $current_date = date("Y-m-d");
            $sql = "INSERT INTO `uploaded_pictures` VALUES (NULL, '$file_name', '$userLoggedIn', '$new_file_path', '$current_date')";
            if(mysqli_query($con, $sql)){
                $errorArr[] = $file_upload_successfull;
            } else {
                echo "Error: $sql <br>". mysqli_error($con);
            }
               
           }else {
            $errorArr[] = $file_upload_unsuccessfull;
           }
        } else {
            echo "something went wrong!";
        }
    }
?>