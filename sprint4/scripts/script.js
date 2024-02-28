//dark mode preference persistent across page visits

// This function toggles dark mode and saves the state in local storage
function toggleDarkMode() {
    var isDarkMode = document.body.classList.toggle('dark-mode');
    localStorage.setItem('darkMode', isDarkMode ? 'enabled' : 'disabled');

    var tdElements = document.getElementsByTagName("td");
    for (var i = 0; i < tdElements.length; i++) {
        tdElements[i].style.backgroundColor = isDarkMode ? "#131313" : ""; // Adjust the color or remove this line if not needed
        tdElements[i].style.color = isDarkMode ? "#FFFFFF" : "";
    }
}

// This function checks the local storage to apply dark mode if it was previously enabled
function applyDarkModeIfEnabled() {
    if (localStorage.getItem('darkMode') === 'enabled') {
        document.body.classList.add('dark-mode');
        var tdElements = document.getElementsByTagName("td");
        for (var i = 0; i < tdElements.length; i++) {
            tdElements[i].style.backgroundColor = "#131313"; // Adjust the color or remove this line if not needed
            tdElements[i].style.color = "#FFFFFF";
        }
    }
}

// Call applyDarkModeIfEnabled on page load
document.addEventListener('DOMContentLoaded', applyDarkModeIfEnabled);


// sign up validtion
function validSignUp() {
    let fName = document.forms["sign-up-form"]["fName"].value.trim();
    let lName = document.forms["sign-up-form"]["lName"].value.trim();
    let email = document.forms["sign-up-form"]["email"].value.trim();
    let cohort = document.forms["sign-up-form"]["cohort-number"].value;
    let fNameWarning = document.getElementById("first-name-span");
    let lNameWarning = document.getElementById("last-name-span");
    let emailWarning = document.getElementById("email-span-bad");
    let cohortWarning = document.getElementById("cohort-number-span");
    let sendForm = true;

    if (!validName(fName)) {
        fNameWarning.innerText = "* Invalid First Name";
        sendForm = false;
    }
    else {
        fNameWarning.innerText = "";
    }

    if (!validName(lName)) {
        lNameWarning.innerText = "* Invalid Last Name";
        sendForm = false;
    }
    else {
        lNameWarning.innerText = "";
    }

    if (!validNumber(cohort) || parseInt(cohort) > 100 || parseInt(cohort) < 0) {
        cohortWarning.innerText = "* invalid cohort number";
        sendForm = false;
    }
    else {
        cohortWarning.innerText = "";
    }

    if (!validEmail(email)) {
        emailWarning.innerText = "* Please enter an email address";
        sendForm = false;
    }
    else {
        emailWarning.innerText = "";
    }

    return sendForm;
}

function signUpEmailWarning() {
    let email = document.forms["sign-up-form"]["email"].value;
    let emailWarning = document.getElementById("email-span-good");
    let emailWarning2 = document.getElementById("email-span-bad");

    if (email.indexOf("@greenriver.edu") === -1 && email.indexOf("@student.greenriver.edu") === -1) {
        emailWarning.innerText = "* Your greenriver.edu email is preferred, but not required";
        emailWarning2.innerText = "";
    }
    else {
        emailWarning.innerText = "";
    }
}

// contact form validation
function validateContact() {
    let name = document.contactForm.name.value.trim();
    let email = document.contactForm.email.value.trim();
    let subject = document.contactForm.subject.value.trim();
    let message = document.contactForm.message.value.trim();
    let sendForm = true;

    if (!validName(name)) {
        document.getElementById("nameWarning").innerText = " Invalid Name";
        sendForm = false;
    }
    else {
        document.getElementById("nameWarning").innerText = "";
    }
    // TODO: add proper email syntax validation
    if (!validEmail(email)) {
        document.getElementById("emailWarning").innerText = " Invalid Email";
        sendForm = false;
    }
    else {
        document.getElementById("emailWarning").innerText = "";
    }

    if (!validSubject(subject)) {
        document.getElementById("subjectWarning").innerText = " Invalid Subject";
        sendForm = false;
    }
    else {
        document.getElementById("subjectWarning").innerText = "";
    }

    if (!validMessage(message)) {
        document.getElementById("messageWarning").innerText = " Invalid Message";
        sendForm = false;
    }
    else {
        document.getElementById("messageWarning").innerText = "";
    }

    return sendForm;
}

// admin announce form validation
function validateAdminAnnounce() {
    let title = document.adminAnnouncementForm.title.value.trim();
    let location = document.adminAnnouncementForm.location.value.trim();
    let employer = document.adminAnnouncementForm.employer.value.trim();
    let moreInfo = document.adminAnnouncementForm.moreInfo.value.trim();
    let url = document.adminAnnouncementForm.url.value.trim();
    let email = document.adminAnnouncementForm.email.value.trim();
    let sendForm = true;
    let formID = "adminAnnouncementForm";
    let radioName = "employmentType";

    if (!validText(title)) {
        document.getElementById("titleWarning").innerText = " Title must not be blank";
        sendForm = false;
    }
    else {
        document.getElementById("locationWarning").innerText = "";
    }
    if (!validRadio(formID, radioName)) {
        document.getElementById("radioWarning").innerText = " Please select an option"
        sendForm = false;
    }
    else {
        document.getElementById("radioWarning").innerText = ""
    }
    if (!validText(location)) {
        document.getElementById("locationWarning").innerText = " Location must not be blank";
        sendForm = false;
    }
    else {
        document.getElementById("titleWarning").innerText = "";
    }
    if (!validText(employer)) {
        document.getElementById("employerWarning").innerText = " Employer must not be blank";
        sendForm = false;
    }
    else {
        document.getElementById("employerWarning").innerText = "";
    }
    if (!validText(moreInfo)) {
        document.getElementById("moreInfoWarning").innerText = " Invalid Additional Information";
        sendForm = false;
    }
    else {
        document.getElementById("moreInfoWarning").innerText = "";
    }
    if (!validText(url)) {
        document.getElementById("urlWarning").innerText = " Invalid url";
        sendForm = false;
    }
    else {
        document.getElementById("urlWarning").innerText = "";
    }
    // TODO: add proper email syntax validation
    if (!validEmail(email)) {
        document.getElementById("emailWarning").innerText = " Invalid Email";
        sendForm = false;
    }
    else {
        document.getElementById("emailWarning").innerText = "";
    }

    return sendForm;
}


function validName(name){
    return /^[a-zA-Z ]+$/.test(name) && name.trim() !== "";
}

function validMessage(message) {
    return message.trim() !== "";
}

function validEmail(email){
    return email.trim() !== "";
}

function validSubject(subject) {
    return subject.trim() !== "";
}

// generic function to validate that a field is not empty
function validText(text) {
    return text.trim() !== "";
}

function validNumber(number){
    return !isNaN(number) && number !== "";
}

// returns true if a radio button is selected, false otherwise
// formID = the id of the form in the associated form tag
// radioName = the name of the radio button in the associated input tag
function validRadio(formID, radioName) {
    let radios = document.getElementById(formID).querySelectorAll(`[name=${radioName}]`);
    let valid = false;

    for (let i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            valid = true;
            break; // No need to continue checking once one is found
        }
    }
    return valid;
}