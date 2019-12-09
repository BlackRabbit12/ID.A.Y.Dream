<?php

/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-10-29
 * Last Update: 2019-12-08
 * File name: functions.php
 * Associated Files:
 *      volunteer_success_splash_page.php
 *      youth_success_splash.php
 *      admin_page.php
 *
 * Description:
 *      File contains functions to build the admin table (with appropriate formatting), the dropdown field inside
 *      the admin table, and to build the summary pages.
 *      Quick File Relations:
 *          volunteer_success_splash_page.php - Uses summary created in functions.php
 *          youth_success_splash.php - Uses summary created in functions.php
 *          admin_page.php - Uses tables built in functions.php
 *      Functions:
 *          buildTable(3x)
 *          dropDownStatus(1x)
 *          formatHeadings(1x)
 *          formatSQLDate(1x)
 *          formatSQLPhone(1x)
 *          createSummary(1x)
 */


/**
 * Builds the admin table.
 * @param $result
 * @param $tableHeadingNames
 * @param $result_ids
 * @return string $output is the 'string' of html that builds the table.
 */
//TODO finish documentation
function buildTable($result, $tableHeadingNames, $result_ids)
{
    $output = "<thead>";
    $output .= "<tr>";

    //get the table heading names and build the table headers with them
    $tableHeadingNames_array = [];
    foreach ($tableHeadingNames as $value) {
        //formatHeadings (admin_page_functions.js)
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
                    //formatSQLDate (functions.php)
                    $value = formatSQLDate($value);
                }
                if ($tableHeadingNames_array[$i] == "user_phone") {
                    //formatSQLPhone (functions.php)
                    $value = formatSQLPhone($value);
                }
                if ($tableHeadingNames_array[$i] == "volunteer_status" || $tableHeadingNames_array[$i] == "dreamer_status"){
                    //dropDownStatus (functions.php)
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
} //end buildTable($result, $tableHeadingNames, $result_ids)


/**
 * Creates a dropdown menu in the 'status' column on the admin table.
 * Dropdown in admin table for easier update on the user's status "active, inactive, pending".
 * @param $value Current value of the dropdown selection.
 * @return string HTML of what to display in the dropdown with new selection.
 */
function dropDownStatus($value){
    if ($value == 'pending') {
        return "<select class=\"form-control status-dropdown\">
        <option value = \"pending\" selected>pending</option>
        <option value = \"active\">active</option>
        <option value = \"inactive\">inactive</option>
      </select>";
    }
    else if ($value == 'active') {
        return "<select class=\"form-control status-dropdown\">
        <option value = \"pending\">pending</option>
        <option value = \"active\" selected>active</option>
        <option value = \"inactive\">inactive</option>
      </select>";
    }
    else if  ($value == 'inactive') {
        return "<select class=\"form-control status-dropdown\">
        <option value = \"pending\">pending</option>
        <option value = \"active\">active</option>
        <option value = \"inactive\" selected>inactive</option>
      </select>";
    }
} //end dropDownStatus($value)


/**
 * Formats the heading names retrieved from database for improved UX.
 * @param $str String of heading name from database.
 * @return string|string[] String of heading name for human readability.
 */
function formatHeadings($str)
{
    $str = str_replace("user_", '', $str);
    $str = str_replace("volunteer_", '', $str);
    $str = str_replace("dreamer_", '', $str);
    $str = str_replace("_", ' ', $str);
    $str = ucfirst($str);
    return $str;
} //end formatHeadings($str)


/**
 * Formats the SQL date into MM/DD/YYYY format.
 * @param $str String date given.
 * @return string Date formatted.
 */
function formatSQLDate($str)
{
    //SQL return = 2003-04-26
    $str = substr($str, 5, 2) . "/" . substr($str, 8, 2) . "/" . substr($str, 0, 4);
    return $str;
} //end formatSQLDate($str)


/**
 * Formats the SQL phone number into (###) ###-#### format.
 * @param $str String phone number given.
 * @return string Phone number formatted.
 */
function formatSQLPhone($str)
{
    //SQL return = 2534411380
    $str = "(" . substr($str, 0, 3) . ") " . substr($str, 4, 3) . "-" . substr($str, 6, 4);
    return $str;
} //end formatSQLPhone($str)


/**
 * Generates a summary of the user's information for an admin email and the summary page.
 * Summaries are created on the volunteer_success_splash_page.php and the youth_success_splash.php, then emailed to
 * the listed administrator (Brandi Day).
 * @param $email_body string the text + html elements of the body of the email and summary.
 * @return array element 0 contains the html summary format, element 2 contains the email summary format.
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
            // for each loop displays the events and removes the FK added at the beginning of the value
            foreach ($value as $child_key => $child_value) {
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
} //end createSummary($email_body)