<?php include('../config/constants.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Login Food Order system</title>
</head>
<body class="login-body">
    <div class="login">
    <h1 class="text-center">Login</h1><br>
    <?php
        if(isset($_SESSION['login'])){
            echo$_SESSION['login'];//displaying sesseion message
            unset($_SESSION['login']);//removing session message
        }
        if (isset($_SESSION['no-login-message'])) {
            echo$_SESSION['no-login-message'];//displaying sesseion message
            unset($_SESSION['no-login-message']);//removing session message
        }
    ?><br><br>
        <!--login form start here -->
        <form action="" method="POST">
        <h4 class="h4-1">Username:</h4><br>
        <input type="text" name="username" placeholder="Enter Username" class="login-input"><br><br>
        <h4 class="h4-1">Password :</h4> <br>
        <input type="password" name="password" placeholder="Enter Password" class="login-input"><br><br>
        <input type="submit" value="Login" name="submit" class="btn-login"><br><br>
        </form>
        <!--login form end here -->
    <p class="text-center">created by zakaria tausif</p>
    </div>
</body>
</html>
<?php 
if(isset($_POST['submit'])){
    //process our login
    //get data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);
//sql to check username exist or not 
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    //execute the query 
    $res = mysqli_query($conn, $sql);
    //count row to check weather user exist or not
    $count = mysqli_num_rows($res);
    if ($count==1) {
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username; // to check weather the user is logged in or not 
        header("location:".SITEURL.'admin/');
    }else{
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not matched.</div>";
        header("location:".SITEURL.'admin/login.php');
    }
}
?>