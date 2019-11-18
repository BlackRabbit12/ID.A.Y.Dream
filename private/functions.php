<?php

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
function formatSQLDate($str) {
    //SQL return = 2003-04-26
    $str = substr($str, 5, 2)  . "/" . substr($str, 8,2) . "/" . substr($str, 0, 4);
    return $str;
}

// formats the SQL phone we get back into the (111) 111-1111 format
function formatSQLPhone($str) {
    //SQL return = 2534411380
    $str = "(" . substr($str, 0, 3)  . ") " . substr($str, 4,3) . "-" . substr($str, 6, 4);
    return $str;
}
