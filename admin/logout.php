<?php 
    include('../config/constants.php');
    //destroy the session 
    session_destroy();//unsets $_SESSION['user'] and logout our system
    //redirect to  login page
    header('location:'.SITEURL.'admin/login.php');
?>