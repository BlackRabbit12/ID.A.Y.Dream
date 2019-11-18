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

ini_set('display_errors', 1);
error_reporting(E_ALL);

// declare variables here to use throughout this page & w/ email functionality
//user
$firstName = $_POST['first-name'];
$lastName = $_POST['last-name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
//volunteer
$address = $_POST['address'];
$zip = $_POST['zip'];
$city = $_POST['city'];
$state = $_POST['state'];
$tShirt = $_POST['shirt'];
$aboutUs = $_POST['about'];
$motivation = $_POST['motivation'];
$volunteerExperience = $_POST['volunteer-experience'];
$volunteerExperienceYouth = "";
if (isset($_POST['youth-experience']))
    $volunteerExperienceYouth = $_POST['youth-experience'];
$skills = $_POST['other-experience'];
$mailingList = $_POST['mailing-list'];
$termsOfService = $_POST['terms-of-service'];
//reference 1
$refPhone1 = $_POST['reference-phone-1'];
$refEmail1 = $_POST['reference-email-1'];
$refRel1 = $_POST['reference-relationship-1'];
$refName1 = $_POST['reference-name-1'];
//reference 2
$refPhone2 = $_POST['reference-phone-2'];
$refEmail2 = $_POST['reference-email-2'];
$refRel2 = $_POST['reference-relationship-2'];
$refName2 = $_POST['reference-name-2'];
//reference 3
$refPhone3 = $_POST['reference-phone-3'];
$refEmail3 = $_POST['reference-email-3'];
$refRel3 = $_POST['reference-relationship-3'];
$refName3 = $_POST['reference-name-3'];
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

//does validation for user variables, gets back the user id row
$userId = userInsert($firstName, $lastName, $email, $phone);

//does validation for volunteer variables, gets back volunteer id row
$volunteer_id = volunteerInsert($userId, $address, $zip, $city, $state, $tShirt, $aboutUs, $motivation,
    $volunteerExperience, $volunteerExperienceYouth, $skills, $mailingList, $termsOfService);

//does validation on each reference, gets back each reference's id row and saves into an array
$volunteer_reference_id_array[] = referenceInsert($refPhone1, $refEmail1, $refRel1, $refName1);
$volunteer_reference_id_array[] = referenceInsert($refPhone2, $refEmail2, $refRel2, $refName2);
$volunteer_reference_id_array[] = referenceInsert($refPhone3, $refEmail3, $refRel3, $refName3);
//loop through each reference id and ensure they are filled properly
$volunteer_reference_success = true;
foreach ($volunteer_reference_id_array as $value) {
    //if a reference failed to validate properly, then set the success variable to false
    if ($value == null || $value == 0) {
        $volunteer_reference_success = false;
    }
}

//capture the 'values' from the Interests events[] checkboxes from 'volunteer_form.php' and loop through them to validate and INSERT
if (isset($_POST['events'])) {
    $volunteer_interests_id_array = $_POST['events'];
    for ($i = 0; $i < count($volunteer_interests_id_array); $i++) {
        interestInsertVolunteer($volunteer_id, $volunteer_interests_id_array[$i]);
    }
}

//if volunteer successfully INSERTed, then INSERT references and complete success page for volunteer
if ($volunteer_id != null && $volunteer_id != 0 && $volunteer_reference_success) {
    foreach ($volunteer_reference_id_array as $value) {
        referenceInsertVolunteer($volunteer_id, $value);
    }
    ?>

    <!-- HERE IS WHERE WE NEED TO THANK THEM AND THEN DISPLAY THE INFORMATION THAT THEY SUBMITTED  -->
    <div class="container" id="thank-you-message">
        <h2>Thank you for your interest in volunteering with iD.A.Y.Dream <?php echo $firstName ?>. We’re investing in
            an entire region of youth. Youth seeking success through higher education, mentoring, etc.</h2>
        <br>
        <h3 id="click-to-see-volunteer">Click to see a summary of your information.</h3>
        <button class="btn btn-lg" type="button" id="summary-button">SUMMARY</button>
    </div>

    <div class="container" id="summary">
        <?php
        // building email content
        $email_body = "Youth Information:\r\n\r\n";
        $email_subject = "ID.A.Y.Dream Youth Sign-Up Information";

        // iterates over items posted, displays each as html on page and builds email string
        foreach ($_POST as $key => $value) {
            // When the value is an array where each item in the array must be displayed
            if (is_array($value)) {
                $key_text = htmlspecialchars($key);
                $key_text = str_replace("-", " ", $key_text);
                $key_text = ucfirst($key_text);
                echo "<p><strong>$key_text:</strong></p>";
                echo "<ul>";
                foreach ($value as $child_key => $child_value) {
                    $value_text = htmlspecialchars($child_value);
                    $email_body .= "$child_value \r\n";
                    echo "<li>$child_value</li>";
                }
                echo "</ul>";
                // As long as the value isn't empty, display results and add to email
            } else if ($value != "") {
                $key_text = htmlspecialchars($key);
                $key_text = ucfirst($key_text);
                $value_text = htmlspecialchars($value);
                $key_text = str_replace("-", " ", $key_text);
                $email_body .= "$key_text: $value_text \r\n";
                echo "<p><strong>$key_text:</strong> $value_text</p>";
            }
        }

        // sending email to client
        $sendTo = "Sjamieson2@mail.greenriver.edu";
        $to = $sendTo;
        $headers = "From: " . $email . " \r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $success = mail($to, $email_subject, $email_body, $headers);
        ?>
    </div>
    <?php
} //if volunteer did NOT successfully get INSERTed
else {
    echo "it didn't work volunteer";
} ?>
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