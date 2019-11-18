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
    <style>
        p{
            display: inline;
            font-weight: normal;
        }
        label{
            display: block;
            font-weight: bolder;
        }

        .modal-dialog,
        .modal-content {
            /* 80% of window height */
            height: 90%;
            width: 100%;
        }

        .modal-body {
            /* 100% = dialog height, 120px = header + footer */
            max-height: calc(100% - 120px);
            overflow-y: scroll;
        }

    </style>
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
            <option value="dreamers" id="dreamer-option" <?php if ($_GET["data_select"] == "dreamers") echo "selected"; ?>>Dreamers</option>
            <option value="volunteers" id="volunteer-option" <?php if ($_GET["data_select"] == "volunteers") echo "selected"; ?>>Volunteers</option>
        </select>
    </form>
</div>
<?php
    if ($_GET["data_select"] == "dreamers") {
        $sql = "SELECT user_first, user_last, user_email, user_phone, dreamer_date_of_birth, dreamer_active, user_date_joined FROM User INNER JOIN Dreamer ON User.user_id = Dreamer.user_id;";
        $sql_ids = "SELECT user_id FROM Dreamer;";
        //$dataUserId = $data['user_id'];
    }
    else if ($_GET["data_select"] == "volunteers") {
        $sql = "SELECT user_first, user_last, user_email, user_phone, volunteer_verified, volunteer_active, user_date_joined FROM User INNER JOIN Volunteer ON User.user_id = Volunteer.user_id;";
        $sql_ids = "SELECT user_id FROM Volunteer;";
    }

    if (($_GET["data_select"] == "dreamers") || $_GET["data_select"] == "volunteers") {
        $result = mysqli_query($cnxn, $sql);
        $tableHeadingNames = $result -> fetch_fields();
        $result_ids = mysqli_query($cnxn, $sql_ids);
    ?>
    <table data-order='[[<?php echo mysqli_num_fields($result) - 1; ?>, "desc"]]' id="dreamer-table" class="display">
        <thead>
        <tr>
            <?php
            $tableHeadingNames_array = [];
            foreach($tableHeadingNames as $value){
                $heading = formatHeadings($value -> name);
                echo "<th>$heading</th>";
                $tableHeadingNames_array[] = $value -> name;
            }

            $allIdsForAllRows_array = [];
            while ($value = mysqli_fetch_assoc($result_ids)){
                $allIdsForAllRows_array[] = $value['user_id'];
            }
            //var_dump($allIdsForAllRows_array);
            ?>
        </tr>
        </thead>
        <tbody>
        <?php
        $k = 0;
        while ($data = mysqli_fetch_assoc($result)) {
            echo "<tr id= '$allIdsForAllRows_array[$k]'>";
            $i = 0;
            foreach($data as $value){
                if($i == 0){
                    echo "<td class = 'update' data-field-name = $tableHeadingNames_array[$i]><a href = '#'>$value</a></td>";
                }
                else {
                    if($tableHeadingNames_array[$i] == "dreamer_date_of_birth" || $tableHeadingNames_array[$i] == "user_date_joined") {
                        $value = formatSQLDate($value);
                    }
                    echo "<td data-field-name = $tableHeadingNames_array[$i]>$value</td>";
                }
                $i++;
            }
            echo "</tr>";
            $k++;
        }
        ?>
        </tbody>
    </table>
    <?php
    } //closing if statement
    ?>
</div> <!-- entire container -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="full-name"></h4>
                <button type="button" class="close btn bg-secondary" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="modal-body">
<!--                <p>Some text in the modal.</p>-->
                <input type="hidden" id="hidden-id">
            </div>
            <div class="modal-footer">
                <button type="button" id="delete" class="pull-right bg-danger text-white btn btn-default">Delete</button>
                <button type="button" id="save" class="pull-left bg-danger text-white btn btn-default">Save</button>
            </div>
        </div>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="scripts/admin_page_functions.js"></script>
<script>
    $(document).ready(function() {
        $(".update").on("click", function() {

            let id = this.parentElement.getAttribute("id");
            let firstName = $("#"+id).children("td[data-field-name = user_first]").text();
            let lastName = $("#"+id).children("td[data-field-name = user_last]").text();

            let dataSelect;
            if (document.getElementById('dreamer-option').selected){
                dataSelect = 'dreamers';
            }
            else if (document.getElementById('volunteer-option').selected){
                dataSelect = 'volunteers';
            }

            //to be passed into .ajax
            $("#hidden-id").val(id);

            $("#full-name").html(firstName+" "+lastName);

            $("#myModal").modal("toggle");

            $.ajax({
                url: 'private/init.php',
                method: 'post',
                data: {id : id, dataSelect : dataSelect},
                dataType: 'JSON',
                success: function(response){
                    console.log(response);
                    populateModalData(response);
                }
            }); //.ajax
        }); //.on
    }); //.ready

    //user_id for row we're working on
    //save button doesn't work 2019-11-16
    $('#save').on('click', function() {
        let id = $('#hidden-id').val();
    }); //.on

    //JSON array
    //appending all children into modal-body
    function populateModalData(responseData) {
        $.each(responseData, function(key, value){
            let textNode = document.createTextNode(formatHeadings(key) + ":   ");
            let label = document.createElement('label');
            label.append(textNode);

            textNode = document.createTextNode(value);
            let p = document.createElement('p');
            p.append(textNode);

            label.append(p);

            let modalB = document.getElementById("modal-body");
            modalB.append(label);

            //console.log(key, value);
        }); //.each
    } //end populateModalData

    //clears modal body after click away
    $('#myModal').on('hidden.bs.modal', function(){
        $("#modal-body").html("");
    }); //.on

    // formats the heading names retrieved from database for clear user view
    function formatHeadings(str) {
        str = str.replace(/\d+/g, '');
        str = str.replace(/_/g, " ");
        str = str.replace("user", "");
        str = str.replace("volunteer", "");
        str = str.replace("dreamer", "");
        if (str[0] == " ") {
            str = str.substr(1, str.legnth);
        }
        str = str[0].toUpperCase() + str.substr(1, str.legnth);
        return str;
    }
</script>
</body>
</html>