function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    var tdElements = document.getElementsByTagName("td");

    for (var i = 0; i < tdElements.length; i++) {
        tdElements[i].style.backgroundColor = "#0e0d0d !important";
    }
}

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

function validName(name){
    return /^[a-zA-Z ]+$/.test(name) && name.trim() !== "";
}

function validMessage(message) {
    return message.trim() !== "";
}

function validEmail(email){
    return email.trim() !== "";
}

function validNumber(number){
    return !isNaN(number) && number !== "";
}