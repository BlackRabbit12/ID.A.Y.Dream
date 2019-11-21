<?php
/*
 * Authors: Shayna Jamieson, Keller Flint, Bridget Black
 * 2019-10-02
 * Last Updated: 2019-11-12
 * Version 1.0
 * File name: volunteer_success_page.php
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
$user["user_first"] = $_POST["fname"];
$user["user_last"] = $_POST["lname"];
$user["user_email"] = $_POST["email"];
$user["user_phone"] = formatPhone($_POST["phone"]);

// create the dreamer associative array from POST data
$dreamer["dreamer_college"] = $_POST["college-interest"];
$dreamer["dreamer_date_of_birth"] = $_POST["dob"];
$dreamer["dreamer_graduation_date"] = $_POST["graduation-year"];
$dreamer["dreamer_gender"] = $_POST["gender"];
$dreamer["dreamer_ethnicity"] = $_POST['ethnicity'];
// if ethnicity-other is not empty, use the supplied ethnicity instead
if (!isEmpty($_POST['ethnicity-other'])) {
    $dreamer["dreamer_ethnicity"] = $_POST['ethnicity-other'];
}
$dreamer["dreamer_food"] = $_POST["fav-snacks"];
$dreamer["dreamer_goals"] = $_POST["aspirations"];
$dreamer["dreamer_active"] = "active";

$success = insertDreamer($user, $dreamer);

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

        // iterates over items posted, displays each as html on page and builds email string
        foreach ($dreamer as $key => $value) {
            // When the value is an array where each item in the array must be displayed
            if (is_array($value)) {
                $key_text = htmlspecialchars($key);
                $key_text = str_replace("-", " ", $key_text);
                $key_text = ucfirst($key_text);
                echo "<p><strong>$key_text:</strong></p>";
                echo "<ul>";
                // for each loop displays the events and removes the FK added at the beginning of the value
                foreach ($value as $child_key => $child_value) {
                    $child_value = substr($child_value, 1);
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
        $headers = "From: " . $user["user_email"] . " \r\n";
        $headers .= "Reply-To: " . $user["user_email"] . "\r\n";
        $success = mail($to, $email_subject, $email_body, $headers);
        ?>
    </div>
<?php } else {
    echo "it didn't work dreamer";
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
<script src="scripts/youth_splash_functions.js"></script>
</body>
</html>
