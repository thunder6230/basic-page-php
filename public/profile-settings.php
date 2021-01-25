<?php
require 'includes/header.php';
include 'includes/handlers/update-profile.php';



?>
<div class="col-md-7 col-lg-8 centered">
    <h4 class="mb-3">Change User Data</h4>
    <form class="needs-validation" action="profile-settings.php" method="POST">
        <div class="row g-3">
            <div class="col-sm-6">
                <label for="firstName" class="form-label">First name</label>
                <input type="text" class="form-control" id="firstName" placeholder="" name="fname" value="<?php echo $user_data['first_name'] ?>" required>
                <div class="invalid-feedback">
                    <?php if (in_array($fname_error, $errorArr)) echo $fname_error ?>
                </div>
            </div>

            <div class="col-sm-6">
                <label for="lastName" class="form-label">Last name</label>
                <input type="text" class="form-control" id="lastName" placeholder="" name="lname" value="<?php echo $user_data['last_name'] ?>" required>
                <div class="invalid-feedback">
                    <?php if (in_array($lname_error, $errorArr)) echo $lname_error ?>
                </div>
            </div>

            <div class="col-12">
                <label for="username" class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text">@</span>
                    <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?php echo $user_data['username'] ?>" required>
                    <div class="invalid-feedback">
                        <?php if (in_array($username_error, $errorArr)) echo $username_error ?>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="<?php echo $user_data['email'] ?>">
                <div class="invalid-feedback">
                    <?php
                    if (in_array($email_error_taken, $errorArr)) echo $email_error_taken;
                    if (in_array($email_error_format, $errorArr)) echo $email_error_format;
                    ?>
                </div>
            </div>

            <div class="col-12">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value="<?php echo $user_data['address'] ?>" required>
                <div class="invalid-feedback">
                    <?php if (in_array($address_error, $errorArr)) echo $address_error ?>
                </div>
            </div>

            <div class="col-md-4">
                <label for="country" class="form-label">Country</label>
                <select class="form-select" id="country" name="country" required>
                    <option value="">Choose...</option>
                </select>
            </div>

            <div class="col-md-5">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="" value="<?php echo $user_data['city'] ?>" required>

                <div class="invalid-feedback">
                    <?php if (in_array($city_error, $errorArr)) echo $city_error ?>
                </div>
            </div>

            <div class="col-md-3">
                <label for="zip" class="form-label">Zip</label>
                <input type="text" class="form-control" id="zip" name="zip" placeholder="" value="<?php echo $user_data['zip'] ?>" required>
                <div class="invalid-feedback">
                    <?php if (in_array($zip_error, $errorArr)) echo $zip_error ?>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn btn-outline-light fw-bold border-white mt-4 mb-2" name="update_profile_button">Update Data</button>
    </form>
    <?php if (in_array($success_message_data, $errorArr)) echo $success_message_data ?>
</div>


<!-- Footer -->
<script>
    const activePage = "Profile"
    let capitalArr = []
    $(document).ready(() => {

        $.getJSON("https://restcountries.eu/rest/v2/region/europe", (data) => {
            data.forEach(country => {
                let countryObj = {
                    'country': country.name,
                    'capital': country.capital
                }
                capitalArr.push(countryObj)
                $("#country").append(`<option value="${country.name}">${country.name}</option>`)
            });
        });
    })
    $("#country").change((e) => {

        let choosenCity = e.target.value
        capitalArr.map(item => {
            if (item.country == choosenCity) {
                $('#city').attr("placeholder", `i.e. ${item.capital}`)
            }
        })
    })
</script>
<?php include 'includes/footer.php' ?>