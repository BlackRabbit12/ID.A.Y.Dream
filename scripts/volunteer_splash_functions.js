/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-10-29
 * Last Update: 2019-11-12
 * File name: volunteer_splash_functions.js
 * Associated Files:
 *      volunteer_form.php
 *
 * Description:
 *      File contains **********************************************************************************
 */

// on splash page, clicking button displays summary of information to user
document.getElementById("summary-button").onclick = toggleSummary;
function toggleSummary() {
    document.getElementById("summary-button").style.display = "none";
    document.getElementById("click-to-see-volunteer").style.display = "none";
    document.getElementById("summary").style.display = "block";
}
