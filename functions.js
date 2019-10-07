let $ref_count = 0;

$( function() {
    $( "#datepicker" ).datepicker();
} );

// adds reference div on click
$("#add-ref").on("click", function(){
    $("#references").append(
        '<div class="reference">\n' +
        '                    <label for="ref-name">Name</label>\n' +
        '                    <div class="input-group mb-3">\n' +
        '                        <input type="text" class="form-control" id="ref-name" placeholder="Jane Doe">\n' +
        '                    </div>\n' +
        '                    <label for="ref-email">Email</label>\n' +
        '                    <div class="input-group mb-3">\n' +
        '                        <input type="text" class="form-control" id="ref-email" placeholder="me@someone.com">\n' +
        '                    </div>\n' +
        '                    <label for="ref-relation">Relationship</label>\n' +
        '                    <div class="input-group mb-3">\n' +
        '                        <input type="text" class="form-control" id="ref-relation" placeholder="Father">\n' +
        '                    </div>\n' +
        '                    <button type="button" class="btn btn-secondary btn-remove">Remove Reference</button>\n' +
        '                </div>'
    );
    $ref_count++;
    // Removes this reference div on click
    $(".btn-remove").on("click", function() {
        $(this).parent().remove();
        $ref_count--;
        $("#ref-number").html( $ref_count + "/3");
    });
    // update number of references

    $("#ref-number").html( $ref_count + "/3");
});

