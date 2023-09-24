<?php
require './actions/Connection.php';

    if(isset($_POST['doc-submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM user WHERE username='$username' AND password='$password' AND Role_id=1";
        $user= $conn->query($sql);
        if($user->num_rows > 0){
            $user = $user->fetch_assoc();
            $_SESSION['id'] =  $user['Id'];
            $_SESSION['username'] = $user['Username'];
            $_SESSION['role']= $user['Role_id'];
            $_SESSION['name']=$user['Name'];
            header('location: ./pages/docdashboard.php');
        }
        else
        {echo "<script>alert('Not Valid')</script>";
        }
    }
    if(isset($_POST['pat-submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM user WHERE username='$username' AND password='$password' AND Role_id=2";
        $user= $conn->query($sql);
        if($user->num_rows > 0){
            $user = $user->fetch_assoc();
            $_SESSION['id'] =  $user['Id'];
            $_SESSION['username'] = $user['Username'];
            $_SESSION['role']= $user['Role_id'];
            $_SESSION['name']=$user['Name'];
            header('location: ./pages/patdashboard.php');
        }
        else
        {echo "<script>alert('Not Valid')</script>";
        }
    }
?>