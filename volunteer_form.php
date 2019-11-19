<?php
require_once "private/init.php";
?>

<!DOCTYPE html>
<!--
    Authors: Shayna Jamieson, Bridget Black, Keller Flint
    2019-10-02
    Last Updated: 2019-11-12
    Version: 1.0
    File Name: volunteer_form.php
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Volunteer - iD.A.Y.Dream</title>

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
<div class="jumbotron d-flex align-items-center">
    <div class="container">
        <h1 id="volunteer-title">VOLUNTEER</h1>
    </div>
</div> <!-- ending section for the jumbotron -->

<div class="container" id="background-check-container">
    <h3 id="bgc-sentence1">To volunteer with iD.A.Y.DREAM you must undergo a background check.</h3>
    <h4>Are you willing to have a background check?</h4>

    <div class="row" id="background-check-buttons">
        <div class="col-6 text-center">
            <button class="btn btn-lg" type="button" id="bg-check-btn-yes">YES</button>
        </div>
        <div class="col-6 text-center">
            <button class="btn btn-lg" type="button" id="bg-check-btn-no">NO</button>
        </div>
    </div> <!-- end of row that has background check buttons -->
</div>
<!-- end of container that holds the background check section -->

<div class="container" id="bg-check-no-container">
    <h2 id="bg-check-explain-no">Because of our values as an organization and out of the safety of the youth we serve it
        is a requirement that a background check must be submitted. You have chosen to decline. Thank you for your
        consideration in volunteering with iD.A.Y.Dream, at this time we are unable to move forward with your
        submission.<br>Please do visit us again!</h2>
    <button class="btn btn-go-home" id="go-home" href="#">I D.A.Y. DREAM HOME PAGE</button>
</div> <!-- end of container that holds the information for if user selects no to background check -->
<div class="container" id="entire-form-container">
    <form id="volunteer-form" action="volunteer_success_splash_page.php" method="post">
        <!--Contact Information-->
        <fieldset class="form-group input">
            <div class="container legend-container">
                <h2 class="legend-text">Contact Information</h2>
            </div>
            <div class="row">
                <div class="col-md-6 padding">
                    <label for="fname" class="col-form-label"><em>*</em> First</label>
                    <input type="text" class="form-control" id="fname" name="first-name" placeholder="">
                    <span id="err-fname" class="d-none">please enter a valid first name</span>
                </div>
                <div class="col-md-6 padding">
                    <label for="lname" class="col-form-label"><em>*</em> Last</label>
                    <input type="text" class="form-control" id="lname" name="last-name" placeholder="">
                    <span id="err-lname" class="d-none">please enter a valid last name</span>
                </div>
            </div> <!-- end of row with full name -->
            <div class="row">
                <div class="col-12 padding">
                    <label for="street-address" class="col-form-label"><em>*</em> Street Address</label>
                    <input type="text" class="form-control" id="street-address" name="address" placeholder="">
                    <span id="err-street-address" class="d-none">please enter a valid address</span>
                </div>
            </div> <!-- end of row with address-->
            <div class="row">
                <div class="col-md-4 padding">
                    <label for="zip" class="col-form-label"><em>*</em> ZIP</label>
                    <input type="text" class="form-control" id="zip" name="zip" placeholder="">
                    <span id="err-zip" class="d-none">please enter a valid zip code</span>
                </div> <!-- end of column with zip information -->
                <div class="col-md-4 padding">
                    <label for="city" class="col-form-label"><em>*</em> City</label>
                    <input type="text" class="form-control" name="city" id="city" placeholder="">
                    <span id="err-city" class="d-none">please enter a valid city name</span>
                </div> <!-- end of column with city information -->
                <div class="col-md-4 padding">
                    <label for="state" class="col-form-label"><em>*</em> State</label>
                    <select class="custom-select" name="state" id="state">
                        <option selected value="WA">WA</option>
                        <option value="CA">CA</option>
                        <option value="OR">OR</option>
                    </select>
                </div> <!-- end of column with state information -->
            </div> <!-- end of row with zip, city, state content -->
            <div class="row">
                <div class="col-md-4 padding">
                    <label for="email" class="col-form-label"><em>*</em> Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="">
                    <span id="err-email" class="d-none">please enter a valid email</span>
                </div>
                <div class="col-md-4 padding">
                    <label for="phone" class="col-form-label"><em>*</em> Phone</label>
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
                </div>
            </div> <!-- end of row with phone number entry and email -->
            <div class="row">

            </div> <!-- end of row with select a t-shirt size -->
        </fieldset> <!-- end of fieldset with initial user information name, email, t-shirt, etc -->
        <fieldset class="form-group">
            <div class="container legend-container">
                <h2 class="legend-text">Interests & Availability</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="about-us" class="col-form-label">How did you hear about us?</label>
                    <div class="input-group">
                        <textarea class="form-control" id="about-us" placeholder="" name="about" rows="3"></textarea>
                    </div>
                </div>
            </div> <!-- end of row that has the how did you hear about us text box -->
            <div class="row">
                <div class="col-md-6">
                    <label class="col-form-label">I would like to help...</label>
                    <span class="hide-me" id="where-to-help">Please select one of the ways you'd like to help:</span>
                    <?php
                    $result = findInterests();
                    while ($event = mysqli_fetch_assoc($result)) { ?>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="events[]" value="<?php echo  $event["interest_id"] . $event["interest_name_of_interest"];?>"
                                   id="<?php echo $event["interest_name_of_interest"];?>">
                            <label class="custom-control-label" for="<?php echo $event["interest_name_of_interest"];?>"><?php echo $event["interest_name_of_interest"];?></label>
                        </div> <!-- end of div that has the mentoring check box -->
                    <?php } ?>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="events[]" value="Other"
                               id="other-interest">
                        <label class="custom-control-label" for="other-interest">Other</label>
                    </div>
                    <br> <!-- end of div that has the mentoring check box -->
                    <div id="toggle-other-interests">
                        <label for="other-interests-explanation"><em>*</em> Please explain other areas of
                            interest:</label>
                        <div class="input-group">
                            <textarea class="form-control" id="other-interests-explanation" name="interests-explain"
                                      placeholder=""></textarea>
                        </div> <!-- area where the user explains their other interests if chosen other -->
                    </div>
                    <br> <!-- end of div that holds the toggle for if user needs to explain their interests -->
                </div> <!-- end of row that holds the events and activities check boxes -->
                <div class="col-md-6">
                    <label class="col-form-label">My availability is...</label>
                    <span class="hide-me" id="i-can-help">Please select when you can help:</span>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" value="weekend-availability"
                               name="availability[]" id="weekend-availability">
                        <label class="custom-control-label" for="weekend-availability">Weekends</label>
                    </div> <!-- end of div that has the weekend check box -->
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" value="summer-camp" name="availability[]"
                               id="summer-camp">
                        <label class="custom-control-label" for="summer-camp">Summer Camp (1 week)</label>
                    </div>
                    <br> <!-- end of div that has the summer camp check box -->
                    <div id="toggle-weekend-availability">
                        <label for="weekend-availability-explanation"><em>*</em> Please list weekend dates/times that
                            you are available:</label>
                        <div class="input-group">
                            <textarea class="form-control" id="weekend-availability-explanation"
                                      name="availability-explain" placeholder=""></textarea>
                        </div> <!-- area where the user explains their other interests if chosen other -->
                    </div> <!-- end of div that holds the toggle for if user needs to explain their interests -->
                </div>
            </div> <!-- end of row that holds the columns for choosing availability and areas of interest -->
        </fieldset> <!-- end of fieldset that contains Interests section -->
        <fieldset class="form-group">
            <div class="container legend-container">
                <h2 class="legend-text">Skills & Qualifications</h2>
            </div>
            <label for="motivation"><em>*</em> Why are you motivated to work with us?</label>
            <div class="input-group">
                <textarea class="form-control" id="motivation" name="motivation" placeholder=""></textarea>
            </div> <!-- end of text area for why they are motivated to work for us -->
            <span id="err-motivation" class="d-none">please describe your motivation for working with us</span><br>
            <label for="volunteer-experience">Describe your previous volunteer experience:</label>
            <div class="input-group">
                <textarea class="form-control" id="volunteer-experience" name="volunteer-experience"
                          placeholder=""></textarea>
            </div>
            <br> <!-- end of text area for if they have previous volunteer experience -->
            <label>Do you have previous work experience with youth organizations?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="youth-experience" id="youth-experience-yes"
                       value="yes">
                <label class="form-check-label" for="youth-experience-yes">Yes</label>
            </div> <!-- end of div for checkbox of if they have experience with youth "yes" -->
            <div class="form-check">
                <input class="form-check-input" type="radio" name="youth-experience" id="youth-experience-no"
                       value="no">
                <label class="form-check-label" for="youth-experience-no">No</label>
            </div> <!-- end of div for checkbox of if they have experience with youth "no"  -->
            <div id="toggle-please-explain"><br>
                <label for="youth-experience-explanation">Please elaborate on your work with youth:</label>
                <div class="input-group">
                    <textarea class="form-control" id="youth-experience-explanation" name="youth-experience-explanation"
                              placeholder=""></textarea>
                </div> <!-- area where the user explains the volunteer experience that they have with youth -->
            </div>
            <br> <!-- end of div that holds the toggle for if user needs to explain their youth volunteer experience -->
            <label for="other-experience">Any other skills or qualifications you would like to list:</label>
            <div class="input-group">
                <textarea class="form-control" id="other-experience" name="other-experience" placeholder=""></textarea>
            </div> <!-- end of div for user listing any other skills or qualifications that they have -->
        </fieldset> <!-- end of fieldset that contains skills and qualification information -->
        <fieldset class="form-group">
            <div class="container legend-container">
                <h2 class="legend-text">Character References</h2>
            </div>
            <h4 class="ref-title"><em>*</em> Reference 1</h4>
            <div id="container-for-ref-1">
                <div class="row">
                    <div class="col-md-6">
                        <label for="ref-name-1" class="col-form-label char-ref-bg1">Full Name</label>
                        <input type="text" class="form-control" id="ref-name-1" name="reference-name-1" placeholder="">
                    </div>
                    <div class="col-md-6">
                        <label for="ref-relationship-1" class="col-form-label char-ref-bg1">Relationship</label>
                        <input type="text" class="form-control" id="ref-relationship-1" name="reference-relationship-1"
                               placeholder="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="ref-email-1" class="col-form-label char-ref-bg1">Email</label>
                        <input type="text" class="form-control" id="ref-email-1" name="reference-email-1"
                               placeholder="">
                    </div>
                    <div class="col-md-6">
                        <label for="ref-phone-1" class="col-form-label char-ref-bg1">Phone</label>
                        <input type="text" class="form-control" id="ref-phone-1" name="reference-phone-1"
                               placeholder="">
                    </div>
                </div>
            </div>
            <br> <!--  end of a single char reference-->
            <h4 class="ref-title"><em>*</em> Reference 2</h4>
            <div id="container-for-ref-2">
                <div class="row">
                    <div class="col-md-6">
                        <label for="ref-name-2" class="col-form-label char-ref-bg2">Full Name</label>
                        <input type="text" class="form-control" id="ref-name-2" name="reference-name-2" placeholder="">
                    </div>
                    <div class="col-md-6">
                        <label for="ref-relationship-2" class="col-form-label char-ref-bg2">Relationship</label>
                        <input type="text" class="form-control" id="ref-relationship-2" name="reference-relationship-2"
                               placeholder="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="ref-email-2" class="col-form-label char-ref-bg2">Email</label>
                        <input type="text" class="form-control" id="ref-email-2" name="reference-email-2"
                               placeholder="">
                    </div>
                    <div class="col-md-6">
                        <label for="ref-phone-2" class="col-form-label char-ref-bg2">Phone</label>
                        <input type="text" class="form-control" id="ref-phone-2" name="reference-phone-2"
                               placeholder="">
                    </div>
                </div>
            </div>
            <br> <!--  end of a single char reference -->
            <h4 class="ref-title"><em>*</em> Reference 3</h4>
            <div id="container-for-ref-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="ref-name-3" class="col-form-label char-ref-bg3">Full Name</label>
                        <input type="text" class="form-control" id="ref-name-3" name="reference-name-3" placeholder="">
                    </div>
                    <div class="col-md-6">
                        <label for="ref-relationship-3" class="col-form-label char-ref-bg3">Relationship</label>
                        <input type="text" class="form-control" id="ref-relationship-3" name="reference-relationship-3"
                               placeholder="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="ref-email-3" class="col-form-label char-ref-bg3">Email</label>
                        <input type="text" class="form-control" id="ref-email-3" name="reference-email-3"
                               placeholder="">
                    </div>
                    <div class="col-md-6">
                        <label for="ref-phone-3" class="col-form-label char-ref-bg3">Phone</label>
                        <input type="text" class="form-control" id="ref-phone-3" name="reference-phone-3"
                               placeholder="">
                    </div>
                </div>
            </div> <!--  end of a single char reference-->
        </fieldset> <!-- end of fieldset that contains the character references information  -->
        <fieldset class="form-group">
            <div class="container legend-container">
                <h2 class="legend-text">Mailing List</h2>
            </div>
            <label>Would you like to be added to our mailing list?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="mailing-list" id="mailing-list-yes" value="yes"
                       checked>
                <label class="form-check-label" for="mailing-list-yes">Yes</label>
            </div> <!-- end of div for "yes" to mailing list check -->
            <div class="form-check">
                <input class="form-check-input" type="radio" name="mailing-list" id="mailing-list-no" value="no">
                <label class="form-check-label" for="mailing-list-no">No</label>
            </div> <!-- end of div for "no" to mailing list check -->
        </fieldset> <!-- end of fieldset that contains mailing list information -->
        <fieldset class="form-group">
            <div class="container legend-container">
                <h2 class="legend-text">E-Signature</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <label class="col-form-label" id="submit-policy">By submitting this application, I affirm that the
                        facts set forth in it are true and complete. I understand that if I am accepted as a volunteer,
                        any false statements, omissions, or other misrepresentations made by me on this application may
                        result in my immediate dismissal.</label>
                </div>
            </div> <!-- end of row that contains our signature explanation -->
            <div class="row">
                <div class="col-12">
                    <!--form-check form-check-inline  for div and for input form-check-input  and for label  col-form-label -->
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="information-is-true"
                               name="terms-of-service" value="true">
                        <label class="custom-control-label" for="information-is-true">I agree to the Terms and
                            Conditions</label>
                    </div>
                </div>
            </div> <!-- end of row that has the checkbox for agreeing to terms and conditions  -->
            <div class="row" id="row-holds-submit-button">
                <div class="col text-center">
                    <button class="btn btn-lg" type="submit" id="submit-btn">SUBMIT</button>
                </div>
            </div> <!-- end of row that has our submit button -->
        </fieldset> <!-- end of fieldset that contains electronic signature, and acceptance of policy -->
    </form> <!-- end of the entire form that the user fills out -->
</div> <!--    end of entire body div  -->
<footer id="footer"></footer>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
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
