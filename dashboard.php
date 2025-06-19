<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login1.php");
    exit;
}

echo "Welcome, " . $_SESSION['name'] . " (" . $_SESSION['email'] . ")";
?>
