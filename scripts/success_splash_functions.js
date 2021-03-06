/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-10-29
 * Last Update: 2019-12-09
 * File name: success_splash_functions.js
 * Associated Files:
 *      volunteer_success_splash_page.php
 *      youth_success_splash.php
 *
 * Description:
 *      File controls the toggle functionality of the success page for both volunteer sign up and dreamer sign up.
 *      Quick File Relations:
 *          volunteer_success_splash_page.php - uses the function for toggle the summary view
 *          youth_success_splash.php - uses the function for toggle the summary view
 *      Functions:
 *          toggleSummary()
 */

/**
 * if the user clicks on the events button they are taken to Brandi's events page
 */
$("#events-button").on("click", function() {
    window.open("https://www.idaydream.org/events", "_blank");
});

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
