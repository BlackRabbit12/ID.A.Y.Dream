/*
 * Authors: Shayna Jamieson, Keller Flint, Bridget Black
 * 2019-11-12
 * Last Updated: 2019-11-12
 * Version 1.0
 * File name: admin_page_functions.js
 * Associated Files: admin_page.php
 */

$(document).ready(function () {
    $('#dreamer-table').DataTable();
    $('#volunteer-table').DataTable();
});

document.getElementById("data-select").addEventListener("change", function () {
    this.form.submit();
});