<?php
session_start();
session_unset();
unset($_SESSION['Role_id']);
unset($_SESSION['Username']);
session_destroy();
header("Location: ../../index.php");
exit();
?>