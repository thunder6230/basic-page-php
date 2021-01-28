<?php
require_once 'includes/header.php';
require_once 'includes/handlers/contact-email-handler.php';
require_once 'controller/contact-form-controller.php';


?>
<h1>Contact Us</h1>
<p class="lead mb-4">This is the contact page. Fill out the form to send an email to owner.</p>
<div class="col-md-7 col-lg-8 centered">

    <form class="needs-validation" action="contact.php" method="POST">
        <div class="row g-3">
           <?php 
            foreach($config_contact as $config_input){
                $input = new Textarea($config_input);
                if($config_input['type'] == 'textarea'){
                    echo $input->renderTextarea();
                } else {
                    echo $input->render();
                }
            }
           ?>
        </div>
        <button type="submit" name="send_email_button" class="btn btn btn-outline-light fw-bold border-white mt-4 mb-2">Send Email</button>

    </form>
    <?php if (in_array($email_sent, $errorArr)) echo $email_sent ?>
</div>


<!-- Footer -->
<script>
    //every page will have a fix variable with the actual menu name
    const activePage = "Contact";
</script>
<?php include 'includes/footer.php' ?>