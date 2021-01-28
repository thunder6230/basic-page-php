<?php
require 'includes/header.php';
?>
<h1>Admin Page</h1>
<p class="lead">This is the Admin Page. I will add admin functions such as user list and user managment etc...</p>
<a href="user-managment.php" class="btn btn-lg btn-outline-light fw-bold border-white mt-4 mb-2">User Table</a>

<!-- Footer -->
<script>
    //every page will have a fix variable with the actual menu name
    const activePage = "Admin";
</script>
<?php include 'includes/footer.php' ?>