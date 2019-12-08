<?php

/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-10-02
 * Last Update: 2019-12-05
 * File name: youth_success_splash.php
 * Associated Files:
 *      youth_form.php
 *      @link https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css
 *      css/youth_styles.css
 *      images/apple-touch-icon.png
 *      images/favicon-32x32_title.png
 *      images/favicon-16x16_title.png
 *      images/site.webmanifest_title
 *      @link https://code.jquery.com/jquery-1.12.4.js
 *      @link https://code.jquery.com/ui/1.12.1/jquery-ui.js
 *      @link https://code.jquery.com/jquery-3.3.1.slim.min.js
 *      @link https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js
 *      @link https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js
 *      @link https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js
 *      scripts/success_splash_functions.js
 *      private/functions.php
 *      private/validation_functions.php
 *      private/query_functions.php
 *
 * Description:
 *      File contains iD.A.Y.Dream Youth Organization's summary of provided dreamer information. The dreamer will
 *      have filled out a Sign Up form and submitted it to the database. This page displays the information back to the
 *      dreamer for review and or personal records. This page also serves as an indicator that the dreamer's
 *      information was successfully inserted into the database.
 */


require_once "private/init.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Youth - iD.A.Y.Dream</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/youth_styles.css" type="text/css">

    <!-- https://favicon.io/emoji-favicons/blue-heart/ -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32_title.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16_title.png">
    <link rel="manifest" href="images/site.webmanifest_title">
</head>
<body>
<!--<div class="jumbotron jumbotron-fluid">-->
<div class="jumbotron d-flex align-items-center">
    <div class="container">
        <h1 id="youth-volunteer-title">YOUTH SIGN-UP</h1>
    </div>
</div> <!-- ending section for the jumbotron -->

<?php

// create the user associative array from POST data
$user["user_first"] = $_POST["first-Name"];
$user["user_last"] = $_POST["last-Name"];
$user["user_email"] = $_POST["email"];
//formatPhone (validation_functions.php)
$user["user_phone"] = formatPhone($_POST["phone"]);

// create the dreamer associative array from POST data
$dreamer["dreamer_college"] = $_POST["college-Interest"];
//formatDOB (validation_functions.php)
$dreamer["dreamer_date_of_birth"] = formatDOB($_POST["dob"]);
$dreamer["dreamer_graduation_year"] = $_POST["graduation-Year"];
$dreamer["dreamer_gender"] = $_POST["gender"];
$dreamer["dreamer_ethnicity"] = $_POST['ethnicity'];
// if ethnicity-other is not empty, use the supplied ethnicity instead
if (!isEmpty($_POST['ethnicity-Other'])) {
    $dreamer["dreamer_ethnicity"] = $_POST['ethnicity-Other'];
}
$dreamer["dreamer_food"] = $_POST["fav-Snacks"];
$dreamer["dreamer_goals"] = $_POST["aspirations"];
$dreamer["dreamer_status"] = "pending";

// creating the array of associative arrays containing guardian data
$guardianArray = [];
//formatPhone (validation_functions.php)
$guardianArray[] = array(
    "contact_name" => $_POST["guardian-First-Name"] . " " . $_POST['guardian-Last-Name'],
    "contact_relationship" => $_POST["guardian-Relationship"],
    "contact_email" => $_POST["guardian-Email"],
    "contact_phone" => formatPhone($_POST["guardian-Phone"]),
    "contact_type" => "guardian"
);

//insertDreamer (query_functions.php)
$success = insertDreamer($user, $dreamer, $guardianArray);

//if dreamer successfully INSERTed, complete the success page for dreamer
if ($success) {
    ?>

    <div class="container" id="thank-you-message">
        <?php

        echo "<h2>Thank you for your submission {$user["user_first"]}!</h2>"
        ?>
        <h3 id="click-to-see">Click to see a summary of your information.</h3>
        <button class="btn btn-lg" type="button" id="summary-button">SUMMARY</button>
    </div>

    <div class="container" id="summary">
        <?php

        // building email content
        $email_body = "Youth Information:\r\n\r\n";
        $email_subject = "ID.A.Y.Dream Youth Sign-Up Information";

        //createSummary (functions.php)
        echo createSummary($email_body)[0];
        $email_body .= createSummary($email_body)[1];

        // sending email to client
        $sendTo = "Sjamieson2@mail.greenriver.edu";
        $to = $sendTo;
        $headers = "From: " . $user["user_email"] . " \r\n";
        $headers .= "Reply-To: " . $user["user_email"] . "\r\n";
        $success = mail($to, $email_subject, $email_body, $headers);
        ?>
    </div>
<?php } else {
    echo "An error occurred while submitting your application, please press the \"back arrow\" and resubmit 
        your application or try again later. We appreciate your interest in our organization!";
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
<script src="scripts/success_splash_functions.js"></script>
</body>
</html>