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
        p {
            display: inline;
            font-weight: normal;
        }

        label {
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


        /*    Bootstrap Slider */
        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }


    /*    FOR THE THREE TOGGLE SWITCH -- */
        body{
            margin:0;
            padding:0;
        }
        .parent{
            /*position:fixed;*/
            /*width:100%;*/
            /*height:100%;*/
            display:inline-flex;
            background:#fff;
        }


        .switch_3_ways{
            margin:auto;
            font-size:1em;
            height:2em;
            line-height:2em;
            border-radius:0.3em;
            background:#ccc;
            position:relative;
            display:block;
            float:left;
        }

        .switch.pending,
        .switch.active,
        .switch.inactive{
            cursor:pointer;
            position:relative;
            display:block;
            float:left;
            -webkit-transition: 300ms ease-out;
            -moz-transition: 300ms ease-out;
            transition: 300ms ease-out;
            padding: 0 1em;
        }

        .selector{
            text-align:center;
            position:absolute;
            width:0;
            box-sizing:border-box;
            -webkit-transition: 300ms ease-out;
            -moz-transition: 300ms ease-out;
            transition: 300ms ease-out;
            border-radius:0.3em;
            color:white;
            -moz-box-shadow: 0px 2px 13px 0px #9b9b9b;
            -webkit-box-shadow: 0px 2px 13px 0px #9b9b9b;
            -o-box-shadow: 0px 2px 13px 0px #9b9b9b;
            box-shadow: 0px 2px 13px 0px #9b9b9b;
            filter:progid:DXImageTransform.Microsoft.Shadow(color=#9b9b9b, Direction=180, Strength=13);
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
                <option value="dreamers"
                        id="dreamer-option" <?php if ($_GET["data_select"] == "dreamers") echo "selected"; ?>>Dreamers
                </option>
                <option value="volunteers"
                        id="volunteer-option" <?php if ($_GET["data_select"] == "volunteers") echo "selected"; ?>>
                    Volunteers
                </option>
            </select>
        </form>
        <?php if ($_GET["data_select"] == "dreamers") { ?>
        <p>Active: </p>
        <label class="switch">
            <input type="checkbox" id="toggle-inactive" checked>
            <span class="slider"></span>
        </label><br><br>
        <?php }
            // this is where we need the three toggle switch
            // we will allow the admin to switch between inactive, active, and pending
            // for her volunteer users and will populate the table as such
            else if($_GET['data_select'] == "volunteers") {
            ?>
                <div class="parent">
                    <div class="switch_3_ways">
                        <div id="pending" class="switch pending" onclick="change_status('pending')">Pending</div>
                        <div id="active" class="switch active" onclick="change_status('active')">Active</div>
                        <div id="inactive" class="switch inactive" onclick="change_status('inactive')">Inactive</div>
                        <div id="selector" class="selector"></div>
                    </div>

                </div> <!-- displays the three toggle switch-->

             <?
            }
            ?>
        <button id="email-button" type="button" class="btn btn-primary btn-lg">Email</button>
    </div>
    <?php
    //if it's the dreamer table, run $sql for member row + run $sql_ids for user_ids Foreign key
    if ($_GET["data_select"] == "dreamers") {
        $sql = "SELECT user_first, user_last, user_email, user_phone, dreamer_date_of_birth, dreamer_active, user_date_joined FROM User 
                INNER JOIN Dreamer ON User.user_id = Dreamer.user_id
                WHERE dreamer_active = 1;";
        $sql_ids = "SELECT user_id FROM Dreamer;";
    } //if it's the volunteer table, run $sql for member row + run $sql_ids for user_ids Foreign key
    else if ($_GET["data_select"] == "volunteers") {
        $sql = "SELECT user_first, user_last, user_email, user_phone, volunteer_verified, volunteer_active, user_date_joined FROM User INNER JOIN Volunteer ON User.user_id = Volunteer.user_id;";
        $sql_ids = "SELECT user_id FROM Volunteer;";
    }

    //if on the dreamer or volunteer table then continue:
    if (($_GET["data_select"] == "dreamers") || $_GET["data_select"] == "volunteers") {
        //storing return data and ensuring query executes correctly
        $result = mysqli_query($cnxn, $sql);
        //storing column names
        $tableHeadingNames = $result->fetch_fields();
        //storing return data and ensuring query executes correctly
        $result_ids = mysqli_query($cnxn, $sql_ids);
        ?>

        <!--start the building of the table-->
        <table data-order='[[<?php echo mysqli_num_fields($result) - 1; ?>, "desc"]]' id="dreamer-table"
               class="display">
            <?php echo buildTable($result, $tableHeadingNames, $result_ids); ?>
        </table>
        <?php
    } //closing if statement
    ?>
</div> <!-- entire container -->

<!-- Modal for individual users and their data -->
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
                <button type="button" id="delete" class="pull-right bg-danger text-white btn btn-default">Delete
                </button>
                <button type="button" id="save" class="pull-left bg-danger text-white btn btn-default">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for email functionality -->
<div id="emailModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="email-modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">Subject</span>
                    </div>
                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                </div> <!-- end of subject line code -->
                <textarea rows="10" cols="50"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Send</button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="scripts/admin_page_functions.js"></script>
<script>

    $(document).ready(function () {
        // call function to set the three switch toggle to "active"
        change_status("active");
        //toggle switch for 'active'/'inactive' members
        $("#toggle-inactive").on("change", function () {
            //overwrites 'active' members on table and displays 'inactive'
            if ($("#toggle-inactive").is(":checked")) {
                $.ajax({
                    url: 'private/init.php',
                    method: 'post',
                    data: {queryType: "active_query"},
                    success: function (response) {
                        $("#dreamer-table").html(response);
                    }
                }); //.ajax
            } else {
                $.ajax({
                    url: 'private/init.php',
                    method: 'post',
                    data: {queryType: "inactive_query"},
                    success: function (response) {
                        $("#dreamer-table").html(response);
                    }
                }); //.ajax
            }

        }); //.on

        //fills modal on 'click' of member's name
        $(".update").on("click", function () {
            //get the 'id' of the row (parent of first name clicked)
            let id = this.parentElement.getAttribute("id");
            let firstName = $("#" + id).children("td[data-field-name = user_first]").text();
            let lastName = $("#" + id).children("td[data-field-name = user_last]").text();

            //get the selected table from "select" dropdown
            let dataSelect = tableSelected();


            //to be passed into .ajax
            $("#hidden-id").val(id);
            //Top of modal display full name of member
            $("#full-name").html(firstName + " " + lastName);

            $("#myModal").modal("toggle");

            //writes 'active' members to table
            $.ajax({
                url: 'private/init.php',
                method: 'post',
                data: {id: id, dataSelect: dataSelect},
                dataType: 'JSON',
                success: function (response) {
                    console.log(response);
                    populateModalData(response);
                }
            }); //.ajax
        }); //.on


        // toggle the modal for emailing functionality
        $("#email-button").on("click", function () {
            let str = tableSelected();
            str = str[0].toUpperCase() + str.substr(1, str.length);
            $("#email-modal-title").html("Email Active " + str);
            $("#emailModal").modal("toggle");
        });

    }); //.ready

    //user_id for row we're working on
    //save button doesn't work 2019-11-16 DELETE WHEN WORKING ***************************************************
    $('#save').on('click', function () {
        let id = $('#hidden-id').val();
    }); //.on

    //JSON array
    //appending all children into modal-body
    function populateModalData(responseData) {
        //for each data field, displaying 'key' and 'value' paired data into the modal
        $.each(responseData, function (key, value) {
            //the field heading
            let textNode = document.createTextNode(formatHeadings(key) + ":   ");
            let label = document.createElement('label');
            label.append(textNode);

            // format active to inactive or active rather than 0 and 1
            if (key == "dreamer_active") {
                value = formatActive(value);
            }

            //the field value
            textNode = document.createTextNode(value);
            let p = document.createElement('p');
            p.append(textNode);

            //append the key and value together
            label.append(p);

            //the modal body
            let modalB = document.getElementById("modal-body");
            //append key and value into the modal
            modalB.append(label);
        }); //.each
    } //end populateModalData

    //clears modal body after click away
    $('#myModal').on('hidden.bs.modal', function () {
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
            str = str.substr(1, str.length);
        }
        str = str[0].toUpperCase() + str.substr(1, str.length);
        return str;
    }

    //the member's status is a TINYINT, convert for readability
    function formatActive(val) {
        if (val === "1") {
            return "active";
        }
        return "inactive";
    }

    function tableSelected() {
        // get the selected table from "select" dropdown
        let dataSelect;
        if (document.getElementById('dreamer-option').selected) {
            dataSelect = 'dreamers';
        } else if (document.getElementById('volunteer-option').selected) {
            dataSelect = 'volunteers';
        }
        return dataSelect;
    }

    // FOR THE THREE TOGGLE SWITCH !!! -- should be moved later
    function change_status(status){
        let pending = document.getElementById("pending");

        let active = document.getElementById("active");

        let inactive = document.getElementById("inactive");

        let selector = document.getElementById("selector");

        if(status === "pending"){
            selector.style.left = 0;
            selector.style.width = pending.clientWidth + "px";
            selector.style.backgroundColor = "#777777";
            selector.innerHTML = "Pending";
        }

        else if(status === "active"){
            selector.style.left = pending.clientWidth + "px";
            selector.style.width = active.clientWidth + "px";
            selector.innerHTML = "Active";
            selector.style.backgroundColor = "#418d92";
        }

        else{
            selector.style.left = pending.clientWidth + active.clientWidth + 1 + "px";
            selector.style.width = inactive.clientWidth + "px";
            selector.innerHTML = "Inactive";
            selector.style.backgroundColor = "#4d7ea9";
        }
    }
</script>
</body>
</html>