## File Descriptions

<details>
  <summary>success_splash_functions.js</summary>
    <p>File controls the toggle functionality of the success page for both volunteer sign up and dreamer sign up.
    </p>

+ Quick File Relations:
	+ volunteer_success_splash_page.php -   uses the function for toggle the summary view
	+ youth_success_splash.php - uses the function for toggle the summary view
+ Functions:
	+ toggleSummary()
     
</details>



<details>
  <summary>validation_functions.js</summary>
    <p>File contains functions for client side validation for Volunteer and Dreamer forms. If either form is incorrectly filled out, these functions will give the user visual indications where they need to fix their inputs in order to successfully submit their sign up form.
    </p>

+ Quick File Relations:
	+ youth_functions.js - gets client side validation from validation_functions.js
	+ volunteer_functions.js - gets client side validation from validation_functions.js
	+ youth_form.php - gets client side validation from validation_functions.js
	+ volunteer_form.php - gets client side validation from validation_functions.js
+ Functions:
    + validatePhone(1x)
    + validateEmpty(1x)
    + validateEmail(1x)
    + validateZip()
    + validateTshirt()
    + validateGender()
    + validateEthnicity()
    + validateGraduation()
    + validateDOB()
   + isEmpty(1x)

</details>



<details>
  <summary>youth_functions.js</summary>
    <p>File contains functions for validating the Dreamer Form input client side. When the dreamer submits their form, the form will be validated first, if it passes then the form is submitted, if it does not pass all validation requirements then the form will not be submitted and the dreamer will be allowed to fix their submission mistakes and try again.
    </p>

+ Quick File Relations:
    + validation_functions.js - provides client side validation on dreamer form
 
+ Functions:
    + validateForm

</details>



<details>
  <summary>volunteer_functions.js</summary>
    <p>File contains functions for validating the Volunteer Form input client side. When the volunteer submits their form, the form will be validated first, if it passes then the form is submitted, if it does not pass all validation requirements then the form will not be submitted and the volunteer will be allowed to fix their submission mistakes and try again.
    </p>

+ Quick File Relations:
    + validation_functions.js - provides client side validation on volunteer form
 
+ Functions:
    + displayDecline
    + displayForm
    + toggleWeekendExplanation
    + toggleInterestExplanation
    + toggleYouthExplanationShow
    + toggleYouthExplanationHide
    + validateForm

</details>


<details>
  <summary>index_page_functions.js</summary>
    <p>This file contains the action for the #auto-login-button on click event.
If the user still has a valid 'session' from logging into their admin user portal then if they end up back on the index page they can automatically log in.

If the user has logged out of the admin portal and then tries to log back in from index.php then instead of automatically logging them in they have the modal pop up to enter credentials.

This file also contains code that handles modal closures with sensitive login data.
When the user navigates away from the modal their username and password inputs are deleted as well as any error texts held in the #error-login span.
    </p>

+ Quick File Relations:
	+ index.php – uses index_page_functions events

</details>



<details>
  <summary>admin_page_functions.js</summary>
    <p>File contains the admin page's main functionality. It adds the clickable events on the page such as opening a user modal, updating the user's information, sending emails, toggling between different types and status of users.
    </p>

+ Quick File Relations:
 	+ admin_page.php - uses event functions made in admin page funcitons javascript
 	+ validation_functions.js - uses formatting and validation
 	+ logout.php - uses logout button functions
 	+ init.php - all 'required once' files
 + Functions:
 	+ addEditEvents()
 	+ addClickEvents()
 	+ populateModalData(1x)
 	+ getUpdateData(1x)
 	+ tableName(1x)
 	+ formatHeadings(1x)
 	+ tableSelected()
 	+ formatDate(1x)
 	+ formatYear(1x)
 	+ formatPhone(1x)
 	+ validateDate(1x)
 	+ validatePhone(1x)
 	+ validateYear(1x)

</details>
