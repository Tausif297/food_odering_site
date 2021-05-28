<?php 
//include constants.php file here 
include('../config/constants.php');
//get the id of admin to delte
$id= $_GET['id'];
//create sql query to delete the admin 
$sql ="DELETE FROM tbl_admin WHERE id=$id";
//execute the query 
$res = mysqli_query($conn, $sql);
if ($res==true) {
    //session variable to display message
    $_SESSION['delete'] = "<div class='success'>Admin deleted sucessfully</div>";
    //redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
} else {
    $_SESSION['delete'] = "<div class='error'>Failed to delete admin try again later</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}

//redirect to manage admin page with message (succes/error)
?>