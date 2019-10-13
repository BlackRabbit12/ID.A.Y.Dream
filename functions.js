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
            '<div>\n' +
            '    <div class="row">\n' +
            '        <div class="col-12">\n' +
            '            <label for="ref-name" class="col-form-label">Full Name</label><button type="button" id="btn-remove' + $ref_id + '" class="btn btn-secondary btn-remove float-right">Remove Reference</button>\n' +
            '            <input type="text" class="form-control" id="ref-name" placeholder="">\n' +
            '        </div>\n' +
            '    </div>\n' +
            '    <div class="row">\n' +
            '        <div class="col-12">\n' +
            '            <label for="ref-email" class="col-form-label">Email</label>\n' +
            '            <input type="text" class="form-control" id="ref-email" placeholder="">\n' +
            '        </div>\n' +
            '    </div>\n' +
            '    <div class="row">\n' +
            '        <div class="col-12">\n' +
            '            <label for="ref-relation" class="col-form-label">Relationship</label>\n' +
            '            <input type="text" class="form-control" id="ref-relation" placeholder="">\n' +
            '        </div>\n' +
            '    </div>\n' +
            ' </div>\n'
        );

        // BUTTON THAT SHOULD BE IMPLEMENTED BACK IN TO REMOVE A REFERENCE
        // '    <button type="button" id="btn-remove' + $ref_id + '" class="btn btn-secondary btn-remove float-right">Remove Reference</button>\n' +

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








document.getElementById("volunteer-form").onsubmit = validate;

function validate() {
    var isTrue = true;

    var fullName = document.getElementById("full-name").value;

    if (fullName == "") {
        var errFullName;
    }

    return isTrue;
}