<?php
include('../config/constants.php');
//check weather id and image name is set or not
if (isset($_GET['id']) AND isset($_GET['image_name'])) 
{
 $id = $_GET['id'];
 $image_name = $_GET['image_name'];
 if ($image_name !="") // to remove img from db while deleting category
 {
    $path = "../images/category/".$image_name;
    $remove = unlink($path);
    if ($remove==false) { //if its failed to remove img show error and stop the process
        $_SESSION['remove'] = "<div class='error'>Failed to Remove category image</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
        die();
    }
 }
    $sql = "DELETE FROM tbl_category WHERE id=$id"; //sql query del data  from db
    $res = mysqli_query($conn, $sql); //execute the query 
    if ($res==true) {
        $_SESSION['delete'] = "<div class='success'>Category deleted successfuly</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete category</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
}
else 
{
    header('location:'.SITEURL.'admin/manage-category.php');
}
?>