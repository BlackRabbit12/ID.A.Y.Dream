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

/*str = str.replace(/_/g, " ");
        str = str.replace("user", "");
        str = str.replace("volunteer", "");
        str = str.replace("dreamer", "");
        if (str[0] == " ") {
            str = str.substr(1, str.legnth);
        }
        str = str[0].toUpperCase() + str.substr(1, str.legnth);*/