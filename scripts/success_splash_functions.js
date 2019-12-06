/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-10-29
 * Last Update: 2019-12-05
 * File name: success_splash_functions.js
 * Associated Files:
 *      volunteer_success_splash_page.php
 *      youth_success_splash.php
 *
 * Description:
 *      File controls the toggle functionality of the success page for both volunteer sign up and dreamer sign up.
 *      Functions:
 *          toggleSummary()
 */

// on click, displays results summary for youth splash page
document.getElementById("summary-button").onclick = toggleSummary;

/**
 * Toggles the button that allows the summary to be seen or not.
 */
function toggleSummary() {
    document.getElementById("summary-button").style.display = "none";
    document.getElementById("click-to-see").style.display = "none";
    document.getElementById("summary").style.display = "block";
} //end toggleSummary()
