<?php
require '../../actions/Connection.php';
session_start();
require '../../actions/Connection.php';
if (!isset($_SESSION["role"])) {
    header("location: ../../index.php");
    exit();
} elseif ($_SESSION["role"] != 1) {
    header("location: ../../index.php");
    exit();
}
$id = $_SESSION['id'];
$sql = "SELECT * FROM user WHERE Id=$id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
function getValue($column)
{
    global $user;
    return $user[$column];
}
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $food = $_POST['food'];
    $password = $_POST['password'];

    $checkPassword = "SELECT Password FROM user WHERE Password='$password' AND Id='$id'";
    $result = $conn->query($checkPassword);
    if ($result->num_rows > 0) {
        $sql = "UPDATE user 
        SET Name = '$name', 
            Email = '$email', 
            Address = '$address', 
            Phone_Number = '$phone', 
            Food = '$food' 
        WHERE Id = '$id'";
        if($conn->query($sql)){
            header('Location: ../docdashboard.php');
           $_SESSION['update'] = true;
        }
    } else{
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Incorrect Password. Please try again.',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../../style/editprofile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close" style="margin-top: -8px;">&times;</span>
                        <h3>Please enter your password to update</h3>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" name="password" id="password" placeholder="Your Password">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn-submit" name="update">Update</button>
                    </div>
                </div>
            </div>
            <form action="" class="register active" method="post">
                <h2 class="title">Update your Profile</h2>
                <div class="form-group">
                    <label for="name">Name</label>
                    <div class="input-group">
                        <input type="text" id="name" name="name" autocomplete="off" value="<?php echo getValue('Name'); ?>" />
                        <i class="fa-regular fa-user"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <input type="email" id="email" name="email" autocomplete="off" value="<?php echo getValue('Email'); ?>" />
                        <i class="fa-regular fa-envelope"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <div class="input-group">
                        <input type="text" id="address" name="address" autocomplete="off" value="<?php echo getValue('Address'); ?>" />
                        <i class="fa-solid fa-map"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <div class="input-group">
                        <input type="tel" id="phone" name="phone" autocomplete="off" value="<?php echo getValue('Phone_Number'); ?>" />
                        <i class="fa-solid fa-mobile"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <input type="text" id="username" name="username" autocomplete="off" value="<?php echo getValue('Username'); ?>" />
                        <i class="fa-regular fa-user"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="food">Favourite Food</label>
                    <div class="input-group">
                        <input type="text" id="food" name="food" autocomplete="off" value="<?php echo getValue('Food'); ?>" />
                        <i class="fa-solid fa-burger"></i>
                    </div>
                </div>
                <button type="button" class="btn-submit" id="myBtn">Update</button>
            </form>
    </div>
    </form>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("myBtn");
        var span = document.getElementsByClassName("close")[0];
        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>