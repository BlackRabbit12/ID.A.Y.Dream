<?php
/*
 * Authors: Shayna Jamieson, Keller Flint, Bridget Black
 * 2019-10-02
 * Last Updated: 2019-11-12
 * Version 1.0
 * File name: volunteer_success_splash_page.php
 * Associated Files: volunteer_form.php
 *                  youth_form.php
 */

require_once "private/init.php";

?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Volunteer - iD.A.Y.Dream</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css" type="text/css">

    <!-- https://favicon.io/emoji-favicons/blue-heart/ -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32_title.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16_title.png">
    <link rel="manifest" href="images/site.webmanifest_title">
</head>

<body>
<div class="jumbotron d-flex align-items-center">
    <div class="container">
        <h1 id="volunteer-title">VOLUNTEER</h1>
    </div>
</div> <!-- ending section for the jumbotron -->

<?php

// declare variables here to use throughout this page & w/ email functionality
//user
$user["user_first"] = $_POST['first-name'];
$user["user_last"] = $_POST['last-name'];
$user["user_email"] = $_POST['email'];
$user["user_phone"] = formatPhone($_POST["phone"]);
//volunteer
$volunteer["volunteer_street_address"] = $_POST['address'];
$volunteer["volunteer_zip"] = $_POST['zip'];
$volunteer["volunteer_city"] = $_POST['city'];
$volunteer["volunteer_state"] = $_POST['state'];
$volunteer["volunteer_tshirt_size"] = $_POST['shirt'];
$volunteer["volunteer_about_us"] = $_POST['about'];
$volunteer["volunteer_motivated"] = $_POST['motivation'];
$volunteer["volunteer_experience"] = $_POST['volunteer-experience'];
$volunteer["volunteer_youth_experience"] = "";
if (isset($_POST['youth-experience']))
    $volunteer["volunteer_youth_experience"] = $_POST['youth-experience'];
$volunteer["volunteer_skills"] = $_POST['other-experience'];
$volunteer["volunteer_emailing"] = $_POST['mailing-list'];

$referencesArray = [];
$referencesArray[] = array(
    "contact_name" => $_POST['reference-name-1'],
    "contact_relationship" => $_POST["reference-relationship-1"],
    "contact_email" => $_POST["reference-email-1"],
    "contact_phone" => $_POST["reference-phone-1"],
    "contact_type" => "reference"
);
$referencesArray[] = array(
    "contact_name" => $_POST['reference-name-2'],
    "contact_relationship" => $_POST["reference-relationship-2"],
    "contact_email" => $_POST["reference-email-2"],
    "contact_phone" => $_POST["reference-phone-2"],
    "contact_type" => "reference"
);
$referencesArray[] = array(
    "contact_name" => $_POST['reference-name-3'],
    "contact_relationship" => $_POST["reference-relationship-3"],
    "contact_email" => $_POST["reference-email-3"],
    "contact_phone" => $_POST["reference-phone-3"],
    "contact_type" => "reference"
);

//ensures nothing submits into database if volunteer does not agree to terms of service
if (!isset($_POST['terms-of-service'])) {
    echo "You must accept the terms of service to proceed.";
} else {

//does validation for user variables, gets back the user id row
$success = volunteerInsert($user, $volunteer, [], $referencesArray);

//if volunteer successfully inserted, then INSERT references and complete success page for volunteer
if ($success) {
?>

<!-- HERE IS WHERE WE NEED TO THANK THEM AND THEN DISPLAY THE INFORMATION THAT THEY SUBMITTED  -->
<div class="container" id="thank-you-message">
    <h2>Thank you for your interest in volunteering with iD.A.Y.Dream <?php echo $user["user_first"] ?>. We’re investing in
        an entire region of youth. Youth seeking success through higher education, mentoring, etc.</h2>
    <br>
    <h3 id="click-to-see-volunteer">Click to see a summary of your information.</h3>
    <button class="btn btn-lg" type="button" id="summary-button">SUMMARY</button>
</div>

<div class="container" id="summary">
    <?php
    // building email content
    $email_body = "Volunteer Information:\r\n\r\n";
    $email_subject = "ID.A.Y.Dream Volunteer Sign-Up Information";

    echo createSummary($email_body)[0];
    $email_body .= createSummary($email_body)[1];

    // sending email to client
    $sendTo = "Sjamieson2@mail.greenriver.edu";
    $to = $sendTo;
    $headers = "From: " . $user["user_email"] . " \r\n";
    $headers .= "Reply-To: " . $user["user_email"] . "\r\n";
    $success = mail($to, $email_subject, $email_body, $headers);
    ?>

    <?php
    } //if volunteer did NOT successfully get inserted
    else {
        echo "it didn't work volunteer";
    }
    } ?>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<!-- jQuery for input validation -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="scripts/volunteer_splash_functions.js"></script>
</body>

</html>