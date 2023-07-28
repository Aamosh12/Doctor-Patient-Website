<?php
session_start();
require './actions/Connection.php';

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $user= $conn->query($sql);
        if($user->num_rows > 0){
            $user = $user->fetch_assoc();
            $_SESSION['username'] = $user['username'];
            $_SESSION['role']= $user['Role_id'];
            $_SESSION['name']=$user['name'];
            if($user['Role_id'] == 1){
            header('location: ./pages/docdashboard.php');
            }
            elseif($user['Role_id'] == 2){
                header('location: ./pages/patdashboard.php'); 
            }
            elseif($user['Role_id'] == 3)
            {
                header('location: ./pages/admdashboard.php');
            }
        }
        else
        {echo "<script>alert('Not Valid')</script>";
        }
    }
?>
<div id="loginDiv">
    <div id="login-form">
        <div id="xmark" onclick="hideLogin()"></div>
        <i class="fa-regular fa-xmark" id="cross" onclick="hideLogin()"></i>
        <div class="button-form">
            <div id="btn"></div>
            <button type="button" onclick="login()" class="top-btn">Log In</button>
            <button type="button" onclick="register()" class="top-btn">Register</button>

            <form action="" id="login" class="input-group-login" method="post">
                <input type="text" class="input-field" placeholder="Username" name="username" required>
                <input type="password" class="input-field" placeholder="Enter Password" name="password" required>
                <br><br>
                <button type="submit" class="submit-btn" name="login">Log In</button>
            </form>
            <?php
            include './index-content/registration.php';
            ?>
        </div>
    </div>
</div>
<script>
    function hideLogin(){
    document.getElementById('loginDiv').style.display='none';
    document.getElementById('main_content').style.display='block';
    }
</script>