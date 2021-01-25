<?php
require 'apps/todo/assets/includes/classes/Todos.php';
require 'apps/todo/assets/handlers/add-todo-handler.php';

?>

<div class="col-md-7 col-lg-8 m-auto">
    <h4 class="mb-4">Add new Todo</h4>
    <form class="needs-validation" method="POST" action="todo.php">
        <div class="row g-3">
            <div class="col-12 mb-3">
                <label for="todo_date" class="form-label">Todo Date</label>
                <input type="date" class="form-control" name="todo_date" id="todo_date" placeholder="dd/mm/yyyy" required>

            </div>
            <div class="col-12 mb-3">
                <label for="todo_body" class="form-label">Todo Name</label>
                <input type="text" class="form-control" name="todo_body" id="todo_body" placeholder="Take the dog for a walk" required>
                <div class="invalid-feedback">
                    <?php if (in_array($todo_name_invalid, $errorArr)) echo $todo_name_invalid ?>
                </div>
            </div>
        </div>
        <input type="submit" value="Add" name="add_button" class="btn btn btn-outline-light fw-bold border-white mb-4">
        <br>
        <?php if (in_array($todo_added, $errorArr)) echo $todo_added ?>
    </form>
</div>