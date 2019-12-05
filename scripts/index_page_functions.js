/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-12-05
 * Last Update: 2019-12-05
 * File name: index_page_functions.js
 * Associated Files:
 *      index.php
 *
 * Description:
 *      This file contains the action for the #auto-login-button on click event
 *      If the user still has a valid 'session' from logging into their admin user portal
 *      then if they end up back on the index page they can automatically log in.
 *
 *      If the user has logged out of the admin portal and then tries to log back in from index.php
 *      then instead of automatically logging them in they have the modal pop up to enter credentials.
 */

$('#auto-login-button').on('click', function(){
    window.location.href = 'admin_page.php';
});