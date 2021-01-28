<?php
require 'includes/header.php';
require 'includes/handlers/get-pics.php';
$is_active = $user->isUserActive($userLoggedIn);

?>
<img src="<?php echo $user_data['profile_pic'] ?>" class="avatar mb-4" onclick="openModal()">
<h1>Profile Page</h1>
<p class="lead">This is the profile page. I made some user info managment to change you datas.</p>

<?php if (!$is_active) echo "<p class='lead font-weight-bold'><strong>Your account is still not verified!</strong></p>"; ?>
<div class="lead">
    <a href="update-profile.php" class="btn btn-lg btn-outline-light fw-bold border-white mt-4 mb-2">Update Profile</a>
    <a href="update-password.php" class="btn btn-lg btn-outline-light fw-bold border-white mt-4 mb-2">Change Password</a>
    <br>
    <a href="upload-profile-picture.php" class="btn btn-lg btn-outline-light fw-bold border-white mt-2 mb-2">Upload Picture</a>
    <?php if (!$is_active) echo "<a href='send-verification-email.php' class='btn btn-lg btn-outline-light fw-bold border-white mt-2 mb-2'>Resend verification</a>"; ?>
</div>
<div class="modal" onclick="closeModal()">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text">My Profile Picture</h5>
                <i class="fas fa-times text-white close-btn" id="modal_close" onclick="closeModal()">
                </i>
            </div>
            <div class="modal-body">
                <img src="<?php echo $profile_pic ?>" class="profile_pic">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn btn-outline-light fw-bold border-white" id="modal_close" onclick="closeModal()">Close</button>
                <button type="button" class="btn btn btn-outline-light fw-bold border-white" onclick="showPictureList()">Change Picture</button>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<script>
    const activePage = "Profile";
    const picture_arr = <?php echo json_encode($picture_url_array) ?>;
    const userLoggedIn = "<?php echo $userLoggedIn ?>";
    let new_picture_path = "";

    const openModal = () => {
        renderProfilePicture()
        $('.modal').fadeIn();
    }
    const closeModal = () => {
        if (event.target.classList == "modal" ||
            event.target.getAttribute("id") == "modal_close"
        ) {
            $('.modal').fadeOut()
        }
    }
    const renderProfilePicture = (new_pic_path) => {
        if (new_pic_path) {
            pic_path = new_pic_path
        } else {
            pic_path = "<?php echo $profile_pic ?>"
        }
        $(".modal-content").html(`<div class="modal-header">
                <h5 class="modal-title text">My Profile Picture</h5>
                <i class="fas fa-times text-white close-btn" id="modal_close" onclick="closeModal()">
                </i>
            </div>
            <div class="modal-body">
                <img src="${pic_path}" class="profile_pic">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn btn-outline-light fw-bold border-white" id="modal_close" onclick="closeModal()">Close</button>
                <button type="button" class="btn btn btn-outline-light fw-bold border-white" onclick="showPictureList()">Change Picture</button>
            </div>`)
    }
    const showProfilePicture = () => {
        $(".modal-content").hide()
        renderProfilePicture()
        $(".modal-content").fadeIn()
    }
    const showPictureList = () => {
        //get Default Pictures
        let counter = 0;
        //get uploaded pictures if there is
        //list the pictures in modal window
        $(".modal-content").hide()
        $('.modal-header').html(`<h5 class="modal-title text">My Profile Picture</h5>
                <i class="fas fa-times text-white close-btn" id="modal_close" onclick="closeModal()">
                </i>`)
        $(".modal-body").html("")
        console.log()
        picture_arr.map(picture => {

            counter++
            $(".modal-body").append(`${picture}`)
            if (counter == picture_arr.length) {
                $(".modal-body").append(`<a href='upload-profile-picture.php' class='profile_pic_mini add_new_picture'><i class="fas fa-plus"></i></a></div>`)
            }
        })
        $(".modal-footer").html(`
                <button type="button" class="btn btn btn-outline-light fw-bold border-white" onclick="showProfilePicture()">Back</button>
                <button type="button" class="btn btn btn-outline-light fw-bold border-white" onclick="previewImage()">Preview Image</button>`)

        $(".modal-content").fadeIn()
    }

    const selectPicture = (pic) => {
        const images = Array.from(document.querySelectorAll(".modal-body img"))
        images.map(image => {
            image.classList.remove("selected")
        })
        pic.classList.toggle("selected")
        new_picture_path = pic.getAttribute("src")
    }
    const previewImage = () => {
        $(".modal-content").hide()
        renderProfilePicture(new_picture_path)
        $(".modal-footer").html(`
                <button type="button" class="btn btn btn-outline-light fw-bold border-white" onclick="showPictureList()">Back</button>
                <button type="button" class="btn btn btn-outline-light fw-bold border-white" onclick="setProfilePicture()">Save</button>`)
        $(".modal-content").fadeIn()
    }
    const setProfilePicture = () => {
        $.ajax({
            type: "POST",
            url: "includes/handlers/ajax-set-profile-pic.php",
            data: `userLoggedIn=${userLoggedIn}&picture_path=${new_picture_path}`,
            success: (response) => {
                if (response == "1") {
                    location.reload();
                }
            }
        });
    }
</script>
<?php include 'includes/footer.php' ?>