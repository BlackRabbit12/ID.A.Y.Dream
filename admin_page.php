<!DOCTYPE html>
<!--
    Authors: Shayna Jamieson, Bridget Black, Keller Flint
    2019-10-16
    Last Update: 2019-11-06
    Version: 1.0
    File Name: admin_page.php
-->
<html lang="en">
<?php require_once "private/init.php"; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Admin - iD.A.Y.Dream</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/youth_styles.css" type="text/css">

    <!-- https://favicon.io/emoji-favicons/blue-heart/ -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32_title.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16_title.png">
    <link rel="manifest" href="images/site.webmanifest_title">

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
</head>
<body>

<div class="input-group mb-3">
    <div class="input-group-prepend">
        <label class="input-group-text" for="inputGroupSelect01">Data</label>
    </div>
    <form action="admin_page.php" id="select-form" method="GET">
        <select class="custom-select" id="data-select" name="data_select">
            <option value="none">None</option>
            <option value="dreamers" <?php if ($_GET["data_select"] == "dreamers") echo "selected"; ?>>Dreamers</option>
            <option value="volunteers" <?php if ($_GET["data_select"] == "volunteers") echo "selected"; ?>>Volunteers</option>
        </select>
    </form>
</div>
<?php if ($_GET["data_select"] == "dreamers") { ?>
    <table data-order='[[11, "desc"]]' id="dreamer-table" class="display">
        <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>College</th>
            <th>DOB</th>
            <th>Graduation</th>
            <th>Ethnicity</th>
            <th>Snacks</th>
            <th>Goals</th>
            <th>Active</th>
            <th>Date Joined</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM Dreamer INNER JOIN User ON User.user_id = Dreamer.user_id;";
        $result = mysqli_query($cnxn, $sql);

        while ($data = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$data['user_first']}</td>";
            echo "<td>{$data['user_last']}</td>";
            echo "<td>{$data['user_phone']}</td>";
            echo "<td>{$data['user_email']}</td>";
            echo "<td>{$data['dreamer_college']}</td>";
            echo "<td>{$data['dreamer_date_of_birth']}</td>";
            echo "<td>{$data['dreamer_graduation_date']}</td>";
            echo "<td>{$data['dreamer_ethnicity']}</td>";
            echo "<td>{$data['dreamer_food']}</td>";
            echo "<td>{$data['dreamer_goals']}</td>";
            if ($data['dreamer_active']) {
                $active = 'false';
            } else {
                $active = 'true';
            }
            echo "<td>$active</td>";
            echo "<td>{$data['user_date_joined']}</td>";
            echo "</tr>";
        }

        ?>
        </tbody>

    </table>


<?php } else if ($_GET["data_select"] == "volunteers") { ?>
<!-- Volunteer Table -->
<table data-order='[[10, "desc"]]' id="volunteer-table" class="display">
    <thead>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Address</th>
        <th>Zip</th>
        <th>City</th>
        <th>State</th>
        <th>Mailing List</th>
        <th>Active</th>
        <th>Date Joined</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sql = "SELECT * FROM Volunteer INNER JOIN User ON User.user_id = Volunteer.user_id;";
    $result = mysqli_query($cnxn, $sql);

    while ($data = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$data['user_first']}</td>";
        echo "<td>{$data['user_last']}</td>";
        echo "<td>{$data['user_phone']}</td>";
        echo "<td>{$data['user_email']}</td>";
        echo "<td>{$data['volunteer_street_address']}</td>";
        echo "<td>{$data['volunteer_zip']}</td>";
        echo "<td>{$data['volunteer_city']}</td>";
        echo "<td>{$data['volunteer_state']}</td>";
        echo "<td>{$data['volunteer_emailing']}</td>";
        if ($data['volunteer_active']) {
            $active = 'false';
        } else {
            $active = 'true';
        }
        echo "<td>$active</td>";
        echo "<td>{$data['user_date_joined']}</td>";
        echo "</tr>";
    }

    ?>
    </tbody>

    <?php } ?>

</table>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#dreamer-table').DataTable();
        $('#volunteer-table').DataTable();
    });

    document.getElementById("data-select").addEventListener("change", function () {
        this.form.submit();
    });

</script>
</body>
</html>