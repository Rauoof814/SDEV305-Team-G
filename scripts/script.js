function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    var tdElements = document.getElementsByTagName("td");

for (var i = 0; i < tdElements.length; i++) {
    tdElements[i].style.backgroundColor = "#0e0d0d !important";
}
}