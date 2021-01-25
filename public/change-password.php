<?php
require 'includes/header.php';
include 'includes/handlers/update-profile.php';

?>

<div class="col-md-7 col-lg-8 centered">
    <h4 class="mb-3">Change Password</h4>
    <form class="needs-validation" action="change-password.php" method="POST">
        <div class="row g-3">
            <div class="col-12">
                <label for="oldpass" class="form-label">Current Password:</label>
                <input type="password" class="form-control" id="oldpass" name="oldpass" placeholder="" required>
                <div class="invalid-feedback">
                    <!-- error message -->
                    <?php
                    if (in_array($password_error_current_error, $errorArr)) echo $password_error_current_error;
                    ?>
                </div>
            </div>

            <div class="col-12">
                <label for="newpass" class="form-label">New Password:</label>
                <input type="password" class="form-control" id="newpass" name="newpass" placeholder="" required>
            </div>
            <div class="col-12">
                <label for="newpass2" class="form-label">Confirm New Password:</label>
                <input type="password" class="form-control" id="newpass2" name="newpass2" placeholder="" required>
                <div class="invalid-feedback">
                    <!-- error messages -->
                    <?php
                    if (in_array($password_error_match, $errorArr)) echo $password_error_match;
                    if (in_array($password_error_format, $errorArr)) echo $password_error_format;
                    if (in_array($password_error_length, $errorArr)) echo $password_error_length;
                    ?>
                </div>
            </div>
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