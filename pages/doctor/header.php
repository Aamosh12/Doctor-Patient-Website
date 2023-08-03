<?php
$id = $_SESSION['id'];
$name = "SELECT Name FROM user WHERE Id = $id";
$nameResult = $conn->query($name);
$finalName = $nameResult->fetch_assoc();
?>
<header>
    <h3>
        <label for="">
            <i class="fa-solid fa-bars"></i>
        </label>
        Dashboard
    </h3>
    <div class="user">
        <div>
            <h4><i class="fa-solid fa-user"></i> <?php echo $finalName['Name']; ?></h4>
        </div>
    </div>
</header>