<?php
include 'includes/error-messages.php';
//on this page we have to call all registered users from the table but only some datas. All rows will be able to open the detailed user infos.
$users_row_array = [];
$user_row = '';
$account_types = ["generic", "operator", "admin"];
$sql = "SELECT `first_name`, `last_name`, `email`, `date_added`, `username`, `role`, `is_active`, `is_blocked` from `users`";
$query = mysqli_query($con, $sql);
$user_account_type_arr = [];
$user_account_blocked_arr = [];
$disabled = "";
$reduced_function = false;
if($account_type == "operator"){
    //if the user is an operator we have to do 2 steps.
    //reduce the available account types array to be listed without admin
    //activate the reduced funktion
    $account_types = ["generic", "operator"];
    $reduced_function = true;
}

if ($query) {
    //we place a counter here to know the user count
    $counter = 0;
    while ($row = mysqli_fetch_all($query)) {
        //start listing and incrementing the counter
        foreach ($row as $user) {
            $counter++;
            //i will add javascript to colorize the table entries according to their account type i. e. admin red or so


            //here starts the table row. it's important to begin outside of the iteration!
            $user_row .= "<tr><th scope='row'>$counter</th>";
            foreach ($user as $key => $user_data) {
                //we have to add another iteration since the user_data is still an array. If the iteration reach 5 (account type) we create a select tag. We add a selected attribute to the matching user_data.
                if ($key == 4) {
                    //we place here hidden input fields to send the usernames into POST array. It's vital for the user data table identifikation.
                    $user_row .= "<td><input type='hidden' name='username_arr[]' value='$user_data'>$user_data</td>";
                } else if ($key == 5) {
                    //If the user has only "operator rights" we have to disable the input fields on users with "admin" rights. For this we have to be sure that the value is admin and the user is operator with the reduced funktion. Since the admin value was removed the array we have to make the input manually.
                    if ($user_data == "admin" && $reduced_function){
                        //we modify the disably variable for here and for late since we have 2 values in the row.
                        $disabled = "disabled";
                        $user_row .= "<td id='account_type' ><select name='role_arr[]' class='form-select form-select-sm' $disabled>";
                        if ($user_data == "admin") {
                            $user_row .= "<option value='admin' selected>admin</option>";
                        }
                    } else {
                        $disabled = "";
                        $user_row .= "<td id='account_type'><select name='role_arr[]' class='form-select form-select-sm' $disabled>";
                    }
                    
                        foreach ($account_types as $role) {
                            if ($role == $user_data) {
                                $user_row .= "<option value='$role' selected>$role</option>";
                            } else {
                                $user_row .= "<option value='$role'>$role</option>";
                            }
                        }
                    $user_row .= "</select></td>";
                } else if ($key == 7) {

                    //same logic select menu with 2 options "yes" or "no"
                    //we use the disabled value we modified above.that makes disabled the select menu only if the row belongs to an admin.
                    
                    $temp_arr = [ "yes", "no"];
                    $user_row .= "<td><select name='is_blocked_arr[]' class='form-select form-select-sm' $disabled>";
                    foreach ($temp_arr as $temp) {
                        if ($temp == $user_data) {
                            $user_row .= "<option value='$temp' selected>$temp</option>";
                        } else {
                            $user_row .= "<option value='$temp'>$temp</option>";
                        }
                    }
                    $user_row .= "</select></td>";
                } else {
                    //the rest table blocks
                    $user_row .= "<td>$user_data</td>";
                }
            }
            //end of table row
            $user_row .= "</tr>";
        }
        //we add the rows in an array to list it on the page
        $users_row_array[] = $user_row;
    }

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}



//we create a save changes function later to update the table with different previlages

//After the post request has been sent we will read out the datas in 3 different order and through iteration will we make the table updates.
if (!empty($_POST)) {
    //array names : $username_arr , $role_arr, $is_blocked_arr
    extract($_POST);

    //We have to iterate through the account type array because it won't read the disabled values. It means the exact row won't be modified. It's important if the user is only operator! The admin has full right there won't make any changes. 
    foreach($role_arr as $index => $role){
        $username = $username_arr[$index];
        $is_blocked = $is_blocked_arr[$index];
        $sql = "UPDATE `users` SET `role`= '$role', `is_blocked`='$is_blocked' WHERE `username`='$username'";
        if(mysqli_query($con, $sql)){
            $_SESSION['message'] = $success_message_admin_table;
            header("Refresh:0");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }

    }   
   
}
?>