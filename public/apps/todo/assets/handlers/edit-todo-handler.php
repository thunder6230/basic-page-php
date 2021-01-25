<?php 

$todo = new Todos($con, $userLoggedIn);
if(!empty($_POST)){
    if(isset($_POST['new_date']) && isset($_POST['new_body'])){
        $new_date_arr = $_POST['new_date'];
        $new_body_arr = $_POST['new_body'];
        $is_body_changed = true;
        foreach($new_body_arr as $id => $new_body){
            if($new_body != "" ){
                $new_date = $new_date_arr[$id];
                if($new_date == ""){
                    $new_date = "";
                }
                $todo->editTodo($new_date, trim($new_body), $id);
            } else {
                $is_body_changed = false;
            }
        }
        if(!$is_body_changed){
            foreach($new_date_arr as $id => $new_date){
                if($new_date != ""){
                    $new_body = "";
                    $todo->editTodo($new_date, $new_body, $id);
                }
            }
        }
    }
}
?>