// on splash page, clicking button displays summary of information to user
document.getElementById("summary-button").onclick = toggleSummary;
function toggleSummary() {
    document.getElementById("summary-button").style.display = "none";
    document.getElementById("summary").style.display = "block";
}