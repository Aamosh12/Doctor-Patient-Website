function toggleErrorMessage(show) {
  var errorMessageDiv = document.getElementById("error-message");
  errorMessageDiv.style.display = show ? "block" : "none";
}

function setErrorText(text) {
  var errorText = document.getElementById("error-text");
  errorText.innerHTML = text;
}

function clearErrorText() {
  setErrorText("");
}

function validateForm() {
  var name = document.forms["myForm"]["name"].value;
  var email = document.forms["myForm"]["email"].value;
  var phone = document.forms["myForm"]["phone"].value;
  var username = document.forms["myForm"]["username"].value;
  var address = document.forms["myForm"]["address"].value;
  var food = document.forms["myForm"]["food"].value;
  var password = document.forms["myForm"]["password"].value;
  var confirmPassword = document.forms["myForm"]["cpassword"].value;

  // Error message element
  var errorMessageDiv = document.getElementById("error-message");

  if (
    name === "" ||
    email === "" ||
    phone === "" ||
    username === "" ||
    address === "" ||
    food === "" || password === "" || confirmPassword === ""
  ) {
    setErrorText("Error: Please fill in all fields!");
    toggleErrorMessage(true);
    return false;
  }

  // Text validation for the name (letters followed by optional numbers)
  var namePattern = /^[A-Za-z\s]+$/;
  var addressPattern = /^(?=.*[a-zA-Z])\w*$/;
  if (!name.match(namePattern)) {
    setErrorText("Error: Invalid name format.");
    toggleErrorMessage(true);
    return false;
  } else if (!address.match(addressPattern)) {
    setErrorText("Error: Invalid address format.");
    toggleErrorMessage(true);
    return false;
  }
  var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

  if (!email.match(emailPattern)) {
    setErrorText("Error: Invalid email address format.");
    toggleErrorMessage(true);
    return false;
  }

  // Phone number validation
  var phonePattern = /^(98|97)\d{8}$/;

  if (!phone.match(phonePattern)) {
    setErrorText(
      "Error: Invalid phone number format. Please enter a valid 10-digit number starting with '98' or '97'."
    );
    toggleErrorMessage(true);
    return false;
  }

  // Username validation
  var usernamePattern = /^(?=.*[a-zA-Z])\w*$/;

  if (!username.match(usernamePattern)) {
    setErrorText(
      "Error: Invalid username format. It should start with letters and contain at least one number."
    );
    toggleErrorMessage(true);
    return false;
  }

  // Food validation (assuming it follows the same format as the name)
  if (!food.match(namePattern)) {
    setErrorText("Error: Invalid food format.");
    toggleErrorMessage(true);
    return false;
  }

  if (password.length < 8) {
    setErrorText("Error: Password must be at least 8 characters long.");
    toggleErrorMessage(true);
    return false;
  }

  if (password !== confirmPassword) {
    setErrorText("Error: Passwords do not match.");
    toggleErrorMessage(true);
    return false;
  }

  // Clear any previous error messages if all validations pass
  clearErrorText();
  toggleErrorMessage(false);

  return true;
}
