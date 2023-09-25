<?php
if (isset($_SESSION['mandatory']) ) {
    unset($_SESSION['mandatory']); // Unset the session variable to avoid showing the SweetAlert again on page refresh
    // Show the SweetAlert
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
        title: 'Oops...',
        text: 'All Fields are Mandatory',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>";
}
elseif (isset($_SESSION['namepattern']) ) {
    unset($_SESSION['namepattern']); // Unset the session variable to avoid showing the SweetAlert again on page refresh
    // Show the SweetAlert
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
        title: 'Oops...',
        text: 'Kindly note that the Name field should only consist of text characters, without any special symbols or numbers.',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>";
}
elseif (isset($_SESSION['addressPattern']) ) {
    unset($_SESSION['addressPattern']); // Unset the session variable to avoid showing the SweetAlert again on page refresh
    // Show the SweetAlert
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
        title: 'Oops...',
        text: 'Please enter a valid address',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>";
}
elseif (isset($_SESSION['usernamePattern']) ) {
    unset($_SESSION['usernamePattern']); // Unset the session variable to avoid showing the SweetAlert again on page refresh
    // Show the SweetAlert
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
        title: 'Oops...',
        text: 'Kindly note that the 'User Name' field should only consist of text characters or can be followed by numbers, without any special symbols, or spaces.',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>";
}
elseif (isset($_SESSION['degreePattern']) || isset($_SESSION['specialPattern'])) {
    unset($_SESSION['degreePattern']); // Unset the session variable to avoid showing the SweetAlert again on page refresh
    // Show the SweetAlert
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
        title: 'Oops...',
        text: 'Please enter a valid Degree or Specialization',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>";
}
elseif (isset($_SESSION['emailPattern']) ) {
    unset($_SESSION['emailPattern']); // Unset the session variable to avoid showing the SweetAlert again on page refresh
    // Show the SweetAlert
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
        title: 'Oops...',
        text: 'Kindly enter a valid email',
                showConfirmButton: false,
                timer: 3000
            });
        });
    </script>";
}
elseif (isset($_SESSION['phoneValidate']) ) {
    unset($_SESSION['phoneValidate']); // Unset the session variable to avoid showing the SweetAlert again on page refresh
    // Show the SweetAlert
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
        title: 'Oops...',
        text: 'Enter a valid Nepali number',
                showConfirmButton: false,
                timer: 3000
            });
        });
    </script>";
}
elseif (isset($_SESSION['nmcValidate']) ) {
    unset($_SESSION['nmcValidate']); // Unset the session variable to avoid showing the SweetAlert again on page refresh
    // Show the SweetAlert
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
        title: 'Oops...',
        text: 'NMC numbers are alway numeric',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>";
}
elseif (isset($_SESSION['registerValidate']) ) {
    unset($_SESSION['registerValidate']); // Unset the session variable to avoid showing the SweetAlert again on page refresh
    // Show the SweetAlert
    echo "<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })
      
      Toast.fire({
        icon: 'success',
        title: 'Registered successfully'
      })
    </script>";
}
?>