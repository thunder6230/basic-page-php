<?php
require 'includes/header.php';
require 'includes/handlers/contact-email-handler.php';
?>
<h1>Contact Us</h1>
<p class="lead mb-4">This is the contact page. Fill out the form to send an email to owner.</p>
<div class="col-md-7 col-lg-8 centered">
    <form class="needs-validation" action="contact.php" method="POST">
        <div class="row g-3">
            <div class="col-12">
                <label for="reply_name" class="form-label">Full name</label>
                <input type="text" class="form-control" id="reply_name" name="reply_name" value="<?php echo $user->getFullName() ?>" required>
            </div>
            <div class="invalid-feedback">
                <!-- Error message -->
            </div>
            <div class="col-12">
                <label for="reply_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="reply_email" name="reply_email" placeholder="you@example.com" value="<?php echo $user_email ?>" required>
                <div class="invalid-feedback">
                    <!-- error message -->
                </div>
            </div>
            <div class="col-12">
                <label for="email_subject" class="form-label">Subject</label>
                <input type="text" class="form-control" id="email_subject" name="email_subject" required>
            </div>
            <div class="col-12">
                <label for="email_body" class="form-label">Text</label>
                <textarea class="form-control" id="email_body" name="email_body" rows="3"></textarea>
            </div>
        </div>
        <button type="submit" name="send_email_button" class="btn btn btn-outline-light fw-bold border-white mt-4 mb-2">Send Email</button>
        
    </form>
</div>

<!-- Footer -->
<script>
    //every page will have a fix variable with the actual menu name
    const activePage = "Contact";
</script>
<?php include 'includes/footer.php' ?>