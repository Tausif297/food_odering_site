<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1 style="color: lightgray;">Add Category</h1><br><br>
        <?php
            if (isset($_SESSION['add'])) 
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if (isset($_SESSION['upload'])) 
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br><br>
        <!-- add category form -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30" style=" background-color: grey;">
                <tr>
                    <td>Title :</td>
                    <td><input type="text" name="title" placeholder="Category Title"></td>
                </tr>
                <tr>
                    <td>Select Image :</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured :</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">NO
                    </td>
                </tr>
                <tr>
                    <td>Active :</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">NO
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- add category form end -->
        <?php  
            //checking button
            if(isset($_POST['submit']))
            {
                // echo "clicked";
                //get value from category form
                $title = $_POST['title'];
                //for radio input type we need to check weather the button is selected or not
                if (isset($_POST['featured'])) 
                {
                    //Get the value from form
                    $featured = $_POST['featured'];
                }
                else 
                {
                    //Set the default value
                    $featured = "No";
                }
                if (isset($_POST['active'])) 
                {
                    $active = $_POST['active'];
                }
                else 
                {
                    $active = "No";
                }
                    //check image is selected or not set value img name accordingly
                    // print_r($_FILES['image']);
                    // die(); //break the code here
                    if (isset($_FILES['image']['name'])) 
                    {
                        $image_name = $_FILES['image']['name'];
                        if ($image_name !="") {

                        //auto rename image
                        //extensions of image(jpg,png,gifetc)eg food-1.jpg
                        $ext = end(explode('.', $image_name));
                        //rename img
                        $image_name = "food_category_".rand(000, 999).'.'.$ext; //eg food_category_ random no will be from 000 to 999 then extension
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;
                        //upload image
                        $upload = move_uploaded_file($source_path, $destination_path);
                        //weather the image is uploded or not
                        if ($upload==false) {
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                            header('location:'.SITEURL.'admin/add-category.php');
                            //stop the process if we failed to upload img we dont want to upload data into database
                            die(); 
                        }
                    }
                }
                else 
                {
                    $image_name=""; //if failed to upload name should blank
                }
                // create sql query to insert a category into database
                $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";
                //execute the query and save in database
                $res = mysqli_query($conn, $sql);
                //chech weather the query executed or not and data added or not
                if ($res==true) 
                {
                    //query executed and category added 
                    $_SESSION['add'] = "<div class='success'>Category Added Successfuly</div>";
                    //redirect to manage-category.php page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else 
                {
                    //Failed to add
                    $_SESSION['add'] = "<div class='error'>Failed to add category</div>";
                    //redirect to manage-category.php page
                    header('location:'.SITEURL.'admin/add-category.php');
                }

            }
        ?>
    </div>
</div>
<?php include('partials/footer.php') ?>