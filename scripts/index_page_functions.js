/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-12-05
 * Last Update: 2019-12-09
 * File name: index_page_functions.js
 * Associated Files:
 *      private/index.php
 *
 * Description:
 *      This file contains the action for the #auto-login-button on click event
 *      If the user still has a valid 'session' from logging into their admin user portal
 *      then if they end up back on the index page they can automatically log in.
 *
 *      If the user has logged out of the admin portal and then tries to log back in from index.php
 *      then instead of automatically logging them in they have the modal pop up to enter credentials.
 *
 *      This file also contains code that handles modal closures with sensitive login data.
 *      When the user navigates away from the modal their username and password inputs are deleted
 *      as well as any error texts held in the #error-login span.
 *
 *      Quick File Relations:
 *          index.php - uses index_page_functions events
 */

$('#auto-login-button').on('click', function(){
    window.location.href = 'admin_page.php';
});

$('#loginModal').on('hidden.bs.modal', function () {
    $('#error-login').html("");
    window.location.href = 'index.php';
});

/*
 * This is a helper check that if the admin user hits refresh while they have the login modal open
 * (after they have tried to enter invalid data) -- that the chrome error message does not pop up
 * 'Confirm form resubmission'.
 */
// *** with more sensitive data/more users this error check should be commented out ***
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}