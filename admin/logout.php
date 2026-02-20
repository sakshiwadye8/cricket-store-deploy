<?php 
    // Include constants.php for SITEURL
    include('../config/constants.php');

    // Destroy the Admin Session
    unset($_SESSION['admin']);

    // Redirect to Login Page
    header('location:'.SITEURL.'admin/login.php');
?>
