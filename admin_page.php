<!DOCTYPE html>
<!--
    Authors: Shayna Jamieson, Bridget Black, Keller Flint
    2019-10-16
    Last Update: 2019-11-12
    Version: 1.0
    File Name: admin_page.php
-->
<html lang="en">
<?php require_once "private/init.php";


?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Admin - iD.A.Y.Dream</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin_styles.css" type="text/css">

    <!-- https://favicon.io/emoji-favicons/blue-heart/ -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32_title.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16_title.png">
    <link rel="manifest" href="images/site.webmanifest_title">

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
</head>
<body>


<div class="text-center logo-container">
    <img src="images/iDayDreamLogo.png" alt="IDAYDream Logo">
</div>
<div class="entire-container">
<div class="input-group mb-3">
    <div class="input-group-prepend">
        <label class="input-group-text" for="inputGroupSelect01">Summary:</label>
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
    <table data-order='[[12, "desc"]]' id="dreamer-table" class="display">
        <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>College</th>
            <th>DOB</th>
            <th>Graduation</th>
            <th>Gender</th>
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
            $dataUserId = $data['user_id'];
            echo "<tr id='{$data['user_id']}'>";
            echo "<td class='update' data-target='firstName' data-id=$dataUserId><a href='#'>{$data['user_first']}</a></td>";
            echo "<td data-target='lastName'>{$data['user_last']}</td>";
            echo "<td data-target='phone'>{$data['user_phone']}</td>";
            echo "<td>{$data['user_email']}</td>";
            echo "<td>{$data['dreamer_college']}</td>";
            echo "<td>{$data['dreamer_date_of_birth']}</td>";
            echo "<td>{$data['dreamer_graduation_date']}</td>";
            echo "<td>{$data['dreamer_gender']}</td>";
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

    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="full-name"></h4>
                <button type="button" class="close btn bg-secondary" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
                <input type="hidden" id="hidden-id">
            </div>
            <div class="modal-footer">
                <button type="button" id="delete" class="pull-right bg-danger text-white btn btn-default">Delete</button>
                <button type="button" id="save" class="pull-left bg-danger text-white btn btn-default">Save</button>
            </div>
        </div>

    </div>
</div>
<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="scripts/admin_page_functions.js"></script>
<script>
    $(document).ready(function() {
        $(".update").on("click", function() {
            let id = $(this).data("id");
            let firstName = $("#"+id).children("td[data-target=firstName]").text();
            let lastName = $("#"+id).children("td[data-target=lastName]").text();


            $("#hidden-id").val(id);


            $("#full-name").html(firstName+" "+lastName);

            $("#myModal").modal("toggle");
        });
    });


    $('#save').on('click', function() {
        let id = $('#hidden-id').val();

        $.ajax({
            url: 'private/init.php',
            method: 'post',
            data: {id : id},
            success: function(response){
                console.log(response);
            }
    });
    });


</script>
</body>
</html>