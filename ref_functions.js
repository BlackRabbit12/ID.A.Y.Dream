/*
 * Server side validation
 */

document.getElementById('volunteer-form').onsubmit = validate;

function validate() {
    //set the validator to true, will only turn false if a field is incorrectly filled out
    let setTrue = true;

    /* ***FULL-NAME*** */
    let fullNameValue = document.forms["volunteer-form"]["full-name"].value;
    if (fullNameValue === ""){
        document.forms["volunteer-form"]["full-name"].focus();
        document.forms["volunteer-form"]["full-name"].style.borderBottom = "1px solid red";
        setTrue = false;
    } //end full-name

    /* ***STREET-ADDRESS*** */
    let streetAddressValue = document.forms["volunteer-form"]["street-address"].value;
    if(streetAddressValue === ""){
        document.forms["volunteer-form"]["street-address"].focus();
        document.forms["volunteer-form"]["street-address"].style.borderBottom = "1px solid red";
        setTrue = false;
    } //end street-address

    /* ***ZIP*** */
    let zipValue = document.forms["volunteer-form"]["zip"].value;
    if(zipValue === ""){
        document.forms["volunteer-form"]["zip"].focus();
        document.forms["volunteer-form"]["zip"].style.borderBottom = "1px solid red";
        setTrue = false;
    } //end zip

    /* ***CITY*** */
    let cityValue = document.forms["volunteer-form"]["city"].value;
    if(cityValue === ""){
        document.forms["volunteer-form"]["city"].focus();
        document.forms["volunteer-form"]["city"].style.borderBottom = "1px solid red";
        setTrue = false;
    } //end city

    /* ***STATE*** */
    let stateValue = document.getElementById('state');
    stateValue = stateValue.options[stateValue.selectedIndex].value;
    if(stateValue === ""){
        document.forms["volunteer-form"]["state"].focus();
        document.forms["volunteer-form"]["state"].classList.add("red-border-drop");
        setTrue = false;
    } //end state

    /* ***PHONE*** */
    let phoneValue = document.forms["volunteer-form"]["phone"].value;
    if(phoneValue === ""){
        document.forms["volunteer-form"]["phone"].focus();
        document.forms["volunteer-form"]["phone"].style.borderBottom = "1px solid red";
        setTrue = false;
    } //end phone

    /* ***EMAIL*** */
    let emailValue = document.forms["volunteer-form"]["email"].value;
    if(emailValue === ""){
        document.forms["volunteer-form"]["email"].focus();
        document.forms["volunteer-form"]["email"].style.borderBottom = "1px solid red";
        setTrue = false;
    } //end email

    /* ***T-SHIRT*** */
    let tShirtValue = document.getElementById('t-shirt');
    tShirtValue = tShirtValue.options[tShirtValue.selectedIndex].value;
    if(tShirtValue === ""){
        document.forms["volunteer-form"]["t-shirt"].focus();
        document.forms["volunteer-form"]["t-shirt"].classList.add("red-border-drop");
        setTrue = false;
    } //end t-shirt

    /* ***ABOUT-US*** */
    let aboutUsValue = document.forms["volunteer-form"]["about-us"].value;
    if(aboutUsValue === ""){
        document.forms["volunteer-form"]["about-us"].focus();
        document.forms["volunteer-form"]["about-us"].style.borderBottom = "1px solid red";
        setTrue = false;
    } //end about-us

    /* ***EVENTS, FUNDRAISING, NEWSLETTER, VOLUNTEER, MENTORING*** */
    let eventsValue = document.forms["volunteer-form"]["events"].checked;
    let fundraisingValue = document.forms["volunteer-form"]["fundraising"].checked;
    let newsletterValue = document.forms["volunteer-form"]["newsletter"].checked;
    let volunteerValue = document.forms["volunteer-form"]["volunteer"].checked;
    let mentoringValue = document.forms["volunteer-form"]["mentoring"].checked;
    if(!eventsValue && !fundraisingValue && !newsletterValue && !volunteerValue && !mentoringValue) {
        document.forms["volunteer-form"]["events"].focus();
        /* **********SOME STYLE TO INDICATE THE ERROR****************************************** */
        setTrue = false;
    } //end events, fundraising, newsletter, volunteer, mentoring

    /* ***WEEKEND-4HR, WEEKEND-8HR, WEEKEND-WORKSHOP, SUMMER-CAMP, ON-GOING*** */
    let weekend4HrValue = document.forms["volunteer-form"]["weekend-4hr"].checked;
    let weekend8HrValue = document.forms["volunteer-form"]["weekend-8hr"].checked;
    let weekendWorkshopValue = document.forms["volunteer-form"]["weekend-workshop"].checked;
    let summerCampValue = document.forms["volunteer-form"]["summer-camp"].checked;
    let onGoingValue = document.forms["volunteer-form"]["on-going"].checked;
    if(!weekend4HrValue && !weekend8HrValue && !weekendWorkshopValue && !summerCampValue && !onGoingValue){
        document.forms["volunteer-form"]["weekend-4hr"].focus();
        /* **********SOME STYLE TO INDICATE THE ERROR****************************************** */
        setTrue = false;
    }

    /* ***MOTIVATION*** */
    let motivationValue = document.forms["volunteer-form"]["motivation"].value;
    if(motivationValue === ""){
        document.forms["volunteer-form"]["motivation"].focus();
        document.forms["volunteer-form"]["motivation"].style.borderBottom = "1px solid red";
        setTrue = false;
    } //end motivation

    /* ***VOLUNTEER-EXPERIENCE*** */
    let volunteerExperienceValue = document.forms["volunteer-form"]["volunteer-experience"].value;
    if(volunteerExperienceValue === ""){
        document.forms["volunteer-form"]["volunteer-experience"].focus();
        document.forms["volunteer-form"]["volunteer-experience"].style.borderBottom = "1px solid red";
        setTrue = false;
    } //end volunteer-experience

    /* ***YOUTH-EXPERIENCE*** */
    /********************FINISH radio button */

    /* ***YOUTH-EXPERIENCE-EXPLANATION*** */
    /*not required as of 2019-10-15 */

    /* ***OTHER-EXPERIENCE*** */
    /*not required as of 2019-10-15 */

    /* ***REF-NAME-1*** */
    let refName1Value = document.forms["volunteer-form"]["ref-name-1"].value;
    if(refName1Value === ""){
        document.forms["volunteer-form"]["ref-name-1"].focus();
        document.forms["volunteer-form"]["ref-name-1"].style.borderBottom = "1px solid red";
        setTrue = false;
    } //end ref-name-1

    /* ***REF-EMAIL-1*** */
    let refEmail1Value = document.forms["volunteer-form"]["ref-email-1"].value;
    if(refEmail1Value === ""){
        document.forms["volunteer-form"]["ref-email-1"].focus();
        document.forms["volunteer-form"]["ref-email-1"].style.borderBottom = "1px solid red";
        setTrue = false;
    } //end ref-email-1

    /* ***REF-RELATIONSHIP-1*** */
    let refRelationship1Value = document.forms["volunteer-form"]["ref-relationship-1"].value;
    if(refRelationship1Value === ""){
        document.forms["volunteer-form"]["ref-relationship-1"].focus();
        document.forms["volunteer-form"]["ref-relationship-1"].style.borderBottom = "1px solid red";
        setTrue = false;
    } //end ref-relationship-1

    /* ***REF-NAME-2*** */
    let refName2Value = document.forms["volunteer-form"]["ref-name-2"].value;
    if(refName2Value === ""){
        document.forms["volunteer-form"]["ref-name-2"].focus();
        document.forms["volunteer-form"]["ref-name-2"].style.borderBottom = "1px solid red";
        setTrue = false;
    } //end ref-name-2

    /* ***REF-EMAIL-2*** */
    let refEmail2Value = document.forms["volunteer-form"]["ref-email-2"].value;
    if(refEmail2Value === ""){
        document.forms["volunteer-form"]["ref-email-2"].focus();
        document.forms["volunteer-form"]["ref-email-2"].style.borderBottom = "1px solid red";
        setTrue = false;
    } //end ref-email-2

    /* ***REF-RELATIONSHIP-2*** */
    let refRelationship2Value = document.forms["volunteer-form"]["ref-relationship-2"].value;
    if(refRelationship2Value === ""){
        document.forms["volunteer-form"]["ref-relationship-2"].focus();
        document.forms["volunteer-form"]["ref-relationship-2"].style.borderBottom = "1px solid red";
        setTrue = false;
    } //end ref-relationship-2

    /* ***REF-NAME-3*** */
    let refName3Value = document.forms["volunteer-form"]["ref-name-3"].value;
    if(refName3Value === ""){
        document.forms["volunteer-form"]["ref-name-3"].focus();
        document.forms["volunteer-form"]["ref-name-3"].style.borderBottom = "1px solid red";
        setTrue = false;
    } //end ref-name-3

    /* ***REF-EMAIL-3*** */
    let refEmail3Value = document.forms["volunteer-form"]["ref-email-3"].value;
    if(refEmail3Value === ""){
        document.forms["volunteer-form"]["ref-email-3"].focus();
        document.forms["volunteer-form"]["ref-email-3"].style.borderBottom = "1px solid red";
        setTrue = false;
    } //end ref-email-3

    /* ***REF-RELATIONSHIP-3*** */
    let refRelationship3Value = document.forms["volunteer-form"]["ref-relationship-3"].value;
    if(refRelationship3Value === ""){
        document.forms["volunteer-form"]["ref-relationship-3"].focus();
        document.forms["volunteer-form"]["ref-relationship-3"].style.borderBottom = "1px solid red";
        setTrue = false;
    } //end ref-relationship-3

    /* ***BG-CHECK*** */
    /********************FINISH radio button */

    /* ***MAILING-LIST*** */
    /********************FINISH radio button */

    /* ***INFORMATION-IS-TRUE*** */
    let informationIsTrueValue = document.forms["volunteer-form"]["information-is-true"].checked;
    if(!informationIsTrueValue){
        document.forms["volunteer-form"]["weekend-4hr"].focus();
        /* **********SOME STYLE TO INDICATE THE ERROR****************************************** */
        setTrue = false;
    } //end information-is-true

    /* ***SIGN-NAME*** */
    let signNameValue = document.forms["volunteer-form"]["sign-name"].value;
    if(signNameValue === ""){
        document.forms["volunteer-form"]["sign-name"].focus();
        document.forms["volunteer-form"]["sign-name"].style.borderBottom = "1px solid red";
        setTrue = false;
    } //end sign-name

    /* ***DATEPICKER*** */
    /********************FINISH date */

    //return setTrue;
    return setTrue;
} //end fucntion validation()