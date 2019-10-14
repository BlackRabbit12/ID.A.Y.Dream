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
    var experienced = document.getElementsByName('youth-experience');
    for (let i=0; i < experienced.length; i++) {
        var showy = document.getElementById("toggle-please-explain");
        if (experienced[i].checked){
            showy.style.display = 'block';
        }
        else {
            showy.style.display = 'none';
        }
    }
});

/*
* Client side validation checks on all <input>, <select>, <textarea>
*/
$(document).ready(function(){
    $("input[type='text']").keyup(function(event){
        var valueInput = event.target;
        valueInput = valueInput.value;
        console.log(valueInput);
    });

    $("textarea").keyup(function(event){
        var valueText = event.target;
        valueText = valueText.value;
        console.log(valueText);
    });

    $("input[type='checkbox']").click(function(event){
        var valueChecked = event.target;
        valueChecked = valueChecked.checked;
        console.log(valueChecked);
    });

    $("input[type='radio']").click(function(event){
        var valueButton = event.target;
        valueButton = valueButton.checked;
        console.log(valueButton);
    });

    $("option").click(function(event){
        var valueOption = event.target;
        valueOption = valueOption.value;
        console.log(valueOption);
    });
});