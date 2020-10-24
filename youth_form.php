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
    <title>Dreamer Interest Form - iD.A.Y.Dream</title>
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
            <h1 id="youth-volunteer-title">DREAMER INTEREST FORM</h1>
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
                    <input type="text" class="form-control" id="email" name="email" placeholder="">
                    <span id="err-email" class="d-none">please enter a valid email</span>
                </div>
                <div class="col-md-6 padding">
                    <label for="phone" class="col-form-label"><em>*</em> Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="">
                    <span id="err-phone" class="d-none">please enter a valid phone number</span>
                </div>
            </div> <!-- end of row that asks for the users email and phone number -->

            <!-- College and Graduation Year -->
            <div class="row">
                <div class="col-md-6 padding">
                    <label for="college-interest" class="col-form-label">College of Interest <span id="college-dream">- Dream big!</span></label>
                    <input type="text" class="form-control" id="college-interest" name="college-Interest" placeholder="">
                </div>
                <div class="col-md-6 padding">
                    <label for="graduation-year" class="col-form-label"><em>*</em> High School Graduation Year</label>
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
                    <span id="err-graduation-year" class="d-none">please select a graduation year</span>
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
                            <p id="youth-age">Youth members must be ages 10-19</p>
                            <span id="err-dob" class="d-none">please enter a valid date of birth</span>
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
                            <span id="err-gender" class="d-none">please select a gender</span>
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
                    <span id="err-ethnicity" class="d-none">please select an ethnicity</span>
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
                    <label for="fav-snacks" class="col-form-label">What are some of your favorite foods and snacks?</label>
                    <div class="input-group">
                        <textarea class="form-control" id="fav-snacks" name="fav-Snacks" placeholder="" rows="3"></textarea>
                    </div>
                </div>
            </div> <!-- end of row that has the user list their favorite snacks and foods  -->

            <!-- Career Aspirations -->
            <div class="row">
                <div class="col-md-12 padding">
                    <label for="aspirations" class="col-form-label">What are your dream careers and future goals?</label>
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
                    <label for="guardian-phone" class="col-form-label"><em>*</em> Guardian Phone Number</label>
                    <input type="text" class="form-control" id="guardian-phone" name="guardian-Phone" placeholder="">
                    <span id="err-guardian-phone" class="d-none">please enter a valid guardian phone</span>
                </div>
            </div> <!-- end of row that has guardian email and phone -->

            <!-- Address -->
            <div class="row">
                <div class="col-12 padding">
                    <label for="street-address" class="col-form-label"><em>*</em> Street Address</label>
                    <input type="text" class="form-control" id="street-address" name="address" placeholder="">
                    <span id="err-street-address" class="d-none">please enter a valid address</span>
                </div>
            </div> <!-- end of row with address-->
            <!-- Zip, City, State -->
            <div class="row">
                <div class="col-md-4 padding">
                    <label for="zip" class="col-form-label"><em>*</em> Zip Code</label>
                    <input type="text" class="form-control" id="zip" name="zip" placeholder="">
                    <span id="err-zip" class="d-none">please enter a valid zip code</span>
                </div> <!-- end of column with zip information -->
                <div class="col-md-4 padding">
                    <label for="city" class="col-form-label"><em>*</em> City</label>
                    <input type="text" class="form-control" name="city" id="city" placeholder="">
                    <span id="err-city" class="d-none">please enter a valid city</span>
                </div> <!-- end of column with city information -->
                <div class="col-md-4 padding">
                    <label for="state" class="col-form-label"><em>*</em> State</label>
                    <select class="custom-select" name="state" id="state">
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District Of Columbia</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA" selected>Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                    </select>
                </div> <!-- end of column with state information -->
            </div> <!-- end of row with zip, city, state content -->
            <div>
                <label for="highest-education" class="col-form-label"><em>*</em> Highest Education</label>
                <select class="custom-select" id="highest-education" name="highest-education">
                    <option selected value="" id="highest-none">select</option>
                    <option value="High School or Equivalent">High School or Equivalent</option>
                    <option value="Some College">Some College</option>
                    <option value="Associate Degree">Associate Degree</option>
                    <option value="Bachelor Degree">Bachelor Degree</option>
                    <option value="Master Degree">Master Degree</option>
                    <option value="Doctorate Degree">Doctorate Degree</option>
                    <option value="Prefer Not to Say">Prefer Not to Say</option>
                </select>
                <span id="err-education" class="d-none">please select highest education</span>
            </div>
            <br>
            <label>Does the student have any allergies?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="student-allergies" id="student-allergies-yes"
                       value="yes">
                <label class="form-check-label" for="student-allergies-yes">Yes</label>
            </div> <!-- end of div for checkbox of if student have allergies "yes" -->
            <div class="form-check">
                <input class="form-check-input" type="radio" name="student-allergies" id="student-allergies-no"
                       value="no">
                <label class="form-check-label" for="student-allergies-no">No</label>
            </div> <!-- end of div for checkbox of if student have allergies "no"  -->
            <div id="toggle-allergy-explain"><br>
                <label for="student-allergies-explanation">Please list student's allergies:</label>
                <div class="input-group">
                        <textarea class="form-control" id="student-allergies-explanation"
                                  name="student-allergies-explanation"
                                  placeholder=""></textarea>
                </div> <!-- area where the user explains the student allergies -->
            </div>
            <br>
            <label>Will the student have reliable transportation for mandated events?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="student-transportation" id="student-transportation-yes"
                       value="yes">
                <label class="form-check-label" for="student-transportation-yes">Yes</label>
            </div> <!-- end of div for checkbox of if student have transportation "yes" -->
            <div class="form-check">
                <input class="form-check-input" type="radio" name="student-transportation" id="student-transportation-no"
                       value="no">
                <label class="form-check-label" for="student-transportation-no">No</label>
            </div> <!-- end of div for checkbox of if student have transportation "no"  -->

            <br>
            <label>Are you willing to participate in family schedule events?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="participate-events" id="participate-events-yes"
                       value="yes">
                <label class="form-check-label" for="participate-events-yes">Yes</label>
            </div> <!-- end of div for checkbox of if willing to participate in events "yes" -->
            <div class="form-check">
                <input class="form-check-input" type="radio" name="participate-events" id="participate-events-no"
                       value="no">
                <label class="form-check-label" for="participate-events-no">No</label>
            </div> <!-- end of div for checkbox of if willing to participate in events "no" -->

            <br>
            <label>Do you see your family relocating in the next four years?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="family-relocating" id="family-relocating-yes"
                       value="yes">
                <label class="form-check-label" for="family-relocating-yes">Yes</label>
            </div> <!-- end of div for checkbox if family relocating in next 4 years "yes" -->
            <div class="form-check">
                <input class="form-check-input" type="radio" name="family-relocating" id="family-relocating-no"
                       value="no">
                <label class="form-check-label" for="family-relocating-no">No</label>
            </div> <!-- end of div for checkbox if family relocating in next 4 years"no" -->

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
