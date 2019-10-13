let $max_refs = 6;
let $ref_count = 0;
let $ref_id = 0;

// $(function() {
//     $("#datepicker").datepicker();
// } );

// adds reference div on click
// add comment to test
$("#add-ref").on("click", function(){
    if ($ref_count + 1 <= $max_refs) {
        $("#references").append(
            '<div class="reference border">\n' +
            '    <label for="ref-name">Name</label>\n' +
            '    <button type="button" id="btn-remove' + $ref_id + '" class="btn btn-secondary btn-remove float-right">Remove Reference</button>\n' +
            '    <div class="input-group mb-3">\n' +
            '        <input type="text" class="form-control" id="ref-name" placeholder="Jane Doe">\n' +
            '    </div>\n' +
            '    <label for="ref-email">Email</label>\n' +
            '    <div class="input-group mb-3">\n' +
            '        <input type="text" class="form-control" id="ref-email" placeholder="me@someone.com">\n' +
            '    </div>\n' +
            '    <label for="ref-relation">Relationship</label>\n' +
            '    <div class="input-group mb-3">\n' +
            '        <input type="text" class="form-control" id="ref-relation" placeholder="Father">\n' +
            '    </div>\n' +
            ' </div>'
        );


        // Removes this element's reference div on click
        $("#btn-remove" + $ref_id).on("click", function () {
            $(this).parent().remove();
            $ref_count--;
            updateRefs();
        });

        $ref_count++;
        $ref_id++;
        updateRefs();
    }
});

// updates color and text for number of references
function updateRefs() {
    if ($ref_count < 3) {
        $("#ref-number").addClass("text-danger");
        $("#ref-number").removeClass("text-success");
    } else {
        $("#ref-number").addClass("text-success");
        $("#ref-number").removeClass("text-danger");
    }
    $("#ref-number").html($ref_count + "/3");
}

/*
* Question: Do you have previous work experience with youth organizations?
* Gets both radio buttons 'Yes' and 'No', when they experience a change the function executes
* var experienced gets the length of how many radio buttons are named 'youth-experience'
* for loop walks through the length of the radio list, var showy gets the text area by it's
*       div id "toggle-please-explain".
*           If the second radio button 'yes' is checked then it turns the default div css
*               from display: none to display: block
*           If the first radio button 'no' is checked then it ensures the default div css
*               is re-enstated as display: none.
 */
$('input[name="youth-experience"]').on('change', function(){
    var experienced = document.getElementsByName('youth-experience');
    for (i=0; i < experienced.length; i++) {
        var showy = document.getElementById("toggle-please-explain");
        if (experienced[i].checked){
            showy.style.display = 'block';
        }
        else {
            showy.style.display = 'none';
        }
    }
});