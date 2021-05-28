<?php 
//authorization access control

//checking weather the user is loggeed in or not
if (!isset($_SESSION['user'])) { //if user section is not set 
    $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access admin pannel</div>";
    header('location:'.SITEURL.'admin/login.php');
}
?>