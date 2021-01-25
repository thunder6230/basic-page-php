<?php 
$todo_date = '';
$todo_body = '';
$errorArr = [];


 //after submitted the Todo datas to Post array we have to prepapre the datas
if(!empty($_POST)){
    if(isset($_POST['todo_date']) && isset($_POST['todo_body'])){
        //We read out the data via Post array key and validate if needed (todo name)
        //wenn ein Fehler auftretet wird gleich in errorArr gesendet. 
        $todo_date = $_POST['todo_date'];

        $todo_body = trim($_POST['todo_body']);
        $todo_body = ucfirst(strtolower($todo_body));

        //if no errors in errorArr we can proceed
        if (empty($errorArr)) {

            $todos = new Todos($con, $userLoggedIn);
            if($todos->addTodo($todo_date, $todo_body, $todo_added)){
               $errorArr[] = $todo_added;
            }
        }
   }   
}
?>