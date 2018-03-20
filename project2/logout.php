<?php
session_start();
unset($_SESSION['Username']);
unset($_SESSION['UserID']);
header("Location: login.php");

?>