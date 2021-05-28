<?php include('partials/menu.php'); ?>  
<div class="main-content">
    <div class="wrapper">
        <h1 style="color: lightgrey;">Add Admin</h1>
        <br><br>
        <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo$_SESSION['add'];//displaying sesseion message
                        unset($_SESSION['add']);//removing session message
                    }
               ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name :</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Username :</td>
                    <td><input type="text" name="username" placeholder="Enter your nickname"></td>
                </tr>
                <tr>
                    <td>Password :</td>
                    <td><input type="password" name="password" placeholder="Enter password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php') ?>
<?php 
//process the vlaue from form and save it into the database

//check weather the submit button is clicked or not  
if(isset($_POST['submit']))
{
    //get the data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //md5 to encrypt password
    //sql query to save data into database
    $sql = "INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
    ";  
    //executing querry and saving data into database 
    $res= mysqli_query($conn, $sql) or die(mysqli_error());
    //check weather the data is inserted or not
    if($res==TRUE){
        //create a session variable to display message
        $_SESSION['add'] = "<div class='success'>Admin Added Succesfully</div>";
        //redirectpage manage admin
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else{
        //create a session variable to display message
        $_SESSION['add'] = "<div class='error'>Failed To Add Admin</div>";
        //redirectpage add admin
        header("location:".SITEURL.'admin/add-admin.php');
    }
}
?>