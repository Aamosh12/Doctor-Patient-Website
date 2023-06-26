<div id="loginDiv">
    <div id="login-form">
        <div id="xmark" onclick="hideLogin()"></div>
        <i class="fa-sharp fa-solid fa-xmark" id="cross" onclick="hideLogin()"></i>
        <div class="button-form">
            <div id="btn"></div>
            <button type="button" onclick="login()" class="top-btn">Log In</button>
            <button type="button" onclick="register()" class="top-btn">Register</button>

            <form action="" id="login" class="input-group-login">
                <input type="text" class="input-field" placeholder="Email Id" required>
                <input type="password" class="input-field" placeholder="Enter Password" required>
                <br><br>
                <button type="button" class="submit-btn">Log In</button>
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