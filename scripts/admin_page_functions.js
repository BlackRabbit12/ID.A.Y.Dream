$(document).ready(function () {
    $('#dreamer-table').DataTable();
    $('#volunteer-table').DataTable();
});

document.getElementById("data-select").addEventListener("change", function () {
    this.form.submit();
});