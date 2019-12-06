/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-10-29
 * Last Update: 2019-11-12
 * File name: success_splash_functions.js
 * Associated Files:
 *      volunteer_form.php
 *      youth_form.php
 *
 * Description:
 *      File contains **********************************************************************************
 */

// on click, displays results summary for youth splash page
document.getElementById("summary-button").onclick = toggleSummary;
function toggleSummary() {
    document.getElementById("summary-button").style.display = "none";
    document.getElementById("click-to-see").style.display = "none";
    document.getElementById("summary").style.display = "block";
} 
