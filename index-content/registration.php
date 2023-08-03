<div action="" id="register" class="input-group-register" method="post">
    <div id="choice">
        <h5>I am registering as:</h5>
        <div class="radio-box">
            <input type="radio" checked value="Doctor" name="user" id="doctor" onclick="doctor_checked()"><label for="Doctor">Doctor</label>
        </div>
        <div class="radio-box">
            <input type="radio" value="Patient" name="user" id="patient" onclick="patient_checked()"><label for="Patient">Patient</label>
        </div>
    </div><br>
    <div id="scroll-form">
        <div id="field_doctor">
            <form action="./index-content/register.php" id="register0" class="input-group-register0" method="post" onsubmit="return validatedoc()">
                <input type="text" class="input-field" placeholder="Name" name="dname" required>
                <input type="email" class="input-field" placeholder="Email" name="demail" id="email" required>
                <input type="text" class="input-field" placeholder="Address" name="daddress" required>
                <input type="tel" class="input-field" placeholder="Phone Number" name="dphone" required>
                <input type="text" class="input-field" placeholder="Username" name="dusername" onkeyup="httprequesdoc(this.value)" required>
                <p id="userCheckdoc"></p>
                <input type="text" class="input-field" placeholder="Your Degree Here" name="degree" required>
                <input type="text" class="input-field" placeholder="Specialization" name="spec" required>
                <input type="tel" class="input-field" placeholder="NMC No." name="nmc" required>
                <input type="text" class="input-field" placeholder="Experience here" name="experience" required>
                <input type="password" class="input-field" placeholder="Password" name="dpassword" id="dpassword" required>
                <input type="password" class="input-field" placeholder="Confirm Password" name="dcpassword" id="dcpassword" required>
                <p id="password_match_error" class="text-danger"></p>
                <input type="checkbox" class="check-box" required><span id="agreeText">I agree to the terms and conditions.</span>
                <div class="message-box" style="display: none;">
                    <p id="message">Registration Success</p>
                </div>
                <p id="emailExistMessage" style="display: none; color: red;">Email already exists in the database.</p>
                <button type="submit" class="submit-btn" name="register-doctor" value="register-doctor">Register</button>
            </form>
        </div>
        <!-- 
            js if else 
            if doctor don't validate client and vice versa
         -->
        <div id="field_patient">
            <form action="./index-content/registerpat.php" id="register2" class="input-group-register2" method="post" onsubmit="return validatepat()">
                <input type="text" class="input-field" placeholder="Name" name="pname" required>
                <input type="email" class="input-field" placeholder="Email" name="pemail" id="email2" required>
                <input type="text" class="input-field" placeholder="Address" name="paddress" required>
                <input type="tel" class="input-field" placeholder="Phone No" name="pnum" required>
                <input type="text" class="input-field" placeholder="Choose a valid user name" name="pusername" onkeyup="httpreques(this.value)" required>
                <p id="userCheck"></p>
                <input type="password" class="input-field" placeholder="Password" name="ppassword" id="ppassword" required>
                <input type="password" class="input-field" placeholder="Confirm Password" name="pcpassword" id="pcpassword" required>
                <p id="password_match_error_patient" class="text-danger"></p>
                <input type="checkbox" class="check-box" required><span id="agreeText">I agree to the terms and conditions.</span>
                <p id="emailExistMessage1" style="display: none; color: red;">Email already exists in the database.</p>
                <button type="submit" class="submit-btn" name="register-patient">Register</button>
            </form>
        </div>
    </div>
</div>
<script>
    // document.getElementById('register0').addEventListener('submit', function(event) {
    //     event.preventDefault(); // Prevent the form from submitting normally

    //     // Get the email value from the form
    //     var email = document.getElementById('email').value;

    //     // Create a new XMLHttpRequest object (AJAX request)
    //     var xhr = new XMLHttpRequest();

    //     // Configure the AJAX request
    //     xhr.open('POST', './index-content/check_email.php', true);
    //     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    //     // Define a callback function to handle the AJAX response
    //     xhr.onreadystatechange = function() {
    //         if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
    //             var response = xhr.responseText;
    //             var emailExistMessage = document.getElementById('emailExistMessage');
    //             if (response === 'exist') {
    //                 // Show the email exist message
    //                 emailExistMessage.style.display = 'block';
    //             } else {
    //                 // Proceed with form submission
    //                 emailExistMessage.style.display = 'none'; // Hide the message if previously shown
    //                 document.getElementById('register0').submit();
    //             }
    //         }
    //     };

    //     // Send the AJAX request with the email data
    //     xhr.send('email=' + encodeURIComponent(email));
    // });
    // document.getElementById('register2').addEventListener('submit', function(event) {
    //     event.preventDefault(); // Prevent the form from submitting normally

    //     // Get the email value from the form
    //     var email = document.getElementById('email2').value;

    //     // Create a new XMLHttpRequest object (AJAX request)
    //     var xhr = new XMLHttpRequest();

    //     // Configure the AJAX request
    //     xhr.open('POST', './index-content/check_emailPat.php', true);
    //     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    //     // Define a callback function to handle the AJAX response
    //     xhr.onreadystatechange = function() {
    //         if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
    //             var response = xhr.responseText;
    //             var emailExistMessage = document.getElementById('emailExistMessage1');
    //             if (response === 'exist') {
    //                 // Show the email exist message
    //                 emailExistMessage.style.display = 'block';
    //             } else {
    //                 // Proceed with form submission
    //                 emailExistMessage.style.display = 'none'; // Hide the message if previously shown
    //                 document.getElementById('register2').submit();
    //             }
    //         }
    //     };

    //     // Send the AJAX request with the email data
    //     xhr.send('email=' + encodeURIComponent(email));
    // });
     function validatedoc() {
      var password = document.getElementById("dpassword").value;
      var confirmPassword = document.getElementById("dcpassword").value;

      if (password !== confirmPassword) {
        document.getElementById("password_match_error").textContent = "Passwords do not match!";
        return false; // Return false to prevent form submission
      }

      // Passwords match, continue with form submission
      return true;
    }
    function validatepat() {
      var password = document.getElementById("ppassword").value;
      var confirmPassword = document.getElementById("pcpassword").value;

      if (password !== confirmPassword) {
        document.getElementById("password_match_error_patient").textContent = "Passwords do not match!";
        return false; // Return false to prevent form submission
      }

      // Passwords match, continue with form submission
      return true;
    }
    function httpreques(user){
        let request = new XMLHttpRequest();

            request.open('GET', './index-content/usernameCheck.php?username='+user);
            
            request.onreadystatechange = function () {
                if(request.status == 200 && request.readyState == 4)
                {
                    document.getElementById('userCheck').textContent = request.response;
                }
            }

            request.send();
    }
    function httprequesdoc(user){
        let request = new XMLHttpRequest();

            request.open('GET', './index-content/usercheckDoc.php?username='+user);
            
            request.onreadystatechange = function () {
                if(request.status == 200 && request.readyState == 4)
                {
                    document.getElementById('userCheckdoc').textContent = request.response;
                }
            }

            request.send();
    }
</script>