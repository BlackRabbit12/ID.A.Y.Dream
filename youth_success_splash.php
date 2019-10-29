<?php
// Authors: Shayna Jamieson, Keller Flint, Bridget Black
ini_set('display_errors', 1);
error_reporting(E_ALL);
// declare variables here to use throughout this page & w/ email functionality
$firstName = $_POST['fname'];
$lastName = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$collegeInterest = $_POST['college-interest'];
$graduationYear = $_POST['graduation-year'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$ethnicity = $_POST['ethnicity'];
$favSnacks = $_POST['fav-snacks'];
$aspirations = $_POST['aspirations'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Youth - iD.A.Y.Dream</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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

<div class="container" id="thank-you-message">
    <?php
    echo "<h2>Thank you for your submission $firstName!</h2>"
    ?>
    <h3>Click to see a summary of your information.</h3>
    <button class="btn btn-lg" type="button" id="summary-button">CLICK ME</button>
</div>

<div class="container" id="summary">
    <?php
    // start putting together email as we are also displaying their information
    $emailBody = "Youth Information:\r\n\r\n";
    $emailSubject = "ID.A.Y.Dream Youth Sign-Up Information";
    echo "<p><strong>Full Name</strong>: $firstName $lastName</p>";
    $emailBody .= "Name: $firstName $lastName\r\n";
    echo "<p><strong>Email:</strong> $email</p>";
    $emailBody .= "Email: $email\r\n";
    echo "<p><strong>Phone Number:</strong> $phone</p>";
    $emailBody .= "Phone: $phone\r\n";
    echo "<p><strong>Date of Birth:</strong> $dob</p>";
    $emailBody .= "Date of Birth: $dob\r\n";
    echo "<p><strong>Ethnicity:</strong> $ethnicity</p>";
    $emailBody .= "Ethnicity: $ethnicity\r\n";
    // these can be intentionally left blank -- must check if they are before displaying no information
    if(!$collegeInterest == "") {
        echo "<p><strong>College of Interest:</strong> $collegeInterest</p>";
        $emailBody .= "College of Interest: $collegeInterest\r\n";
    }
    if(!$graduationYear == "") {
        echo "<p><strong>Graduation Year:</strong> $graduationYear</p>";
        $emailBody .= "Graduation Year: $graduationYear\r\n";
    }
    if(!$favSnacks == "") {
        echo "<p><strong>Favorite Foods/Snacks:</strong> $favSnacks</p>";
        $emailBody .= "Favorite Foods/Snacks: $favSnacks\r\n";
    }
    if(!$aspirations == "") {
        echo "<p><strong>Aspirations/Goals:</strong> $aspirations</p>";
        $emailBody .= "Aspirations/Goals: $aspirations\r\n";
    }
    // now we send an email to show that we can send her the information
    $sendToBrandy = "jamieson.shayna@gmail.com";
    $to = $sendToBrandy;
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $success = mail($to, $emailSubject, $emailBody, $headers);
    ?>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- jQuery for input validation -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="scripts/youth_splash_functions.js"></script>
</body>
</html>