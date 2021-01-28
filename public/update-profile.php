<?php
require_once 'includes/header.php';
require_once 'includes/handlers/update-profile.php';
require_once 'controller/update-profile-config.php';

?>
<div class="col-md-7 col-lg-8 centered">
    <h4 class="mb-3">Change User Data</h4>
    <form class="needs-validation" action="update-profile.php" method="POST">
        <div class="row g-3">
            <?php 
            foreach($config_update_profile as $config_input){
                $input = new Select($config_input);
                if($config_input['type'] == 'select'){
                    echo $input->renderSelect();
                } else {
                    echo $input->render();
                }
            }
            ?>
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