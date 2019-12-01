<?php

/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-10-29
 * Last Update: 2019-11-27
 * File name: functions.php
 * Associated Files:
 *      ************************************************************************************************
 *
 * Description:
 *      File contains **********************************************************************************
 */

// builds and returns a table $output string
function buildTable($result, $tableHeadingNames, $result_ids)
{
    $output = "<thead>";
    $output .= "<tr>";

    //get the table heading names and build the table headers with them
    $tableHeadingNames_array = [];
    foreach ($tableHeadingNames as $value) {
        $heading = formatHeadings($value->name);
        $output .= "<th>$heading</th>";
        $tableHeadingNames_array[] = $value->name;
    }

    //array of user_id, to capture each row's user_id for updates
    $user_ids_array = [];
    while ($value = mysqli_fetch_assoc($result_ids)) {
        $user_ids_array[] = $value['user_id'];
    }

    $output .= "</tr>";
    $output .= "</thead>";
    $output .= "<tbody>";

    //fill in the table's row + data
    $log = [];
    $k = 0;
    while ($data = mysqli_fetch_assoc($result)) {
        $output .= "<tr id= '$user_ids_array[$k]'>";
        $log[] = $user_ids_array[$k];
        $i = 0;
        // populates table data
        foreach ($data as $value) {
            if ($i == 0) {
                $output .= "<td class = 'update $tableHeadingNames_array[$i]'><a href = '#'>$value</a></td>";
            }
            else {
                if ($tableHeadingNames_array[$i] == "dreamer_date_of_birth" || $tableHeadingNames_array[$i] == "user_date_joined") {
                    $value = formatSQLDate($value);
                }
                if ($tableHeadingNames_array[$i] == "user_phone") {
                    $value = formatSQLPhone($value);
                }
                // todo change dreamer_active to dreamer_status
                if ($tableHeadingNames_array[$i] == "volunteer_status" || $tableHeadingNames_array[$i] == "dreamer_active"){
                    $value = dropDownStatus($value);
                }

                $output .= "<td class = '$tableHeadingNames_array[$i]'>$value</td>";
            }
            $i++;
        }

        $output .= "</tr>";
        $k++;
    }

    $output .= "</tbody>";

    //return built table
    return $output;
}

//creates a dropdown menu in the status column on admin table
function dropDownStatus($value){
    if ($value == 'pending') {
        return "<select class=\"form-control\" id=\"sel1\">
        <option selected>pending</option>
        <option>active</option>
        <option>inactive</option>
      </select>";
    }
    else if ($value == 'active') {
        return "<select class=\"form-control\" id=\"sel1\">
        <option>pending</option>
        <option selected>active</option>
        <option>inactive</option>
      </select>";
    }
    else if  ($value == 'inactive') {
        return "<select class=\"form-control\" id=\"sel1\">
        <option>pending</option>
        <option>active</option>
        <option selected>inactive</option>
      </select>";
    }
} //end dropDownStatus($value)

// formats the heading names retrieved from database for clear user view
function formatHeadings($str)
{
    $str = str_replace("user_", '', $str);
    $str = str_replace("volunteer_", '', $str);
    $str = str_replace("dreamer_", '', $str);
    $str = str_replace("_", ' ', $str);
    $str = ucfirst($str);
    return $str;
}

// formats the SQL date we get back into the MM/DD/YYYY format
function formatSQLDate($str)
{
    //SQL return = 2003-04-26
    $str = substr($str, 5, 2) . "/" . substr($str, 8, 2) . "/" . substr($str, 0, 4);
    return $str;
}

// formats the SQL phone we get back into the (111) 111-1111 format
function formatSQLPhone($str)
{
    //SQL return = 2534411380
    $str = "(" . substr($str, 0, 3) . ") " . substr($str, 4, 3) . "-" . substr($str, 6, 4);
    return $str;
}

/**
 * Generates a summary of the users information for email and the site
 * @param $email_body string the starting text for the body of the email
 * @return array element 0 contains the html summary format, element 2 contains the email summary format
 */
function createSummary($email_body)
{
    $summary_content = "";
    // iterates over items posted, displays each as html on page and builds email string
    foreach ($_POST as $key => $value) {
        // When the value is an array where each item in the array must be displayed
        if (is_array($value)) {
            //formatting keys for output
            $key_text = htmlspecialchars($key);
            $key_text = str_replace("-", " ", $key_text);
            $key_text = ucfirst($key_text);
            //adding key output to summary
            $summary_content .= "<p><strong>$key_text:</strong></p>";
            $summary_content .= "<ul>";
            // if the value is the ids of the interests, switch out the ids for the interest names
            if ($key == "events") {
                $value = findInterestNamesByIds($value);
            }
            // for each loop displays the events and removes the FK added at the beginning of the value
            foreach ($value as $child_key => $child_value) {
                $child_value = $child_value;
                $value_text = htmlspecialchars($child_value);
                $email_body .= "$value_text \r\n";
                $summary_content .= "<li>$value_text</li>";
            }

            $summary_content .= "</ul>";
            // As long as the value isn't empty, display results and add to email
        } else if ($value != "") {
            // formatting keys and values for output to summary
            $key_text = htmlspecialchars($key);
            $key_text = ucfirst($key_text);
            $value_text = htmlspecialchars($value);
            $key_text = str_replace("-", " ", $key_text);
            //adding key and value output to summaries
            $email_body .= "$key_text: $value_text \r\n";
            $summary_content .= "<p><strong>$key_text:</strong> $value_text</p>";
        }
    }
    return [$summary_content, $email_body];
}