/*
Authors: Shayna Jamieson, Bridget Black, Keller Flint
2019-10-29
Last Update: 2019-10-29
Version: 1.0
File Name: youth_splash_functions.js
Associated File: volunteer_form.php
                youth_form.php
*/
// on click, displays results summary for youth splash page
document.getElementById("summary-button").onclick = toggleSummary;
function toggleSummary() {
    document.getElementById("summary-button").style.display = "none";
    document.getElementById("summary").style.display = "block";
} 
