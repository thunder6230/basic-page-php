<?php
require 'includes/header.php';
include 'includes/handlers/picture-upload-handler.php';

?>

<div class="col-md-7 col-lg-8 centered">
    <h1 class="mb-4">Upload New Picture</h1>
    <p class="lead mb-4">Upload only valid Image file less than 2 Mbyte!</p>
    <form action='upload-profile-picture.php' method='POST' enctype='multipart/form-data'>
        <div class="row g-3">
            <div class="col-12">
                <input type='file' name='uploaded_pic' class="form-control">
            </div>
            <div class="col-12">
                <label for="picture_label" class="form-label">Picture Label</label>
                <input type='text' name='picture_label' id="picture_label" class="form-control">
            </div>
            <div class="invalid-feedback">
                <?php

                if (in_array($file_upload_type_error, $errorArr)) echo $file_upload_type_error;
                if (in_array($file_upload_extension_error, $errorArr)) echo $file_upload_extension_error;
                if (in_array($file_upload_unsuccessfull, $errorArr)) echo $file_upload_unsuccessfull;
                if (in_array($file_upload_large_size, $errorArr)) echo $file_upload_large_size;

                ?>
            </div>
        </div>
        <input type='submit' value='Upload Image' name='submit' class="btn btn btn-outline-light fw-bold border-white mt-2 mb-2">

    </form>
    <?php if (in_array($file_upload_successfull, $errorArr)) echo $file_upload_successfull; ?>
    <?php
    // if (in_array($success_message_password, $errorArr)) echo $success_message_password
    ?>


</div>

<script>
    const activePage = " Profile"
</script>
<?php include 'includes/footer.php' ?>