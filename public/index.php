<?php
require 'includes/header.php';
?>
<h1>Welcome <?php echo $user->getFullName() ?></h1>
<p class="lead">This is the main page. I will add always basic functions in the future</p>
<p class="lead">
    <a href="#" class="btn btn-lg btn-outline-light fw-bold border-white mt-4 mb-2">Learn more</a>
</p>

<!-- Footer -->
<script>
    //every page will have a fix variable with the actual menu name
    const activePage = "Home";
</script>
<?php include 'includes/footer.php' ?>