<?php 
require '../../../../config/config.php';
require '../includes/classes/Todos.php';


$userLoggedIn = $_REQUEST['userLoggedIn'];
$id = $_REQUEST['todo_id'];
$todos = new Todos($con, $_REQUEST['userLoggedIn']);

if($todos->deleteTodo($id)){
    echo 1;
} else {
    echo 0;
}
?>
