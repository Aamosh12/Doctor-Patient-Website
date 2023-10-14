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
  var degree = document.forms["myForm"]["degree"].value;
  var specialization = document.forms["myForm"]["spec"].value;
  var nmc = document.forms["myForm"]["nmc"].value;
  var experience = document.forms["myForm"]["experience"].value;
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
    degree === "" ||
    specialization === "" ||
    nmc === "" ||
    experience === "" ||
    food === "" || password === "" || confirmPassword === ""
  ) {
    setErrorText("Error: Please fill in all fields!");
    toggleErrorMessage(true);
    return false;
  }

  // Text validation for the name (letters followed by optional numbers)
  var namePattern = /^[A-Za-z\s]+$/;
  var usernamePattern = /^[A-Za-z\s\d]+$/;
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

  // Email validation
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

  // Text validation for degree (letters followed by optional numbers)
  if (!degree.match(namePattern)) {
    setErrorText("Error: Invalid degree format.");
    toggleErrorMessage(true);
    return false;
  }

  // Text validation for specialization (letters followed by optional numbers)
  if (!specialization.match(namePattern)) {
    setErrorText("Error: Invalid specialization format.");
    toggleErrorMessage(true);
    return false;
  }

  // Numeric validation for NMC
  if (!isNumeric(nmc)) {
    setErrorText("Error: NMC must be a numeric value.");
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
