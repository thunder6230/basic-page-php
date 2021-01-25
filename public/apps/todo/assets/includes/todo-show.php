<?php
require 'apps/todo/assets/handlers/edit-todo-handler.php';
?>
<div class="container">

    <h4 class="mb-4">Todos</h4>
    <form action="todo.php" method="POST">
        <table class="table table-dark table-striped text-center todo-table">
            <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 20%; min-width:10%">Todo Date <i class="fas fa-arrow-down" onclick="sortTodoBy('date_desc')"></i><i class="fas fa-arrow-up" onclick="sortTodoBy('date_asc')"></th>
                    <th style=" width: 75%;">Todo Name <i class="fas fa-arrow-down" onclick="sortTodoBy('name_desc')"></i><i class="fas fa-arrow-up" onclick="sortTodoBy('name_asc')"></a></th>
                </tr>
            </thead>
            <tbody class="todo_table_body">

            </tbody>
        </table>
    </form>
    <?php if (in_array($todo_removed, $errorArr)) echo $todo_removed ?>
</div>
<div class="modal" onclick="closeModal()" id="modal_close">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h3>Are you sure to delete todo?</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-m btn-outline-light fw-bold border-white" onclick="closeModal()" id="modal_close">No</button>
                <button type="button" class="btn btn-m btn-outline-light fw-bold border-white" id='modal-yes-btn'>Yes</button>
            </div>
        </div>
    </div>
</div>
<script>
    let activePage = "My Apps"
    let userLoggedIn = "<?php echo $userLoggedIn ?>"
    let isEditOn = false
    $(document).ready(() => {

        $.ajax({
            type: "GET",
            url: "apps/todo/assets/handlers/ajax-get-todos.php",
            data: `sort_method=default&userLoggedIn=${userLoggedIn}`,
            dataType: "html",
            cache: false,
            success: (data) => {
                $('.todo_table_body').hide()
                $('.todo_table_body').html(data)
                $('.todo_table_body').append(`</div>
                `)
                $('.todo_table_body').fadeIn()
            }
        });
    })
    const openModal = (id) => {
        $('.modal').fadeIn()
        $('#modal-yes-btn').attr("onclick", `deleteTodo(${id})`)
    }
    const closeModal = () => {
        if (event.target.classList == "modal" ||
            event.target.getAttribute("id") == "modal_close") {
            $('.modal').fadeOut()
        }

    }
    const deleteTodo = (id) => {

        $('.modal').fadeOut()
        $.ajax({
            type: 'POST',
            url: 'apps/todo/assets/handlers/ajax-delete-todo.php',
            data: `todo_id=${id}d&userLoggedIn=${userLoggedIn}`,
            success: (response) => {
                if (response === '1') {
                    console.log('deleted from database... start delete From DOM')
                    $(`.table_row.${id}`).fadeOut()
                }
            }
        });

    }

    const setTodoDoneUndone = (id) => {

        $.ajax({
            type: 'POST',
            url: 'apps/todo/assets/handlers/ajax-done-undone-todo.php',
            data: `todo_id=${id}&userLoggedIn=${userLoggedIn}`,
            success: (response) => {
                if (response === '1') {
                    $(`#check-btn${id}`).toggleClass("icon-done")
                    $(`#span${id}`).toggleClass("done")
                }
            }
        });
    }
    const sortTodoBy = (method) => {

        $.ajax({
            type: "GET",
            url: "apps/todo/assets/handlers/ajax-get-todos.php",
            data: `sort_method=${method}&userLoggedIn=${userLoggedIn}`,
            dataType: "html",
            cache: false,
            success: (data) => {
                $('.todo_table_body').hide()
                $('.todo_table_body').html(data)
                $('.todo_table_body').fadeIn()
            }
        });
    }

    const saveTodo = (id) => {

    }
    const editTodo = (id) => {
        //reset hidden fields
        resetHiddenFields()
        //onclick appear hidden fields
        isEditOn = true
        const row_inputs = Array.from(document.querySelectorAll(`#change-todo${id}`))


        if (isEditOn) {
            $(`#buttons${id}`).hide()
            $(`#buttons${id}-edit`).css("display", "flex").fadeIn()
            row_inputs.map(input_field => {
                input_field.classList.remove("hidden")
            })
        } else {
            $(`#buttons${id}-edit`).hide()
            $(`#buttons${id}`).css("display", "flex").fadeIn()
            row_inputs.map(input_field => {
                input_field.classList.add("hidden")
            })

        }
    }

    const resetHiddenFields = () => {
        isEditOn = false
        const all_inputs = Array.from(document.querySelectorAll(`.change-todo`))
        const all_button_divs = Array.from(document.querySelectorAll('.buttons'))
        const all_button_edit_divs = Array.from(document.querySelectorAll('.buttons-edit'))
        all_inputs.map(input_field => {
            if (!input_field.classList.contains("hidden")) {
                input_field.classList.add("hidden")
            }
        })
        all_button_divs.map(button_div => {
            button_div.style.display = "flex"
        })
        all_button_edit_divs.map(button_div => {
            button_div.style.display = "none"
        })


        //reset all buttons
    }
    $(window).click(() => {
        if (isEditOn) {
            console.log(event.target.tagName)
            if (event.target.tagName != "I" && event.target.tagName != "INPUT") {
                resetHiddenFields()
            }
        }
    })
</script>