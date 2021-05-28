<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1 style="color: lightgrey;">Change password</h1>
        <br><br>
        <?php 
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }        
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td><input type="password" name="current_password" placeholder="Current Password"></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" placeholder="New Password"></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                </tr>
                <tr>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <td colspan="2"><input type="submit" name="submit" value="change password" class="btn-secondary"></td>
                </tr>
            </table>

        </form>
    </div>
</div>
<?php 
    // submit click or not
    if (isset($_POST['submit'])) {
        //get data from form 
        $id=$_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);
        //check weather the user with current id and password exist or not 
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
        $res = mysqli_query($conn, $sql);
        if ($res==true) {
            $count=mysqli_num_rows($res);
            if ($count==1) {
                //user exist and password can be changed 
                if ($new_password==$confirm_password) {
                    //update password
                    $sql2 = "UPDATE tbl_admin SET
                        password='$new_password'
                        WHERE id=$id
                    ";
                    $res2 = mysqli_query($conn, $sql);
                    //query executed or not
                    if ($res2==true) {
                        $_SESSION['change-pwd'] = "<div class='success'>Password changed succesfully</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else {
                        $_SESSION['change-pwd'] = "<div class='error'>Failed to change password</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');    
                    }
                }else {
                    //redirect to manage admin page with error msg 
                    $_SESSION['pwd-not-match'] = "<div class='error'>Password not matched</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }else{
                //user does not exist set message and redirect
                $_SESSION['user-not-found'] = "<div class='error'>User not found</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        //check weather the new password and confirm password match or not 

        //change password if all above is true 
    }
 ?>
<?php include('partials/footer.php'); ?>
