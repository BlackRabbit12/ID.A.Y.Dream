<?php
/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-10-16
 * Last Update: 2019-12-09
 * File Name: youth_form.php
 * Associated Files:
 *      css/youth_styles.css
 *      @link https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css
 *      images/apple-touch-icon.png
 *      images/favicon-32x32_title.png
 *      images/favicon-16x16_title.png
 *      images/site.webmanifest_title
 *      @link https://code.jquery.com/jquery-1.12.4.js
 *      @link https://code.jquery.com/ui/1.12.1/jquery-ui.js
 *      @link https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js
 *      @link https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js
 *      @link https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js
 *      scripts/validation_functions.js
 *      scripts/youth_functions.js
 *
 * Description:
 *      File contains iD.A.Y.Dream Youth Organization's Dreamer (aka youth) Sign Up Form. Interested youth fill out
 *      this form and are entered into the database for admin to contact the potential dreamer's parent/guardian for
 *      sign up consent, and then 'activate' the dreamer.
 *      This form collects minimal personal data.
 *      Quick File Relations:
 *          youth_styles.css - styles for form
 *          youth_functions.js - validate form on submit
 *          validation_functions.js - client side validation
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Youth - iD.A.Y.Dream</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/youth_styles.css" type="text/css">
    <!-- https://favicon.io/emoji-favicons/blue-heart/ -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32_title.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16_title.png">
    <link rel="manifest" href="images/site.webmanifest_title">
</head>
<body>
    <!-- Jumbotron -->
    <div class="jumbotron d-flex align-items-center">
        <div class="container">
            <h1 id="youth-volunteer-title">YOUTH SIGN-UP</h1>
        </div>
    </div> <!-- ending section for the jumbotron -->

    <!-- Youth sign up banner over jumbotron -->
    <div class="container" id="container-form-intro">
        <h3 class="form-intro" id="form-intro-1">Looking to get involved?</h3>
        <h3 class="form-intro" id="form-intro-2">Tell us about yourself!</h3>
    </div> <!-- end banner -->

    <!-- Form -->
    <div class="container" id="form-container">
        <form id="youth-form" action="youth_success_splash.php" method="post">

            <!-- First and Last Name -->
            <div class="row">
                <div class="col-md-6 padding">
                    <label for="fname" class="col-form-label"><em>*</em> First</label>
                    <input type="text" class="form-control" id="fname" name="first-Name" placeholder="">
                    <span id="err-fname" class="d-none">please enter a valid first name</span>
                </div> <!-- end of  div that holds the first name row -->
                <div class="col-md-6 padding">
                    <label for="lname" class="col-form-label"><em>*</em> Last</label>
                    <input type="text" class="form-control" id="lname" name="last-Name" placeholder="">
                    <span id="err-lname" class="d-none">please enter a valid last name</span>
                </div>
            </div> <!-- end of row that asks for the users first and last names -->

            <!-- Email and Phone -->
            <div class="row">
                <div class="col-md-6 padding">
                    <label for="email" class="col-form-label"><em>*</em> Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="someone@example.com">
                    <span id="err-email" class="d-none">please enter a valid email</span>
                </div>
                <div class="col-md-6 padding">
                    <label for="phone" class="col-form-label"><em>*</em> Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="(123) 456-7890">
                    <span id="err-phone" class="d-none">please enter a valid phone number</span>
                </div>
            </div> <!-- end of row that asks for the users email and phone number -->

            <!-- College and Graduation Year -->
            <div class="row">
                <div class="col-md-6 padding">
                    <label for="college-interest" class="col-form-label">College of Interest</label>
                    <input type="text" class="form-control" id="college-interest" name="college-Interest" placeholder="">
                </div>
                <div class="col-md-6 padding">
                    <label for="graduation-year" class="col-form-label"><em>*</em> Graduation Year</label>
                    <select class="custom-select" id="graduation-year" name="graduation-Year">
                        <option selected id="graduation-none" value="">select</option>
                        <?php
                        /**
                         * Increments graduation dates to keep relevant options available to dreamers.
                         */
                        for ($i = 0; $i < 10; $i++) {
                            $date = date("Y") + $i;
                            echo "<option value=\"$date\">$date</option>";
                        }
                        ?>
                    </select>
                </div>
            </div> <!-- end of row that asks for the users college of interest and graduation year  -->

            <!-- DOB, Gender, and Ethnicity -->
            <div class="row">
                <div class="col-md-6 padding">
                    <!-- DOB, Gender -->
                    <div class="row">
                        <div class="col-md-6 padding">
                            <label for="dob" class="col-form-label"><em>*</em> Date of Birth</label>
                            <input type="text" class="form-control" id="dob" name="dob" placeholder="MM/DD/YYYY">
                            <span id="err-dob" class="d-none">invalid date of birth</span>
                        </div>
                        <div class="col-md-6 padding">
                            <label for="gender" class="col-form-label"><em>*</em> Gender</label>
                            <select class="custom-select" id="gender" name="gender">
                                <option selected value="" id="gender-none">select</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                                <option value="prefer-not-to-say">Prefer Not to Say</option>
                            </select>
                            <span id="err-gender" class="d-none">please select an option</span>
                        </div>
                    </div> <!--   end of inception row that contains the birthday and gender selections -->
                </div>
                <!-- Ethnicity -->
                <div class="col-md-6 padding">
                    <label for="ethnicity" class="col-form-label"><em>*</em> Ethnicity</label>
                    <select class="custom-select" id="ethnicity" name="ethnicity">
                        <option selected id="ethnicity-none" value="">select</option>
                        <option value="American Indian or Alaska Native">American Indian or Alaska Native</option>
                        <option value="Asian or Asian American">Asian or Asian American</option>
                        <option value="Black or African American">Black or African American</option>
                        <option value="Hispanic or Latino/a/x">Hispanic or Latino/a/x</option>
                        <option value="Hispanic or Latino/a/x">Middle Eastern or MENA</option>
                        <option value="Native Hawaiian or Other Pacific Islander">Native Hawaiian or Other Pacific
                            Islander
                        </option>
                        <option value="Southeast Asian">Southeast Asian</option>
                        <option value="White non-Hispanic">White non-Hispanic</option>
                        <option value="Bi/Multiracial">Bi/Multiracial</option>
                        <option value="Other" id="select-ethnicity-other">Other</option>
                        <option value="Prefer Not to Say">Prefer Not to Say</option>
                    </select>
                    <span id="err-ethnicity" class="d-none">please select an option</span>
                </div> <!-- end of row that asks for the user's  and ethnicity -->
            </div> <!-- end of row that asks for the user's birth date, gender, and ethnicity -->

            <!-- Ethnicity 'Other' toggle, hidden to start -->
            <div id="toggle-ethnicity-other">
                <label for="ethnicity-other">Ethnicity Other: please explain</label>
                <div class="input-group">
                    <input class="form-control" id="ethnicity-other" name="ethnicity-Other" placeholder="">
                </div>
            </div> <!-- end of row that hides the ethnicity 'other' -->

            <!-- Favorite Snacks -->
            <div class="row">
                <div class="col-md-12 padding">
                    <label for="fav-snacks" class="col-form-label">What are some of your favorite food/snacks?</label>
                    <div class="input-group">
                        <textarea class="form-control" id="fav-snacks" name="fav-Snacks" placeholder="" rows="3"></textarea>
                    </div>
                </div>
            </div> <!-- end of row that has the user list their favorite snacks and foods  -->

            <!-- Career Aspirations -->
            <div class="row">
                <div class="col-md-12 padding">
                    <label for="aspirations" class="col-form-label">What are your career aspirations and goals?</label>
                    <div class="input-group">
                        <textarea class="form-control" id="aspirations" name="aspirations" placeholder=""
                                  rows="3"></textarea>
                    </div>
                </div>
            </div> <!-- end of row that has the user list their career aspirations -->

            <!-- Parent Guardian Information -->
            <h3 class="mb-4">Parent/Guardian Information</h3>
            <!-- Guardian First, Guardian Last, Guardian Relationship -->
            <div class="row">
                <div class="col-md-4 padding">
                    <label for="guardian-fName" class="col-form-label"><em>*</em> Guardian First</label>
                    <input type="text" class="form-control" id="guardian-fName" name="guardian-First-Name" placeholder="">
                    <span id="err-guardian-fName" class="d-none">please enter a valid guardian first name</span>
                </div>
                <div class="col-md-4 padding">
                    <label for="guardian-lName" class="col-form-label"><em>*</em> Guardian Last</label>
                    <input type="text" class="form-control" id="guardian-lName" name="guardian-Last-Name" placeholder="">
                    <span id="err-guardian-lName" class="d-none">please enter a valid guardian last name</span>
                </div>
                <div class="col-md-4 padding">
                    <label for="guardian-relationship" class="col-form-label"><em>*</em> Guardian Relationship</label>
                    <input type="text" class="form-control" id="guardian-relationship" name="guardian-Relationship" placeholder="">
                    <span id="err-guardian-relationship" class="d-none">please enter a valid guardian relationship</span>
                </div>
            </div> <!-- end of row that has the guardian first name, last name, and relationship -->

            <!-- Guardian Email, Guardian Phone -->
            <div class="row">
                <div class="col-md-6 padding">
                    <label for="guardian-email" class="col-form-label"><em>*</em> Guardian Email</label>
                    <input type="text" class="form-control" id="guardian-email" name="guardian-Email" placeholder="">
                    <span id="err-guardian-email" class="d-none">please enter a valid guardian email</span>
                </div>
                <div class="col-md-6 padding">
                    <label for="guardian-phone" class="col-form-label"><em>*</em> Guardian Phone</label>
                    <input type="text" class="form-control" id="guardian-phone" name="guardian-Phone" placeholder="">
                    <span id="err-guardian-phone" class="d-none">please enter a valid guardian phone</span>
                </div>
            </div> <!-- end of row that has guardian email and phone -->

            <!-- Submit button -->
            <div class="row" id="row-holds-submit-button">
                <div class="col text-center">
                    <button class="btn btn-lg" type="submit" id="submit-btn">SUBMIT</button>
                </div>
            </div> <!-- end of row that has our submit button -->
        </form> <!-- end of youth volunteer form -->
    </div> <!-- end of container that holds the form -->

    <!-- footer inside body tag -->
    <footer></footer>


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Optional JavaScript -->
    <!-- Then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <!-- jQuery for input validation -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="scripts/validation_functions.js"></script>
    <script src="scripts/youth_functions.js"></script>
</body>

</html>