// let $max_refs = 6;
// let $ref_count = 0;
// let $ref_id = 0;
//
// // $(function() {
// //     $("#datepicker").datepicker();
// // } );
//
// // adds reference div on click
// // add comment to test
// $("#add-ref").on("click", function(){
//     if ($ref_count + 1 <= $max_refs) {
//         $("#references").append(
//             '<div>\n' +
//             '    <div class="row">\n' +
//             '        <div class="col-12">\n' +
//             '            <label for="ref-name" class="col-form-label">Full Name</label><button type="button" id="btn-remove' + $ref_id + '" class="btn btn-secondary btn-remove float-right">Remove Reference</button>\n' +
//             '            <input type="text" class="form-control" id="ref-name" placeholder="">\n' +
//             '        </div>\n' +
//             '    </div>\n' +
//             '    <div class="row">\n' +
//             '        <div class="col-12">\n' +
//             '            <label for="ref-email" class="col-form-label">Email</label>\n' +
//             '            <input type="text" class="form-control" id="ref-email" placeholder="">\n' +
//             '        </div>\n' +
//             '    </div>\n' +
//             '    <div class="row">\n' +
//             '        <div class="col-12">\n' +
//             '            <label for="ref-relation" class="col-form-label">Relationship</label>\n' +
//             '            <input type="text" class="form-control" id="ref-relation" placeholder="">\n' +
//             '        </div>\n' +
//             '    </div>\n' +
//             ' </div>\n'
//         );
//
//         // BUTTON THAT SHOULD BE IMPLEMENTED BACK IN TO REMOVE A REFERENCE
//         // '    <button type="button" id="btn-remove' + $ref_id + '" class="btn btn-secondary btn-remove float-right">Remove Reference</button>\n' +
//
//         // Removes this element's reference div on click
//         $("#btn-remove" + $ref_id).on("click", function () {
//             $(this).parent().remove();
//             $ref_count--;
//             updateRefs();
//         });
//
//         $ref_count++;
//         $ref_id++;
//         updateRefs();
//     }
// });
//
// // updates color and text for number of references
// function updateRefs() {
//     if ($ref_count < 3) {
//         $("#ref-number").addClass("text-danger");
//         $("#ref-number").removeClass("text-success");
//     } else {
//         $("#ref-number").addClass("text-success");
//         $("#ref-number").removeClass("text-danger");
//     }
//     $("#ref-number").html($ref_count + "/3");
// }

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

// const input = document.querySelector('input');
//
// input.addEventListener('input', evt => {
//     const value = input.value;
//
//     if (!value) {
//         input.dataset.state = '';
//         return
//     }
//
//     const trimmed = value.trim();
//
//     if (trimmed) {
//         input.dataset.state = 'valid'
//     } else {
//         input.dataset.state = 'invalid'
//     }
// });