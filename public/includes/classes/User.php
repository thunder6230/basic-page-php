<?php 

    class User {
        private $con;
        private $user;

        public function __construct($con, $user) {

            $this->con = $con;
            $user_details_query = mysqli_query($this->con, "SELECT * FROM `users` WHERE username='$user'");
            $this->user = mysqli_fetch_array($user_details_query);
            
        }

        public function getFullName(){
            $fname = $this->user['first_name'];
            $lname = $this->user['last_name'];
            return $fname . " ". $lname;
        }

        public function isAdmin(){
            $user_type = $this->user['role'];
            if($user_type == "generic"){
                return false;
            }else{
                return true;
            }
        }
        

        public function getUserData(){
            return $user_data = $this->user;
        }

        public function isUserActive(){
            $isActive = $this->user['is_active'];
            if($isActive == "yes"){
                return true;
            } else {
                return false;
            }
        }
        public function isUserBlocked()
        {
            $isBlocked = $this->user['is_blocked'];
            if ($isBlocked == "yes") {
                return true;
            } else {
                return false;
            }
        }

        public function updateProfilePic($image_path, $username){

            $sql = "UPDATE `users` SET `profile_pic`= '$image_path' WHERE `username`='$username'";
            if(mysqli_query($this->con, $sql)){
                return true;
            } else {
               echo "Error: $sql <br>" . mysqli_error($this->con);
            }
            
        }
    }
?>