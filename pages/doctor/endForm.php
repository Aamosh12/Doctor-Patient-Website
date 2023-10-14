<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 15%;
        top: 0;
        width: 90%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        border: 1px solid #888;
        width: 80%;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s
    }

    @-webkit-keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }

        to {
            top: 0;
            opacity: 1
        }
    }

    @keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }

        to {
            top: 0;
            opacity: 1
        }
    }

    .close {
        color: white;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-header {
        padding: 2px 16px;
        background-color: #5cb85c;
        color: white;
    }

    .modal-body {
        padding: 2px 16px;
    }

    .modal-footer {
        padding: 2px 16px;
        background-color: lightgray;
        color: #d00000;
    }

    .form-text {
        text-align: center;
        margin: 0 0 40px 0;
    }

    .form-text h1 {
        color: #211b1b;
        font-family: 'Akaya Telivigala', cursive;
        font-size: 40px;
        margin-bottom: 20px;
    }

    .form-text p {
        color: #272626;
        font-family: 'Akaya Telivigala', cursive;
        font-size: large;
    }

    .main-form div {
        margin: 10px 10px;
        width: 400px;
        display: inline-block;
    }


    .main-form div input {
        width: 100%;
        font-family: 'Akaya Telivigala', cursive;
        background: none;
        border: 1px solid #888;
        font-size: 15px;
        outline: none;
        padding: 3px 0 3px 10px;
        margin-top: 10px;
    }

    .main-form div span {
        width: 100%;
        font-family: 'Akaya Telivigala', cursive;
        font-size: 15px;
    }


    #submit {
        width: 100%;
        text-align: center;
        cursor: pointer;
    }

    #submit input {
        font-family: 'Akaya Telivigala', cursive;
        width: 150px;
        height: 35px;
        color: #fff;
        background: #2d6a4f;
        border-radius: 6px;
        padding: 0;
        cursor: pointer;
        transition: all 0.4s ease;
    }

    #submit input:hover {
        font-family: 'Akaya Telivigala', cursive;
        width: 150px;
        background: #1b4332;
    }

    #close-error {
        font-size: 24px;
        font-weight: bold;
    }
</style>
<div id="myModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Please Fill Up given form to Finish the appointment</h2>
        </div>
        <div class="modal-body">
            <div id="error-message" style="color: red; text-align: center; display: none;">
                <span id="error-text"></span>
                <span id="close-error" style="cursor: pointer; float: right;">&times;</span>
            </div>
            <div class="main-form">
                <form action="" method="post" name="myForm" onsubmit="return validateForm()">
                    <input type="hidden" name="appointmentId" id="appointmentId">
                    <div>
                        <span>What was the fee charged for the appointment?</span>
                        <input type="tel" name="fee" id="fee" placeholder="What was the fee charged for the appointment..." required>
                    </div>
                    <div>
                        <span>What is the patient's primary concern or main issue?</span>
                        <input type="text" name="issue" id="issue" placeholder="Write all the issues..." required>
                    </div>
                    <div>
                        <span>What medicines did you recommend?</span>
                        <input type="text" name="medicine" id="medicine" placeholder="Write name of medicines separate by comma..." required>
                    </div>
                    <div>
                        <span>What was the time of appointment?</span>
                        <input type="text" name="time" id="time" placeholder="Please enter the time in the format: 3:30 pm" required>
                    </div>
            </div>
            <div id="submit">
                <input type="submit" value="SUBMIT" id="submit" name="submit">
            </div>
            </form>
        </div>
        <div class="modal-footer">
            <h4>Warning: Incorrectly filled forms may lead to removal of your account.</h4>
        </div>
    </div>
</div>
<?php
require '../../actions/Connection.php';
if (isset($_POST['submit'])) {
    $fee = $_POST['fee'];
    $issue = $_POST['issue'];
    $medicine = $_POST['medicine'];
    $time = $_POST['time'];
    $appointmentId = $_POST['appointmentId'];
    $pattern = '/^(1[0-2]|0?[1-9]):[0-5][0-9] [ap]m$/i';
    if (empty($fee) || empty($issue) || empty($medicine) || empty($time)) {
        $_SESSION['error_message'] = 'Please fill in all fields!';
    } elseif (!preg_match($pattern, $time)) {
        $_SESSION['error_message'] = 'Invalid time format. Please use the format: 3:30 pm.';
    } elseif (!is_numeric($fee) || $fee <= 0) {
        $_SESSION['error_message'] = 'Invalid fee. Please enter a valid positive number.';
    } elseif (strlen($issue) < 5) {
        $_SESSION['error_message'] = 'Invalid issue. Please provide more details.';
    } elseif (is_numeric($medicine)) {
        $_SESSION['error_message'] = 'Medicine field cannot be fully numeric.';
    } else {
        $success = true;
        $sql = "INSERT INTO appointment_feedback VALUES ('', '$appointmentId', '$fee', '$issue', '$medicine', '$time')";
        $conn->query($sql);
        $updateQuery = "UPDATE appointments SET status = 'Success' WHERE ID = $appointmentId";
        $action = $conn->query($updateQuery);
        $_SESSION['endBook'] = true;
        if (!$action) {
            $success = false;
        }
        if ($success) {
            echo "<script>window.location.href = 'appointment.php'</script>";
        }
    }
    echo "<script>window.location.href = 'appointment.php'</script>";
    exit();
}
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    if (window.history.replaceState)
        {
            window.history.replaceState(null, null, window.location.href);
        }
    function toggleErrorMessage(show) {
        var errorMessageDiv = document.getElementById("error-message");
        errorMessageDiv.style.display = show ? "block" : "none";
    }

    // Function to set and clear error messages
    function setErrorText(text) {
        var errorText = document.getElementById("error-text");
        errorText.innerHTML = text;
    }

    // Function to clear error messages
    function clearErrorText() {
        setErrorText("");
    }

    // Function to handle the close button click
    document.getElementById("close-error").addEventListener("click", function() {
        toggleErrorMessage(false);
        clearErrorText();
    });

    function validateForm() {
        var fee = document.forms["myForm"]["fee"].value;
        var issue = document.forms["myForm"]["issue"].value;
        var medicine = document.forms["myForm"]["medicine"].value;
        var time = document.forms["myForm"]["time"].value;
        var pattern = /^(0[1-9]|1[0-2]):[0-5][0-9] (AM|PM)$/i;

        // Error message element
        var errorMessageDiv = document.getElementById("error-message");

        if (fee === "" || issue === "" || medicine === "" || time === "") {
            setErrorText("Error: Please fill in all fields!");
            toggleErrorMessage(true);
            return false;
        }

        if (!/^(1[0-2]|0?[1-9]):[0-5][0-9] [ap]m$/i.test(time)) {
            setErrorText("Error: Invalid time format. Please use the format: 3:30 pm.");
            toggleErrorMessage(true);
            return false;
        }

        if (isNaN(fee) || fee <= 0) {
            setErrorText("Error: Invalid fee. Please enter a valid positive number.");
            toggleErrorMessage(true);
            return false;
        }

        if (issue.length < 5) {
            setErrorText("Error: Invalid issue. Please provide more details.");
            toggleErrorMessage(true);
            return false;
        }

        if (!isNaN(medicine)) {
            setErrorText("Error: Medicine field cannot be fully numeric.");
            toggleErrorMessage(true);
            return false;
        }

        // Clear any previous error messages if all validations pass
        clearErrorText();
        toggleErrorMessage(false);

        return true;
    }
</script>