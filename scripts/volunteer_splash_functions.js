/*
Authors: Shayna Jamieson, Bridget Black, Keller Flint
2019-10-29
Last Update: 2019-10-29
Version: 1.0
File Name: volunteer_splash_functions.js
Associated File: volunteer_form.html
                youth_form.html
*/
// on splash page, clicking button displays summary of information to user
document.getElementById("summary-button").onclick = toggleSummary;
function toggleSummary() {
    document.getElementById("summary-button").style.display = "none";
    document.getElementById("summary").style.display = "block";
}
