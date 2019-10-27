
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
<h1>Thank you for your interest in volunteering with iD.A.Y.dream <?php echo $_POST["fname"]?>. We’re investing in an entire region of youth. Youth seeking success through higher education, mentoring…………..</h1>
<!-- HERE IS WHERE WE NEED TO THANK THEM AND THEN DISPLAY THE INFORMATION THAT THEY SUBMITTED -->
<div class="container" id="summary">
<?php
// start putting together email as we are also displaying their information
$email_body = "Youth Information:\r\n\r\n";
$email_subject = "ID.A.Y.Dream Youth Sign-Up Information";

foreach($_POST as $key => $value) {
    if (is_array($value)) {
        $key_text = htmlspecialchars($key);
        $key_text = str_replace("-", " ", $key_text);
        $key_text = ucfirst($key_text);
        echo "<p><strong>$key_text:</strong></p>";
        echo "<ul>";
        foreach($value as $child_key => $child_value) {
            $value_text = htmlspecialchars($child_value);
            $email_body .= "$child_value \r\n";
            echo "<li>$child_value</li>";
        }
        echo "</ul>";
    } else if ($value != "") {
        $key_text = htmlspecialchars($key);
        $key_text = ucfirst($key_text);
        $value_text = htmlspecialchars($value);
        $key_text = str_replace("-", " ", $key_text);
        $email_body .= "$key_text: $value_text \r\n";
        echo "<p><strong>$key_text:</strong> $value_text</p>";
    }
}

// now we send an email to show that we can send her the information
$sendTo = "kflint0068@gmail.com";
$to = $sendTo;
$headers = "From: " . $_POST["email"] . " \r\n";
$headers .= "Reply-To: " . $_POST["email"] . "\r\n";
$success = mail($to, $email_subject, $email_body, $headers);
echo "Sent email: " . (int) $success;
?>
</div>
</body>
</html>