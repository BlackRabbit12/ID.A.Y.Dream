// on click, displays results summary for youth splash page
document.getElementById("summary-button").onclick = toggleSummary;
function toggleSummary() {
    document.getElementById("summary-button").style.display = "none";
    document.getElementById("summary").style.display = "block";
}