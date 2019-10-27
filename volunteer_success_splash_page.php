
<?php
// Authors: Shayna Jamieson, Keller Flint, Bridget Black
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Volunteer - iD.A.Y.Dream</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- https://favicon.io/emoji-favicons/blue-heart/ -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32_title.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16_title.png">
    <link rel="manifest" href="images/site.webmanifest_title">
</head>
<body>
<h1>Thank you for your interest in volunteering with iD.A.Y.dream <?php echo $_POST[""]?>. We’re investing in an entire region of youth. Youth seeking success through higher education, mentoring…………..</h1>
<!-- HERE IS WHERE WE NEED TO THANK THEM AND THEN DISPLAY THE INFORMATION THAT THEY SUBMITTED -->
<?php
// start putting together email as we are also displaying their information
$email_body = "Youth Information:\r\n\r\n";
$email_subject = "ID.A.Y.Dream Youth Sign-Up Information";

foreach($_POST as $key => $value) {
    $key_text = htmlspecialchars($key);
    $value_text = htmlspecialchars($value);
    $email_body .= "$key: $value \r\n";
    echo "<p><strong>$key:</strong> $value</p>";
}

// now we send an email to show that we can send her the information
$sendToBrandy = "kflint0068@gmail.com";
$to = $sendToBrandy;
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$success = mail($to, $email_subject, $email_body, $headers);
?>
</body>
</html>