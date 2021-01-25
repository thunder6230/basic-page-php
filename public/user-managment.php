<?php
require 'includes/header.php';
require 'includes/handlers/admin-handler.php';
$message = '';
$counter = 1;
//we create a session message if the update finished.
//to hide the message next time you come in the admin panel i made a counter to unset the session variable. 
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $counter--;
}

if ($counter == 0) {
    unset($_SESSION['message']);
}

?>
<h1 class="mb-4">Users Table</h1>

<form action="user-managment.php" method="POST">
    <table class="table table-striped table-dark user-table table-responsive admin-table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Date Added</th>
                <th scope="col">Username</th>
                <th scope="col">Account Type</th>
                <th scope="col">Active</th>
                <th scope="col">Blocked</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users_row_array as $row) echo $row ?>
        </tbody>
    </table>
    <input type="submit" class="btn btn-lg btn-outline-light fw-bold border-white mt-2 mb-4" value="Update Table">
</form>

<?php if ($message != "") echo $message ?>
<!-- Footer -->
<script>
    //every page will have a fix variable with the actual menu name
    const activePage = "Admin";
    const rows = Array.from(document.querySelectorAll("tbody tr"))
    const account_type_cells = Array.from(document.querySelectorAll("#account_type"))
    const colorizeUserRows = () => {
        account_type_cells.map((cell, index) => {
            let account_type = cell.childNodes[0].value
            if (account_type == "admin") {
                rows[index].classList.add("table-info")
            } else if (account_type == "operator") {
                rows[index].classList.add("table-light")
            }
        })

    }
    colorizeUserRows()
</script>
<?php include 'includes/footer.php' ?>