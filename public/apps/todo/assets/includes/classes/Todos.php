<?php

class Todos {
    private $con = "";
    private $user = "";
    public function __construct($con, $user)
    {
        $this->con = $con;
        $this->user = $user;
    }

    public function addTodo($todo_date, $todo_body){
        $current_date = date("Y-m-d");

        //the boolean will be decided if the current date is newer than the todo date it will be auto 1.
        if ($current_date > $todo_date) {
            $is_done = "yes";
        } else {
            $is_done = "no";
        }

        //we can connect to the database. Every todo will have a username field to be bound to account. the users will have unique todo table
        $add_todo_sql = "INSERT INTO `todos`(`id`, `username`, `todo_body`, `todo_date`, `date_added`, `is_done`) VALUES (NULL, '$this->user','$todo_body', '$todo_date','$current_date','$is_done')";
        if (!mysqli_query($this->con, $add_todo_sql)) {
            echo "Error: " . $add_todo_sql . "<br>" . mysqli_error($this->con);
        } else {
            return true;
        }
    }


    public function getTodos($sort_method){

        if($sort_method == "default"){
            $sort_method = "";
        } else {
            if($sort_method == "name_asc"){
                $sort_method = "ORDER BY `todo_body` ASC";
            } else if ($sort_method == "name_desc") {
                $sort_method = "ORDER BY `todo_body` DESC";
            }else if ($sort_method == "date_asc") {
                $sort_method = "ORDER BY `todo_date` ASC";
            } else if ($sort_method == "date_desc") {
                $sort_method = "ORDER BY `todo_date` DESC";
            } 
        }
        //We call only id, todo_body, todo_date, is_done and for sorting options we can add order method as 
        $sql = "SELECT `id`,`todo_body`, `todo_date`, `is_done` from `todos` WHERE `username`='$this->user' $sort_method";
        $query = mysqli_query($this->con, $sql);
        if(!$query){
            echo "Error: " . $sql . "<br>" . mysqli_error($this->con);
        }else {
            $counter = 0;
            foreach ($query as $todo) {
                //

                // extract array => variables $id $todo_body, $todo_date, $is_done
                extract($todo);
                $counter++;

                //date for todo_date evaluation
                $current_date = date("Y-m-d");
                $tomorrow = date("Y-m-d", strtotime('tomorrow'));
                $yesterday = date("Y"). "-" . date("m") . "-" . date("d")-1;
                //After if the todo is done we add some classes to the span and icon element.

                if ($is_done == "yes") {
                    $class = "done";
                    $icon_class = "icon-done";
                } else if ($is_done == "no"){
                    $class = "";
                    $icon_class = "";
                }


                //if the todo date is yesterday, today or tomorrow it will be written

                if ($todo_date == $current_date) {
                    $todo_date = "Today";
                } else if ($todo_date == $tomorrow) {
                    $todo_date = "Tomorrow";
                } else if ($todo_date == $yesterday){
                    $todo_date = "Yesterday";
                }
                
                echo "
                    <tr class='table_row $id' >
                        <th scope='row'>$counter</th>
                        <td id='todo_date$id'>
                            $todo_date
                            <input type='date' class='change-todo todo-date hidden' id='change-todo$id' name='new_date[$id]'>
                        </td>
                        <td class='table-main'>
                            <span id='span$id' class='$class'>
                                $todo_body
                                <input type='text' id='change-todo$id' class='change-todo todo-body hidden' name='new_body[$id]'>
                            </span>
                            <div class='buttons' id='buttons$id'>
                                <i class='far fa-edit' id='edit$id' onclick='editTodo($id)'></i>
                                <i class='far fa-calendar-check $icon_class' onclick='setTodoDoneUndone($id)' id='check-btn$id'></i>
                                <i class='far fa-times-circle' onclick='openModal($id)'></i>
                            </div>
                            <div class='buttons-edit' id='buttons$id-edit'>
                                <i class='far fa-edit' id='edit$id' onclick='resetHiddenFields()'></i>
                                <label for='submit_todo_edit'>
                                    <i class='fas fa-save' id='save_btn'></i>
                                </label>
                                <input type='submit' style='display:none;' id='submit_todo_edit'>
                                <i class='far fa-times-circle' style='opacity:0; cursor: default;'></i>
                            </div>
                        </td>
                    </tr>";
            }
        }
    }

    public function deleteTodo($id){
        $sql = "DELETE FROM `todos` WHERE `id`='$id'";
        if(mysqli_query($this->con, $sql)){
            return true;
        }
    }

    public function setTodoDoneUndone($id){
        //get actual status

        $sql = "SELECT `is_done` FROM `todos` WHERE `id`='$id'";
        $status_query = mysqli_query($this->con, $sql);
        $result = mysqli_fetch_array($status_query);
        $is_done = $result['is_done'];

        //change value
        if($is_done == "yes"){
            $is_done = "no";
        }else {
            $is_done = "yes";
        }

        //Send update request
        $todo_done_sql = "UPDATE `todos` SET `is_done`='$is_done' WHERE `id`='$id'";
        if(mysqli_query($this->con, $todo_done_sql)){
            return true;
        }else {
            return "Error: " . $todo_done_sql . "<br>" . mysqli_error($this->con);
        }       
    }

    public function editTodo($todo_date, $todo_body, $id){
        //get current values
        $get_data_sql = "SELECT `todo_date`, `todo_body` FROM `todos` WHERE `id`='$id'";
        $query = mysqli_query($this->con, $get_data_sql);
        if(!$query){
            echo "Error: $get_data_sql <br>" . mysqli_error($this->con);
        }
        $num_rows = mysqli_num_rows($query);
        if($num_rows != 0){
            while($row = mysqli_fetch_array($query)){
            $current_todo_date = $row['todo_date'];
            $current_todo_body = $row['todo_body'];

            //compare current values with new ones. If empty we add the old value.
            if($todo_date == ""){
                $todo_date = $current_todo_date;
            }
            if ($todo_body == "") {
                $todo_body = $current_todo_body;
            }
            $current_date = date("Y-m-d");
            if($todo_date < $current_date){
                $is_done = "yes";
            } else {
                $is_done = "no";
            }

            $sql = "UPDATE `todos` SET `todo_body`='$todo_body', `todo_date`='$todo_date', `is_done`='$is_done' WHERE `id`='$id'";
            if(mysqli_query($this->con, $sql)){
                return true;
            } else {
                return "Error: " . $sql . "<br>" . mysqli_error($this->con);
            }
            } 
        }
        
    }
}
?>
