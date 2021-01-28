<?php
require 'includes/header.php';
include 'includes/handlers/update-profile.php';
include 'controller/update-password-controller.php';

?>

<div class="col-md-7 col-lg-8 centered">
    <h4 class="mb-3">Update Password</h4>
    <form class="needs-validation" action="change-password.php" method="POST">
        <div class="row g-3 mt-4">
            <?php 
            foreach($config_update_password as $config_input){
                $input = new Input ($config_input);
                echo $input->render();
            }
            ?>
        </div>

        <button type="submit" class="btn btn btn-outline-light fw-bold border-white mt-4 mb-2" name="update_password_button">Update Password</button>

    </form>
    <?php if (in_array($success_message_password, $errorArr)) echo $success_message_password ?>
    <div class="invalid-feedback">

    </div>

</div>

<script>
    const activePage = "Profile"
</script>
<?php include 'includes/footer.php' ?>