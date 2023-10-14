<?php
session_start();
require './logincheck.php';
include './registervalidation/doctorValidatemsg.php';
include './docregistercheck.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./style/login.css">
  <script src="./scripts/docregistervalidate.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login </title>
</head>

<body>
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="./images/frontImg.jpg" alt="">
        <div class="text">
          <span class="text-1">Every new friend is a <br> new adventure</span>
          <span class="text-2">Let's get connected</span>
        </div>
      </div>
      <div class="back">
        <img class="backImg" src="./images/backImg.jpg" alt="">
        <div class="text">
          <span class="text-1">Complete miles of journey <br> with one step</span>
          <span class="text-2">Let's get started</span>
        </div>
      </div>
    </div>
    <div class="forms">
      <div class="form-content">
        <div class="login-form">
          <div class="title">Login</div>
          <form action="" method="post">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Enter your username" name="username">
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Enter your password" name="password">
              </div>
              <div class="text"><a href="#">Forgot password?</a></div>
              <div class="button input-box">
                <input type="submit" value="Sumbit" name="doc-submit">
              </div>
              <div class="text sign-up-text">Don't have an account? <label for="flip">Signup now</label></div>
            </div>
          </form>
        </div>
        <div class="signup-form">
          <div class="title">Signup</div>
          <div id="error-message" style="color: red; text-align: center; display: none;">
            <span id="error-text"></span>
            <span id="close-error" style="cursor: pointer; float: right;">&times;</span>
          </div>
          <form action="" method="post" onsubmit="return validateForm()" name="myForm">
            <div id="form1">
              <div class="input-boxes">
                <div class="input-box">
                  <i class="fas fa-user"></i>
                  <input type="text" placeholder="Enter your name" name="name" required>
                </div>
                <div class="input-box">
                  <i class="fas fa-envelope"></i>
                  <input type="email" placeholder="Enter your email" name="email" onkeyup="emailCheck(this.value)" autocomplete="off" required>
                </div>
                <p id="emailCheck"></p>
                <div class="input-box">
                  <i class="fas fa-map-marked"></i>
                  <input type="text" placeholder="Enter your Address" name="address" required>
                </div>
                <div class="btn-box">
                  <button type="button" id="Next1">Next</button>
                </div>
              </div>
            </div>
            <div id="form2">
              <div class="input-boxes">
                <div class="input-box">
                  <i class="fas fa-mobile"></i>
                  <input type="tel" placeholder="Enter your phone number" name="phone" required>
                </div>
                <div class="input-box">
                  <i class="fas fa-user-graduate"></i>
                  <input type="text" placeholder="What is your degree?" name="degree" required>
                </div>
                <div class="input-box">
                  <i class="fas fa-notes-medical"></i>
                  <input type="tel" placeholder="Enter NMC number" name="nmc" required>
                </div>
                <div class="btn-box">
                  <button type="button" id="Back1">Back</button>
                  <button type="button" id="Next2">Next</button>
                </div>
              </div>
            </div>
            <div id="form3">
              <div class="input-boxes">
                <div class="input-box">
                  <i class="fas fa-award"></i>
                  <input type="text" placeholder="Enter your specialization" name="spec" required>
                </div>
                <div class="input-box">
                  <i class="fas fa-handshake"></i>
                  <input type="text" placeholder="Enter your experience" name="experience" required>
                </div>
                <div class="input-box">
                  <i class="fas fa-hamburger"></i>
                  <input type="text" placeholder="Enter your favourite food" name="food" required>
                </div>
                <div class="btn-box">
                  <button type="button" id="Back2">Back</button>
                  <button type="button" id="Next3">Next</button>
                </div>
              </div>
            </div>
            <div id="form4">
              <div class="input-boxes">
                <div class="input-box">
                  <i class="fas fa-user"></i>
                  <input type="text" placeholder="Enter suitable username" name="username" id="username" autocomplete="off" onkeyup="usernameCheck(this.value)" required>
                </div>
                <p id="userCheck"></p>
                <div class="input-box">
                  <i class="fas fa-lock"></i>
                  <input type="password" placeholder="Enter Password" name="password" required>
                </div>
                <div class="input-box">
                  <i class="fas fa-lock"></i>
                  <input type="password" placeholder="Enter confirm password" name="cpassword" required>
                </div>
                <div class="btn-box">
                  <button type="button" id="Back3">Back</button>
                  <button type="submit" name="register-doctor">Submit</button>
                </div>
              </div>
            </div>

            <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    var Form1 = document.getElementById("form1");
    var Form2 = document.getElementById("form2");
    var Form3 = document.getElementById("form3");
    var Form4 = document.getElementById("form4");
    var Next1 = document.getElementById("Next1");
    var Next2 = document.getElementById("Next2");
    var Next3 = document.getElementById("Next3");
    var Back1 = document.getElementById("Back1");
    var Back2 = document.getElementById("Back2");
    var Back3 = document.getElementById("Back3");
    Next1.onclick = function() {
      Form1.style.display = "none";
      Form2.style.display = "block";
      // Update progress here if needed
    }

    Back1.onclick = function() {
      Form1.style.display = "block";
      Form2.style.display = "none";
      // Update progress here if needed
    }

    Next2.onclick = function() {
      Form2.style.display = "none";
      Form3.style.display = "block";
      // Update progress here if needed
    }

    Back2.onclick = function() {
      Form2.style.display = "block";
      Form3.style.display = "none";
      // Update progress here if needed
    }
    Next3.onclick = function() {
      Form3.style.display = "none";
      Form4.style.display = "block";
    }
    Back3.onclick = function() {
      Form3.style.display = "block";
      Form4.style.display = "none";
      // Update progress here if needed
    }
    document.getElementById("close-error").addEventListener("click", function() {
      toggleErrorMessage(false);
      clearErrorText();
    });
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }

    function usernameCheck(user) {
      let request = new XMLHttpRequest();
      request.open('GET', './index-content/usercheckDoc.php?username=' + user);

      request.onreadystatechange = function() {
        if (request.status == 200 && request.readyState == 4) {
          document.getElementById('userCheck').textContent = request.response;
        }
      }

      request.send();
    }
    function emailCheck(value) {
      let request = new XMLHttpRequest();
      request.open('GET', './index-content/email.php?email=' + value);

      request.onreadystatechange = function() {
        if (request.status == 200 && request.readyState == 4) {
          document.getElementById('emailCheck').textContent = request.response;
        }
      }

      request.send();
    }
  </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>