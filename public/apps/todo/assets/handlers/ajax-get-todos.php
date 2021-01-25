<?php 
require '../../../../config/config.php';
require '../includes/classes/Todos.php';


$userLoggedIn = $_REQUEST['userLoggedIn'];
$sort_method = $_REQUEST['sort_method'];
$todos = new Todos($con, $userLoggedIn);

$todos->getTodos($sort_method);
?>