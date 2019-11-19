<?php

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
    $k = 0;
    while ($data = mysqli_fetch_assoc($result)) {
        $output .= "<tr id= '$user_ids_array[$k]'>";
        $i = 0;
        foreach ($data as $value) {
            if ($i == 0) {
                $output .= "<td class = 'update' data-field-name = $tableHeadingNames_array[$i]><a href = '#'>$value</a></td>";
            } else {
                if ($tableHeadingNames_array[$i] == "dreamer_date_of_birth" || $tableHeadingNames_array[$i] == "user_date_joined") {
                    $value = formatSQLDate($value);
                }
                if ($tableHeadingNames_array[$i] == "user_phone") {
                    $value = formatSQLPhone($value);
                }

                if ($tableHeadingNames_array[$i] == "dreamer_active") {
                    $value = formatActive($value);
                }


                $output .= "<td data-field-name = $tableHeadingNames_array[$i]>$value</td>";
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

// format booleans to string active or inactive
function formatActive($val)
{
    if ($val) {
        return "active";
    }
    return "inactive";
}

