<?php 

$todo = new Todos($con, $userLoggedIn);
if(!empty($_POST)){
    if(isset($_POST['new_date']) && isset($_POST['new_body'])){
        $new_date_arr = $_POST['new_date'];
        $new_body_arr = $_POST['new_body'];
        foreach($new_body_arr as $id => $new_body){
            if($new_body != "" ){
                $new_date = $new_date_arr[$id];
                if($new_date == ""){
                    $new_date = "";
                }
                $todo->editTodo($new_date, trim($new_body), $id);
            }
        }
    }
}
?>