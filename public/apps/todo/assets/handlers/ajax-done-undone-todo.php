<?php
    require '../../../../config/config.php';
    require '../includes/classes/Todos.php';

    $userLoggedIn = $_REQUEST['userLoggedIn'];
    $todo_id = $_REQUEST['todo_id'];
    $todos = new Todos($con, $userLoggedIn);

    if($todos->setTodoDoneUndone($todo_id)){
        echo "1";
    } else {
        echo "0";
    }
?>