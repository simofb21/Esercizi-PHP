<?php
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
session_start();
session_destroy();
header("Location: login.php");
exit();
?>