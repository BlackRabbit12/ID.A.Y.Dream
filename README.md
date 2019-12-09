# :blue_heart: iD.A.Y.Dream :blue_heart: #
iD.A.Y.Dream is a non-profit Youth Organization that focuses on helping at risk youth self-actualize, to become their potentialities, through strong community bonds and resources. For more information about, or to become part of, the organization and the communities they are helping, please visit [idaydream.org](https://www.idaydream.org/).

## Authors
* Keller Flint-Blanchard - Github: https://github.com/kellerflint :trollface:
* Shayna Jamieson - Github: https://github.com/jamiesonshayna :sparkles:
* Bridget Black - Github: https://github.com/BlackRabbit12 :rabbit2:

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes only, you will not have access to iD.A.Y.Dream's internal database or organization details.
See deployment for notes on how to deploy a skeleton version of the project on a live system.

<details>
  <summary><strong>Prerequisite</strong></summary>
    <p>What things you need to install the software and how to install them:

```
IDE of chice (we used PhpStorm)
Docker (optional)
Server (remote host)
```
</p>
</details>

<details>
  <summary><strong>Installing</strong></summary>
    <p>This is a step by step that tells you how to get a development enviroment running on your local machine:

```
Step 1:  Install necessary applications
Step 2:  Clone the iD.A.Y.Dream repository into your own repository/IDE
Step 3:  Reconfigure login and database connection credentials
             * If using a remote host:
                 * Move files: db_connect.php, login_creds.php outside of your publicly available files (needs to be private)
                 * Inside file: init.php, update the file path
             * If using docker:
                 * Establish your dockerfile appropriately for database passwords: docker-compose.yml, Dockerfile
Step 4:  Ensure site functions as intended and that you have access to your own administration pages
Step 5:  Have fun changing and improving upon our work!
```
</p>
</details>

## File Descriptions
Summary of each file and it's function within the application:

<details>
  <summary>volunteer_form.php</summary>
    <p>File contains iD.A.Y.Dream Youth Organization's Volunteer Sign Up Form. Interested volunteers fill out this form and are entered into the database for admin to run a background check and then 'activate' the volunteer. This form collects sensitive data and is a consent for background check.
    </p>

+ Quick File Relations:
	+ styles.css – styles for form
	+ validation_functions.js – client side validation
	+ volunteer_functions.js – validate form on submit
	+ init.php – all ‘required once’ files

</details>



<details>
  <summary>youth_form.php</summary>
    <p>File contains iD.A.Y.Dream Youth Organization's Dreamer (aka youth) Sign Up Form. Interested youth fill out this form and are entered into the database for admin to contact the potential dreamer's parent/guardian for sign up consent, and then 'activate' the dreamer. This form collects minimal personal data.
    </p>

+ Quick File Relations:
	+ youth_styles.css – styles for form
	+ youth_functions.js - validate form on submit
	+ validation_functions.js - client side validation

</details>



<details>
  <summary>volunteer_success_splash_page.php</summary>
    <p>File contains iD.A.Y.Dream Youth Organization's summary of provided volunteer information. The volunteer will have filled out a Sign Up form and submitted it to the database. This page displays the information back to the volunteer for review and or personal records. This page also serves as an indicator that the volunteer's information was successfully inserted into the database.
    </p>

+ Quick File Relations:
	+ volunteer_form.php – on submit form, this page is generated
	+ styles.css – styles for summary
	+ success_splash_functions.js – toggle the summary display
	+ functions.php – create the summary
	+ validation_functions.php – format select data fields
	+ query_functions.php – inserts the volunteer into database
	+ init.php – all ‘require once’ files

</details>




<details>
  <summary>youth_success_splash.php</summary>
    <p>File contains iD.A.Y.Dream Youth Organization's summary of provided dreamer information. The dreamer will have filled out a Sign Up form and submitted it to the database. This page displays the information back to the dreamer for review and or personal records. This page also serves as an indicator that the dreamer's information was successfully inserted into the database.
    </p>

+ Quick File Relations:
	+ youth_form.php – on submit form, this page is generated
	+ youth_styles.css – styles for summary
	+ success_splash_functions.js – toggle the summary display
	+ functions.php – create the summary
	+ validation_functions.php – format select data fields
	+ query_functions.php – inserts the dreamer into database
	+ init.php – all ‘require once’ files

</details>




<details>
  <summary>admin_page.php</summary>
    <p>File contains iD.A.Y.Dream Youth Organization's Administration Page. Admin page is where any persons authorized to be 'admin' will be able to login, then view + edit + delete database entries. This page queries the database and populates tables for the selected member type (volunteer or dreamer), and the selected member status (active, inactive, pending). There is an 'email' button provided after selecting the member type desired, the email button will allow an admin to send an email to all 'active' members of the given type (volunteer or dreamer). When a member's row in the table is selected, the page will also query the database to populate that member's modal, with all of the selected member's information displayed inside. The admin will be allowed to 'edit' or 'delete' the member while viewing this modal. The tables are sort-able via column arrows and/or by the 'search' bar.
</p>

+ Quick File Relations:
 	+ functions.php - builds the admin table
 	+ admin_page_functions.js - populates the admin table user modal
 	+ ajax_functions.php - changes the table data based on current status query
 	+ validation_functions.js - for validating admin input
	+ index.php - for validating that the admin has logged in and can stay logged in

</details>



<details>
  <summary>index.php</summary>
    <p>File contains iD.A.Y.Dream Youth Organization's Admin Login page. Admin can use this page to go straight to a new volunteer or youth sign up form, or use their credentials to login and use the admin_page.php admin tools.
    </p>

+ Quick File Relations:
	+ index_styles.css - styles for log in page
 	+ login_creds.php - credentials for admin
 	+ admin_page.php - if credentials are good, redirect admin to admin_page

</details>




<details>
	<summary><em><strong>scripts</strong></em></summary>
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
</details>



<details>
	<summary><em><strong>private</strong></em></summary>
<details>
  <summary>functions.php</summary>
    <p>File contains functions to build the admin table (with appropriate formatting), the dropdown field inside the admin table, and to build the summary pages.
</p>

+ Quick File Relations:
	+ volunteer_success_splash_page.php - Uses summary created in functions.php
	+ youth_success_splash.php - Uses summary created in functions.php
	+ admin_page.php - Uses tables built in functions.php
+ Functions:
 	+ buildTable(3x)
 	+ dropDownStatus(1x)
 	+ formatHeadings(1x)
 	+ formatSQLDate(1x)
 	+ formatSQLPhone(1x)
 	+ createSummary(1x)
    
</details>


<details>
  <summary>validation_functions.php</summary>
    <p>File contains multiple validation functions.
    </p>

+ Quick File Relations:
	+ volunteer_success_splash_page.php - uses server side validation
	+ youth_success_splash.php - uses server side validation
+ Functions:
	+ hasLength(3x)
	+ isEmpty(1x)
	+ isNumeric(1x)
	+ requiredInputIsValid(1x)
	+ requiredTextareaIsValid(1x)
	+ inputIsValid(1x)
	+ textareaIsValid(1x)
	+ emailIsValid(1x)
	+ zipIsValid(1x)
	+ formatPhone(1x)
	+ phoneIsValid(1x)
	+ validateContact(1x)
	+ validateVolunteer(1x)
	+ validateDreamer(1x)
	+ validateUser(1x)
	+ validateDOB(1x)
	+ formatDOB(1x)
	+ validateGrad(1x)
	+ genderIsValid(1x)

</details>



<details>
  <summary>query_functions.php</summary>
    <p>File contains functionalism's for updating data in a table, inserting a dreamer and a volunteer into the database, deleting a user from the database.
    </p>

+ Quick File Relations:
	+ ajax_functions.php - uses updateData()
	+ validation_functions.php - validates User + Volunteer + Dreamer + Contact
+ Functions:
	+ updateData(3x)
	+ insertDreamer(3x)
	+ volunteerInsert(3x)
	+ deleteUser(1x)

</details>



<details>
  <summary>logout.php</summary>
    <p>This file contents is used to log the admin user out of the admin page and destroy sessions.
    </p>

+ Quick File Relations:
	+ admin_page_functions.js - contains logout button functions
	+ index.php - page logged out of

</details>



<details>
  <summary>login_creds.php</summary>
    <p>This file contains the login credentials for the admin page access. Currently we will only have one username and password that Brandi can use and share with whomever needs to give CRUD access to.
*** PLEASE NOTE : when uploading to the cPanel server this file needs to be transferred to a location behind the public html file area, credentials changed, and deleted from this project's private directory ***
    </p>

+ Quick File Relations:
	+ index.php – uses the credentials for login

</details>



<details>
  <summary>init.php</summary>
    <p>File contains required_once files used by associated files.
    </p>
</details>



<details>
  <summary>db_connect.php</summary>
    <p>Database connection file.
    </p>

+ Quick File Relations:
	+ init.php – allows other files to connect with db_connect.php

</details>



<details>
  <summary>ajax_functions.php</summary>
    <p>File contains several helper and stand-alone functionalism's for updating the status of a user via a dropdown on the admin tables, changing which status type user being viewed in the table, updates/edits utilizing ajax, delete user utilizing ajax, and changing email recipients.
    </p>

+ Quick File Relations:
	+ functions.php - build table
	+ query_functions.php - update data + delete users
	+ validation_functions.php - formatting
	+ admin_page_functions.js - formatting
	+ admin_page.php - makes queries that ajax functions responds to (table building)
	+ init.php - all 'required once' files
+ Functions:
	+ createAssociativeArray(2x)

</details>
</details>



<details>
	<summary><em><strong>db_scripts</strong></em></summary>
<details>
  <summary>db_schema.sql</summary>
    <p>This file contains tables for iD.A.Y.Dream Youth Organization's database. Table interactions are as such: All organization member's basic information is stored in the User table. Volunteers are Users with additional volunteer specific data, stored in the Volunteer table. Dreamers are Users with additional dreamer specific data, stored in the dreamer table. Contacts are either of type 'Reference' (tied to volunteers) or of type 'Guardian' (tied to dreamers).
 </p>

+ Volunteers have 3 references (required).
 + Dreamers have 1 guardian (1 required).
 
<p>Interest are the type of volunteer work a volunteer would like to do for the organization. Options include but are not limited to: 'Activities/Events', 'Fundraising', 'Other'. Volunteer_Interest is a linking table to allow one volunteer to have many interest (one-to-many).
</p>

+ Currently Unused:

<p>Chapter table will allow Admin to send pertinent information to appropriate volunteers and dreamers when sending 'newsletters', 'emails', 'etc'. User_Chapter is a linking table to allow one volunteer to belong to many chapters (one-to-many). There are 'Interest' descriptions to match interest_id, this allows many interests to be added or deleted for future management. (order corresponds to order listed in volunteer_form.php.
</p>

+ TODO Delete Sample Data When Live:
	+ Sample Users, Volunteers, Dreamers, Contacts are added for testing purposes only.

</details>
</details>



<details>
	<summary><em><strong>css</strong></em></summary>
<details>
  <summary>youth_styles.css</summary>
    <p>File contains iD.A.Y.Dream Youth Organization's associated files Bootstrap overrides and custom styles.
    </p>
</details>



<details>
  <summary>styles.css</summary>
    <p>File contains iD.A.Y.Dream Youth Organization's associated files Bootstrap overrides and custom styles.
    </p>
</details>


<details>
  <summary>index_styles.css</summary>
    <p>File contains iD.A.Y.Dream Youth Organization's Admin Login page's Bootstrap overrides and custom styles.
    </p>
</details>



<details>
  <summary>admin_styles.css</summary>
    <p>File contains CSS for the Admin Page's Bootstrap Overrides and custom styles.
    </p>
</details>
</details>


## Built With
* HTML5 + PHP - Scripting Languages of Choice
* JavaScript + jQuery - Dynamic Scripting Language(s) of Choice
* mySQL - Database Creation
* Ajax - Asynchronous Web Application
* CSS + Bootstrap - Responsive Framework
* Docker - Rapid Testing Enviroment
* Git - Version Control + Terminal
* cPanel - File Management(DBMS) + Deployment

## Versioning
This repository contains version 1.0 of this project. Further iterations of the project will be linked.
* Version 1.0 (As of 2019-12-04)

## Acknowledgments
* Brandi Day - Founder of iD.A.Y.Dream
* Tina Ostrander - Instructor of Web Development, Green River College
