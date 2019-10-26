/*
Authors: Shayna Jamieson, Bridget Black, Keller Flint
Version: 1.0
File Name: volunteer_functions.js
*/

/*
 * Question: Do you have previous work experience with youth organizations?
 * Gets both radio buttons 'Yes' and 'No', when they experience a change the function executes
 * var experienced gets the length of how many radio buttons are named 'youth-experience'
 * for loop walks through the length of the radio list, var showy gets the text area by it's
 *       div id "toggle-please-explain".
 *           If the second radio button 'yes' is checked then it turns the default div css
 *               from display: none to display: block
 *           If the first radio button 'no' is checked then it ensures the default div css
 *               is reinstated as display: none.
 */

$('input[name="youth-experience"]').on('change', function(){
    let experienced = document.getElementsByName('youth-experience');
    for (let i=0; i < experienced.length; i++) {
        let showy = document.getElementById("toggle-please-explain");
        if (experienced[i].checked){
            showy.style.display = 'block';
        }
        else {
            showy.style.display = 'none';
        }
    }
});

/*
 * Client side validation checks on all <input>, <select>, <textarea> elements
 * by capturing their respective value then sends the value to be client side validated
 * in another function
 */
$(document).ready(function(){
    /*
     * Looks at the <input> type 'text' as user inputs each 'keyup' and
     * client side validates
     */
    $("input[type='text']").keyup(function(event){
        let valueInputTarget = event.target;
        let valueInput = valueInputTarget.value;
        //whitespace is trimmed off the front and back of valueInput
        valueInput = ($.trim(valueInput));

        //if it's not empty then = true
        if (valueInput !== '') {
            //VALID INPUT, keep/change back to black border-bottom line
            valueInputTarget.style.borderBottom = "1px solid black";
        }
        else {
            // NOT VALID INPUT, change to red border-bottom line
            valueInputTarget.style.borderBottom = "1px solid red";
        }
    }); //end $("input[type='text']").keyup(function(event)

    /*
     * Looks at the <input> type 'textarea' as user inputs each 'keyup' and
     * client side validates
     */
    $("textarea").keyup(function(event){
        let valueTextTarget = event.target;
        let valueText = valueTextTarget.value;
        //whitespace is trimmed off the front and back of valueInput
        valueText = ($.trim(valueText));

        //if it's not empty then = true
        if (valueText !== '') {
            //VALID INPUT, keep/change back to black border-bottom line
            valueTextTarget.style.borderBottom = "1px solid black";
        }
        else {
            //NOT VALID, change to red border-bottom line
            valueTextTarget.style.borderBottom = "1px solid red";
        }
    }); //end $("textarea").keyup(function(event)

    /*
     * Looks at the <input> type 'checkbox' as user inputs each 'click'
     */
    $("input[type='checkbox']").click(function(event){
        let valueChecked = event.target;
        valueChecked = valueChecked.checked;
        console.log(valueChecked);
    }); //end $("input[type='checkbox']").click(function(event)

    /*
     * Looks at the <input> type 'radio' as a user inputs each 'click'
     */
    $("input[type='radio']").click(function(event){
        let valueButton = event.target;
        valueButton = valueButton.checked;
        console.log(valueButton);
    }); //end $("input[type='radio']").click(function(event)

    /*
     * Looks at the <select> <options> when a user chooses id="state" and
     * id="t-shirt" size drop down menus
     */
    $("select").on("change", function(event){
        let valueSelect = event.target;
        let valueOption = ($(this).find('option:selected').attr('value'));
        console.log(valueOption);

        //client side validate a state is chosen
        if (valueSelect.id === 'state') {
            if (valueOption === ''){
                valueSelect.classList.add("red-border-drop");
            }
            else {
                valueSelect.classList.remove("red-border-drop");
            }
        }
        //client side validate a t-shirt size is chosen
        else if (valueSelect.id === 't-shirt') {
            if (valueOption === ''){
                valueSelect.classList.add("red-border-drop");
            }
            else {
                valueSelect.classList.remove("red-border-drop");
            }
        }
    }); //end $("select").on("change", function(event)
}); //end $(document).ready(function()

/*
 * Clears Reference Fields when 'Clear' button is clicked
 */
$(".clear-reference").on("click", function() {
    $card = $(this).parent().parent().parent();
    $inputs = $card.find("input");
    for (let i = 0; i < $inputs.length; i++) {
        $inputs[i].value = "";
    }
}); //end $(".clear-reference").on("click", function()

// // ***********************LEAVE ALONE, WILL RECLAIM SOME LATER *************************
// // **************************** TEST LINE DELETE **************************************
// console.log(valueInput + " before loop");
// for (let i = 0; i < valueInput.length; i++) {
//     /*
//      * If it's purely alphabet then 'let valueInputAlphabet will not have any undefined characters
//      * and will pass the 'if' statement to validate all pure alphabet <input> type 'text' fields
//      */
//     let valueInputAlphabet = valueInput.toLowerCase();
//     if (valueInputAlphabet[i] === ' ' || valueInputAlphabet[i] === 'a' || valueInputAlphabet[i] === 'b' || valueInputAlphabet[i] === 'c' ||
//         valueInputAlphabet[i] === 'd' || valueInputAlphabet[i] === 'e' || valueInputAlphabet[i] === 'f' || valueInputAlphabet[i] === 'g' ||
//         valueInputAlphabet[i] === 'h' || valueInputAlphabet[i] === 'i' || valueInputAlphabet[i] === 'j' || valueInputAlphabet[i] === 'k' ||
//         valueInputAlphabet[i] === 'l' || valueInputAlphabet[i] === 'm' || valueInputAlphabet[i] === 'n' || valueInputAlphabet[i] === 'o' ||
//         valueInputAlphabet[i] === 'p' || valueInputAlphabet[i] === 'q' || valueInputAlphabet[i] === 'r' || valueInputAlphabet[i] === 's' ||
//         valueInputAlphabet[i] === 't' || valueInputAlphabet[i] === 'u' || valueInputAlphabet[i] === 'v' || valueInputAlphabet[i] === 'w' ||
//         valueInputAlphabet[i] === 'x' || valueInputAlphabet[i] === 'y' || valueInputAlphabet[i] === 'z') {
//         // **************************** TEST LINE DELETE *********************************
//         console.log(valueInput);
//     /*
//      * Else <input> type 'text' is not purely alphabet. We need to see if it's numeric [0-9]
//      * or if there are stray characters such as </+"
//      */
//     } else {
//         var arr = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
//         var myWholeField = myTarget.value.toString();
//         for (let k = 0; k < arr.length; k++) {
//             var tempString = arr[k];
//             if (tempString === 0 || tempString === 1) {
//                 console.log("contains a digit");
//             }
//             else {
//                 console.log("contains some non alphanumeric character");
//             }
//         }
//     }
//}
/*
 * loop through the length of the trimmed up valueInput and look
 * at each character
 * compareChars is all A-Z and a-z and inner spaces
 */
// for (let i = 0; i < valueInput.length; i++) {
//
//     let char = valueInput[i];
//     if (char.match(compareChars)) {
//         console.log(char);
//     }
//     else{
//         console.log(valueInput);
//     }
//     //console.log(char + "  ");
// }
//console.log(valueInput);


/*
Authors: Shayna Jamieson, Bridget Black, Keller Flint
Version: 1.0
File Name: ref_functions.js
*/

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
        let whereToHelpSpanElem = document.getElementById('where-to-help');
        whereToHelpSpanElem.classList.add("err-checkbox");
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
        let iCanHelpSpanElem = document.getElementById('i-can-help');
        iCanHelpSpanElem.classList.add("err-checkbox");
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

    /* ***INFORMATION-IS-TRUE***  */
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