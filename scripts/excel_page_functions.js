/**
 * @author Shayna Jamieson
 * @author Bridget Black
 * @author Keller Flint
 * @version 1.0
 * 2020-01-05
 * Last Update: 2020-01-05
 * File name: excel_page_functions.js
 * Associated Files:
 *      excel.php
 *
 * Description:
 *      File contains the excel page's main functionality. It creates a table on the excel page for exporting to excel.
 *      Quick File Relations:
 *          excel.php - uses event functions made in excel page functions javascript
 */

/**
 * Excel button to export table to excel sheets.
 */
$('#dreamer-table').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'excel'
    ]
});