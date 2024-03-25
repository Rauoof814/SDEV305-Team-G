//Our main method that calls all form validation functions
function validateForm() {
    const validationResults =
        validateContact()
        && validateCity()
        && validateState()
        && validateToppings();

    //Prevent the form from sending and the page from being redirected
    //if any of our validation failed
    if (!validationResults) {
        event.preventDefault();
    }
}

// Validate the phone and email are indeed phone numbers and email addresses
// Warn the user if they use an email address that does not contain @greenriver.edu
function validateContact() {
    let name = document.forms["order-form"]["name"].value;
    let email = document.forms["order-form"]["email"].value;
    let phone = document.forms["order-form"]["phone"].value;
    var nameWarning = document.getElementById("name-span");
    var phoneWarning = document.getElementById("phone-span");
    var emailWarning = document.getElementById("email-span");

    if (/[^a-zA-Z ]+$/.test(name)) {
        nameWarning.innerText = "invalid name";
        return false;
    }
    else {
        nameWarning.innerText = "*";
    }

    if (/[^0-9]+$/.test(phone)) {
        phoneWarning.innerText = "invalid phone number";
        return false;
    }
    else {
        phoneWarning.innerText = "*";
    }

    if (email.indexOf("@greenriver.edu") === -1) {
        emailWarning.innerText = "You should use your Green River email address!!!";
        return false;
    }
    else {
        emailWarning.innerText = "*";
    }

    return true;

}

// If the city is not seattle, kent, auburn, burien or seatac, warn them that a $25 delivery fee is added. Make these checks t case insensitiv
function validateCity() {
    const cityInput = document.getElementById("city").value.toLowerCase();
    const specificCities = ["seattle", "kent", "auburn", "burien", "seatac"];

    if (!specificCities.includes(cityInput)) {

        let citySpan = document.getElementById("city-span");
        citySpan.innerHTML = "Can only deliver to Seattle, Kent, Auburn, Burien or Seatac";
        return false;
    }
    return true;
}

// Require the user to select WA as the state
function validateState() {
    const stateSelect = document.getElementById("state");

    if (stateSelect.value !== "WA") {
        let stateSpan = document.getElementById("state-span");
        stateSpan.innerHTML = "Can only deliver to Washington State addresses";
        return false;
    }
    return true;
}

//Require the user to select exactly 3 toppings
function validateToppings() {
    //Pull all the checkboxes on the page (all toppings)
    const toppings = document.querySelectorAll("input[type=checkbox]");
    let selectedToppingsCount = 0;

    //Count through all the checkboxes that are checked
    toppings.forEach(topping => {
        if (topping.checked) {
            selectedToppingsCount++;
        }
    })

    if (selectedToppingsCount !== 3) {
        let toppingSpan = document.getElementById("toppings-warning");
        toppingSpan.innerHTML = "Please select exactly 3 toppings";
        return false;
    }
    return true;
}
function pizzaSizeSelected() {
    return false;
}