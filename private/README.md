## File Descriptions

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
