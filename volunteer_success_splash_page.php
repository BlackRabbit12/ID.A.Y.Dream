
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
<div class="container" id="thank-you-message">
    <h2>Thank you for your interest in volunteering with iD.A.Y.Dream <?php echo $_POST["first-name"]?>. We’re investing in an entire region of youth. Youth seeking success through higher education, mentoring, etc.</h2>
    <br><h3>Click to see a summary of your information.</h3>
    <button class="btn btn-lg" type="button" id="summary-button">CLICK ME</button>
</div>
    <!-- HERE IS WHERE WE NEED TO THANK THEM AND THEN DISPLAY THE INFORMATION THAT THEY SUBMITTED  -->
<div class="container" id="summary">
<?php
// building email content
$email_body = "Youth Information:\r\n\r\n";
$email_subject = "ID.A.Y.Dream Youth Sign-Up Information";

// iterates over items posted, displays each as html on page and builds email string
foreach($_POST as $key => $value) {
    // When the value is an array where each item in the array must be displayed
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
$sendTo = "kflint0068@gmail.com";
$to = $sendTo;
$headers = "From: " . $_POST["email"] . " \r\n";
$headers .= "Reply-To: " . $_POST["email"] . "\r\n";
$success = mail($to, $email_subject, $email_body, $headers);
?>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- jQuery for input validation -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="scripts/volunteer_splash_functions.js"></script>
</div>
</body>
</html>