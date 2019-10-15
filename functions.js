/*
 * Question: Do you have previous work experience with youth organizations?
 * Gets both radio buttons 'Yes' and 'No', when they experience a change the function executes
 * var experienced gets the length of how many radio buttons are named 'youth-experience'
 * for loop walks through the length of the radio list, var showy gets the text area by it's
 *       div id "toggle-please-explain" .
 *           If the second radio button 'yes' is checked then it turns the default div css
 *               from display: none to display: block
 *           If the first radio button 'no' is checked then it ensures the default div css
 *               is reinstated as display: none  .
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
        var valueChecked = event.target;
        valueChecked = valueChecked.checked;
        console.log(valueChecked);
    }); //end $("input[type='checkbox']").click(function(event)

    /*
     * Looks at the <input> type 'radio' as a user inputs each 'click'
     */
    $("input[type='radio']").click(function(event){
        var valueButton = event.target;
        valueButton = valueButton.checked;
        console.log(valueButton);
    }); //end $("input[type='radio']").click(function(event)

    /*
     * Looks at the <select> <options> when a user chooses id="state" and
     * id="t-shirt" size drop down menus
     */
    $("select").on("change", function(event){
        let valueSelect = event.target;
        var valueOption = ($(this).find('option:selected').attr('value'));
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
