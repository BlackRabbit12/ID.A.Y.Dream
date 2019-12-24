<?php
/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2019-10-02
 * Last Updated: 2019-12-09
 * File Name: volunteer_form.php
 * Associated Files:
 *      css/styles.css
 *      @link https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css
 *      images/apple-touch-icon.png
 *      images/favicon-32x32_title.png
 *      images/favicon-16x16_title.png
 *      images/site.webmanifest_title
 *      @link https://code.jquery.com/jquery-1.12.4.js
 *      @link https://code.jquery.com/ui/1.12.1/jquery-ui.js
 *      @link https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js
 *      @link https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js
 *      scripts/validation_functions.js
 *      scripts/volunteer_functions.js
 *      @link https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js
 *      private/init.php
 *
 * Description:
 *      File contains iD.A.Y.Dream Youth Organization's Volunteer Sign Up Form. Interested volunteers fill out
 *      this form and are entered into the database for admin to run a background check and then 'activate' the
 *      volunteer.
 *      This form collects sensitive data and is a consent for background check.
 *      Quick File Relations:
 *          styles.css - styles for form
 *          validation_functions.js - client side validation
 *          volunteer_functions.js - validate form on submit
 *          init.php - all 'require once' files
 */
require_once "private/init.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Volunteer Sign-Up - iD.A.Y.Dream</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css" type="text/css">
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
        <h1 id="volunteer-title">VOLUNTEER SIGN-UP</h1>
    </div>
</div> <!-- ending section for the jumbotron -->

<!-- Background Check Container -->
<div class="container" id="background-check-container">
    <h3 id="bgc-sentence1">To volunteer with iD.A.Y.Dream you must undergo a background check.</h3>
    <h4>Are you willing to complete a background check?</h4>
    <!-- Background Check Buttons -->
    <div class="row" id="background-check-buttons">
        <div class="col-6 text-center">
            <button class="btn btn-lg" type="button" id="bg-check-btn-yes">YES</button>
        </div>
        <div class="col-6 text-center">
            <button class="btn btn-lg" type="button" id="bg-check-btn-no">NO</button>
        </div>
    </div> <!-- end of row that has background check buttons -->
</div> <!-- end of container that holds the background check section -->

<!-- Background Check 'No' Container -->
<div class="container" id="bg-check-no-container">
    <h2 id="bg-check-explain-no">Because of our values as an organization and out of the safety of the youth we serve, it
        is a requirement that a background check must be submitted. You have chosen to decline. Thank you for your
        consideration in volunteering with iD.A.Y.Dream, at this time we are unable to move forward with your
        submission.<br>Please do visit us again!</h2>
    <button class="btn btn-go-home" id="go-home">I D.A.Y. DREAM HOME PAGE</button>
</div> <!-- end of container that holds the information for if user selects no to background check -->

<!-- Form Container -->
<div class="container" id="entire-form-container">
    <!-- Form -->
    <form id="volunteer-form" action="volunteer_success_splash_page.php" method="post">

        <!--Contact Information-->
        <fieldset class="form-group input">
            <div class="container legend-container">
                <h2 class="legend-text">Contact Information</h2>
            </div>
            <!-- First, Last -->
            <div class="row">
                <div class="col-md-6 padding">
                    <label for="fname" class="col-form-label"><em>*</em> First</label>
                    <input type="text" class="form-control" id="fname" name="first-Name" placeholder="">
                    <span id="err-fname" class="d-none">please enter a valid first name</span>
                </div>
                <div class="col-md-6 padding">
                    <label for="lname" class="col-form-label"><em>*</em> Last</label>
                    <input type="text" class="form-control" id="lname" name="last-Name" placeholder="">
                    <span id="err-lname" class="d-none">please enter a valid last name</span>
                </div>
            </div> <!-- end of row with full name -->
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
            <!-- Email, Phone, T-shirt -->
            <div class="row">
                <div class="col-md-4 padding">
                    <label for="email" class="col-form-label"><em>*</em> Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="">
                    <span id="err-email" class="d-none">please enter a valid email</span>
                </div>
                <div class="col-md-4 padding">
                    <label for="phone" class="col-form-label"><em>*</em> Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="">
                    <span id="err-phone" class="d-none">please enter a valid phone number</span>
                </div>
                <div class="col-md-4 padding">
                    <label for="t-shirt" class="col-form-label"><em>*</em> T-Shirt Size</label>
                    <select class="custom-select" id="t-shirt" name="shirt">
                        <option selected value="" id="t-shirt-none">Adult Unisex</option>
                        <option value="small">Small</option>
                        <option value="medium">Medium</option>
                        <option value="large">Large</option>
                        <option value="xLarge">X-Large</option>
                    </select>
                    <span id="err-t-shirt" class="d-none">please select a t-shirt size</span>
                </div>
            </div> <!-- end of row with phone number entry and email -->

            <!-- Separation of sections -->
            <div class="row"></div>
        </fieldset> <!-- end of fieldset with initial user information name, email, t-shirt, etc -->

        <!-- Interests & Availability -->
        <fieldset class="form-group">
            <div class="container legend-container">
                <h2 class="legend-text">Interests & Availability</h2>
            </div>
            <!-- How Did You Hear About Us -->
            <div class="row">
                <div class="col-12">
                    <label for="about-us" class="col-form-label">How did you hear about us?</label>
                    <div class="input-group">
                        <textarea class="form-control" id="about-us" placeholder="" name="about" rows="3"></textarea>
                    </div>
                </div>
            </div> <!-- end of row that has the how did you hear about us text box -->
            <!-- Interests and Available times -->
            <div class="row">
                <div class="col-md-6">
                    <label class="col-form-label">I would like to be involved with:</label>
                    <span class="hide-me" id="where-to-help">Please select one of the ways you'd like to help:</span>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="events[]" value="Events/Activities"
                               id="Events-Activities">
                        <label class="custom-control-label" for="Events-Activities">Events/Activities</label>
                    </div> <!-- end of div that has the Events/Activities check box -->
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="events[]" value="Fundraising"
                               id="Fundraising">
                        <label class="custom-control-label" for="Fundraising">Fundraising</label>
                    </div> <!-- end of div that has the Fundraising check box -->
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="events[]"
                               value="Newsletter Production"
                               id="Newsletter-Production">
                        <label class="custom-control-label" for="Newsletter-Production">Newsletter Production</label>
                    </div> <!-- end of div that has the Newsletter Production check box -->
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="events[]"
                               value="Volunteer Coordination"
                               id="Volunteer-Coordination">
                        <label class="custom-control-label" for="Volunteer-Coordination">Volunteer Coordination</label>
                    </div> <!-- end of div that has the Volunteer Coordination check box -->
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="events[]" value="Mentoring"
                               id="Mentoring">
                        <label class="custom-control-label" for="Mentoring">Mentoring</label>
                    </div> <!-- end of div that has the Mentoring check box -->
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="events[]" value="Other"
                               id="other-interest">
                        <label class="custom-control-label" for="other-interest">Other</label>
                    </div> <!-- end of div that has the other check box -->
                    <br>
                    <div id="toggle-other-interests">
                        <label for="other-interests-explanation"><em>*</em> Please explain other areas of
                            interest:</label>
                        <div class="input-group">
                                <textarea class="form-control" id="other-interests-explanation" name="interests-Explain"
                                          placeholder=""></textarea>
                        </div> <!-- area where the user explains their other interests if chosen other -->
                        <span id="err-other-interests-explanation" class="d-none">please describe other areas of interest</span>
                    </div>
                    <br> <!-- end of div that holds the toggle for if user needs to explain their interests -->
                </div> <!-- end of row that holds the events and activities check boxes -->
                <div class="col-md-6">
                    <label class="col-form-label">I am available for:</label>
                    <span class="hide-me" id="i-can-help">Please select when you can help:</span>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" value="Weekends"
                               name="availability[]" id="weekend-availability">
                        <label class="custom-control-label" for="weekend-availability">Weekend Events</label>
                    </div> <!-- end of div that has the weekend check box -->
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" value="Summer camp" name="availability[]"
                               id="summer-camp">
                        <label class="custom-control-label" for="summer-camp">Summer Camp (1 week durations)</label>
                    </div>
                    <br> <!-- end of div that has the summer camp check box -->
                    <div id="toggle-weekend-availability">
                        <label for="weekend-availability-explanation"><em>*</em> Please list weekend dates and times that
                            you are available:</label>
                        <div class="input-group">
                                <textarea class="form-control" id="weekend-availability-explanation"
                                          name="availability-Explain" placeholder=""></textarea>
                        </div> <!-- area where the user explains their other interests if chosen other -->
                        <span id="err-weekend-availability-explanation" class="d-none">please enter at least 1 weekend availability</span>
                    </div> <!-- end of div that holds the toggle for if user needs to explain their interests -->
                </div>
            </div> <!-- end of row that holds the columns for choosing availability and areas of interest -->
        </fieldset> <!-- end of fieldset that contains Interests section -->

        <!-- Skills & Qualifications -->
        <fieldset class="form-group">
            <div class="container legend-container">
                <h2 class="legend-text">Skills & Qualifications</h2>
            </div>
            <label for="motivation"><em>*</em> Why are you motivated to work with us?</label>
            <div class="input-group">
                <textarea class="form-control" id="motivation" name="motivation" placeholder=""></textarea>
            </div> <!-- end of text area for why they are motivated to work for us -->
            <span id="err-motivation" class="d-none">please describe your motivation for working with us</span><br>
            <label for="volunteer-experience">Describe any previous volunteer experience:</label>
            <div class="input-group">
                    <textarea class="form-control" id="volunteer-experience" name="volunteer-Experience"
                              placeholder=""></textarea>
            </div>
            <br> <!-- end of text area for if they have previous volunteer experience -->
            <label>Do you have previous work experience with youth organizations?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="youth-Experience" id="youth-experience-yes"
                       value="yes">
                <label class="form-check-label" for="youth-experience-yes">Yes</label>
            </div> <!-- end of div for checkbox of if they have experience with youth "yes" -->
            <div class="form-check">
                <input class="form-check-input" type="radio" name="youth-Experience" id="youth-experience-no"
                       value="no">
                <label class="form-check-label" for="youth-experience-no">No</label>
            </div> <!-- end of div for checkbox of if they have experience with youth "no"  -->
            <div id="toggle-please-explain"><br>
                <label for="youth-experience-explanation">Please elaborate on your work with youth organizations:</label>
                <div class="input-group">
                        <textarea class="form-control" id="youth-experience-explanation"
                                  name="youth-Experience-Explanation"
                                  placeholder=""></textarea>
                </div> <!-- area where the user explains the volunteer experience that they have with youth -->
            </div>
            <br> <!-- end of div that holds the toggle for if user needs to explain their youth volunteer experience -->
            <label for="other-experience">Other skills or qualifications that you would like us to be aware of:</label>
            <div class="input-group">
                <textarea class="form-control" id="other-experience" name="other-Skills" placeholder=""></textarea>
            </div> <!-- end of div for user listing any other skills or qualifications that they have -->
        </fieldset> <!-- end of fieldset that contains skills and qualification information -->

        <!-- Contacts -->
        <fieldset class="form-group">
            <div class="container legend-container">
                <h2 class="legend-text">Character References</h2>
            </div>
            <h4 class="ref-title"><em>*</em> Reference 1</h4>
            <div id="container-for-ref-1">
                <div class="row">
                    <div class="col-md-6">
                        <label for="ref-name-1" class="col-form-label char-ref-bg1">Full Name</label>
                        <input type="text" class="form-control" id="ref-name-1" name="reference-Name-1" placeholder="">
                        <span id="err-ref-name-1" class="d-none">please enter a valid reference name</span>
                    </div>
                    <div class="col-md-6">
                        <label for="ref-relationship-1" class="col-form-label char-ref-bg1">Relationship</label>
                        <input type="text" class="form-control" id="ref-relationship-1" name="reference-Relationship-1"
                               placeholder="">
                        <span id="err-ref-relationship-1" class="d-none">please enter a valid reference relationship</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="ref-email-1" class="col-form-label char-ref-bg1">Email</label>
                        <input type="text" class="form-control" id="ref-email-1" name="reference-Email-1"
                               placeholder="">
                        <span id="err-ref-email-1" class="d-none">please enter a valid reference email</span>
                    </div>
                    <div class="col-md-6">
                        <label for="ref-phone-1" class="col-form-label char-ref-bg1">Phone Number</label>
                        <input type="text" class="form-control" id="ref-phone-1" name="reference-Phone-1"
                               placeholder="">
                        <span id="err-ref-phone-1" class="d-none">please enter a valid reference phone number</span>
                    </div>
                </div>
            </div>
            <br> <!--  end of a single char reference-->
            <h4 class="ref-title"><em>*</em> Reference 2</h4>
            <div id="container-for-ref-2">
                <div class="row">
                    <div class="col-md-6">
                        <label for="ref-name-2" class="col-form-label char-ref-bg2">Full Name</label>
                        <input type="text" class="form-control" id="ref-name-2" name="reference-Name-2" placeholder="">
                        <span id="err-ref-name-2" class="d-none">please enter a valid reference name</span>
                    </div>
                    <div class="col-md-6">
                        <label for="ref-relationship-2" class="col-form-label char-ref-bg2">Relationship</label>
                        <input type="text" class="form-control" id="ref-relationship-2" name="reference-Relationship-2"
                               placeholder="">
                        <span id="err-ref-relationship-2" class="d-none">please enter a valid reference relationship</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="ref-email-2" class="col-form-label char-ref-bg2">Email</label>
                        <input type="text" class="form-control" id="ref-email-2" name="reference-Email-2"
                               placeholder="">
                        <span id="err-ref-email-2" class="d-none">please enter a valid reference email</span>
                    </div>
                    <div class="col-md-6">
                        <label for="ref-phone-2" class="col-form-label char-ref-bg2">Phone Number</label>
                        <input type="text" class="form-control" id="ref-phone-2" name="reference-Phone-2"
                               placeholder="">
                        <span id="err-ref-phone-2" class="d-none">please enter a valid reference phone number</span>
                    </div>
                </div>
            </div>
            <br> <!--  end of a single char reference -->
            <h4 class="ref-title"><em>*</em> Reference 3</h4>
            <div id="container-for-ref-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="ref-name-3" class="col-form-label char-ref-bg3">Full Name</label>
                        <input type="text" class="form-control" id="ref-name-3" name="reference-Name-3" placeholder="">
                        <span id="err-ref-name-3" class="d-none">please enter a valid reference name</span>
                    </div>
                    <div class="col-md-6">
                        <label for="ref-relationship-3" class="col-form-label char-ref-bg3">Relationship</label>
                        <input type="text" class="form-control" id="ref-relationship-3" name="reference-Relationship-3"
                               placeholder="">
                        <span id="err-ref-relationship-3" class="d-none">please enter a valid reference relationship</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="ref-email-3" class="col-form-label char-ref-bg3">Email</label>
                        <input type="text" class="form-control" id="ref-email-3" name="reference-Email-3"
                               placeholder="">
                        <span id="err-ref-email-3" class="d-none">please enter a valid reference email</span>
                    </div>
                    <div class="col-md-6">
                        <label for="ref-phone-3" class="col-form-label char-ref-bg3">Phone Number</label>
                        <input type="text" class="form-control" id="ref-phone-3" name="reference-Phone-3"
                               placeholder="">
                        <span id="err-ref-phone-3" class="d-none">please enter a valid reference phone number</span>
                    </div>
                </div>
            </div> <!--  end of a single char reference-->
        </fieldset> <!-- end of fieldset that contains the character references information  -->

        <!-- Mailing List -->
<!-- HOLDING OFF ON INCLUDING THE YES/NO FOR MAILING LIST -->
<!-- Brandi doesn't send many news letters so there is no need for this option -->
<!--        <fieldset class="form-group">-->
<!--            <div class="container legend-container">-->
<!--                <h2 class="legend-text">Mailing List</h2>-->
<!--            </div>-->
<!--            <label>Would you like to be added to our mailing list?</label>-->
<!--            <div class="form-check">-->
<!--                <input class="form-check-input" type="radio" name="mailing-List" id="mailing-list-yes" value="yes"-->
<!--                       checked>-->
<!--                <label class="form-check-label" for="mailing-list-yes">Yes</label>-->
<!--            </div> end of div for "yes" to mailing list check -->
<!--            <div class="form-check">-->
<!--                <input class="form-check-input" type="radio" name="mailing-List" id="mailing-list-no" value="no">-->
<!--                <label class="form-check-label" for="mailing-list-no">No</label>-->
<!--            </div>  end of div for "no" to mailing list check -->
<!--        </fieldset>  end of fieldset that contains mailing list information -->

        <!-- E-Signature -->
        <fieldset class="form-group">
            <div class="container legend-container">
                <h2 class="legend-text">Terms and Conditions</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <label class="col-form-label" id="submit-policy">By submitting this application, I certify that my statements in this application are true, complete and correct to the best of my knowledge. I further understand that as a part of the volunteer verification and matching process, additional personal information will be required of me. I hereby authorize iD.A.Y.dream to contact the references listed and to conduct a background check to determine if I will be a good fit as a volunteer for the organization. I understand that submitting this application does not guarantee my participation. I also hereby authorize iD.A.Y.dream without limitation, to copy, publish, exhibit or distribute photographs or video tapes of my volunteer activities for the purpose of promoting volunteerism and support. I release and hold harmless from liability any person or organization that provides information. I also agree to hold harmless iD.A.Y.dream and the officers and volunteers thereof.</label>
                </div>
            </div> <!-- end of row that contains our signature explanation -->
            <!-- since getting new terms and conditions we don't actually need to display checkbox -->
            <div class="row d-none">
                <div class="col-12">
                    <!--form-check form-check-inline  for div and for input form-check-input  and for label  col-form-label -->
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="information-is-true"
                               name="terms-of-Service" value="agreed" checked>
                        <label class="custom-control-label" for="information-is-true">I have read and agree to the statement above.</label>
                    </div>
                </div>
            </div> <!-- end of row that has the checkbox for agreeing to terms and conditions  -->
            <div class="row" id="row-holds-submit-button">
                <div class="col text-center">
                    <button class="btn btn-lg" type="submit" id="submit-btn">SUBMIT</button>
                </div>
            </div> <!-- end of row that has our submit button -->
        </fieldset> <!-- end of fieldset that contains electronic signature, and acceptance of policy -->
    </form> <!-- end of Form -->
</div> <!--    end of Form Container  -->

<!-- Footer -->
<footer id="footer"></footer>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Optional JavaScript -->
<!-- Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<script src="scripts/validation_functions.js"></script>
<script src="scripts/volunteer_functions.js"></script>
<!-- jQuery for input validation -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>