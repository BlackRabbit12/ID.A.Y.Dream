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
</details>


<details>
  <summary>youth_form.php</summary>
    <p>File contains iD.A.Y.Dream Youth Organization's Dreamer (aka youth) Sign Up Form. Interested youth fill out this form and are entered into the database for admin to contact the potential dreamer's parent/guardian for sign up consent, and then 'activate' the dreamer. This form collects minimal personal data.
  </p>
      
  + Quick File Relations:
     + youth_functions.js - validate form on submit
     + validation_functions.js - client side validation
       
</details>


<details>
  <summary>volunteer_success_splash_page.php</summary>
    <p>File contains iD.A.Y.Dream Youth Organization's summary of provided volunteer information. The volunteer will have filled out a Sign Up form and submitted it to the database. This page displays the information back to the volunteer for review and or personal records. This page also serves as an indicator that the volunteer's information was successfully inserted into the database.
    </p>
</details>

<details>
  <summary>youth_success_splash.php</summary>
    <p>File contains iD.A.Y.Dream Youth Organization's summary of provided dreamer information. The dreamer will have filled out a Sign Up form and submitted it to the database. This page displays the information back to the dreamer for review and or personal records. This page also serves as an indicator that the dreamer's information was successfully inserted into the database.
    </p>
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
  <summary><em>scripts</em></summary>

<details>
  <summary>success_splash_functions.js</summary>
    <p>File controls the toggle functionality of the success page for both volunteer sign up and dreamer sign up.
    </p>
  
  + Functions:
     + toggleSummary()
     
</details>

<details>
  <summary>validation_functions.js</summary>
    <p>File contains functions for client side validation for Volunteer and Dreamer forms. If either form is incorrectly filled out, these functions will give the user visual indications where they need to fix their inputs in order to successfully submit their sign up form.
    </p>

+ Functions:
    + validatePhone
    + validateEmpty
    + validateEmail
    + validateZip
    + validateTshirt
    + validateGender
    + validateEthnicity
    + validateGraduation
    + validateDOB
   + isEmpty

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
</details>


<details>
 <summary><em>private</em></summary>

<details>
  <summary>functions.php</summary>
    <p>File contains functions to build the admin table (with appropriate formatting), the dropdown field inside the admin  table, and to build the summary pages.
</p>

+ Functions:
 	+ buildTable()
 	+ dropDownStatus()
 	+ formatHeadings()
 	+ formatSQLDate()
 	+ formatSQLPhone()
 	+ createSummary()
    
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
