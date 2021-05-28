<?php include('partials/menu.php'); ?>
    <!-- main content sections start-->
        <div class="main-content">
            <div class="wrapper">
               <h1 style="color: lightgrey;">Manage Admin</h1>
               <br> <br>
               <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo$_SESSION['add'];//displaying sesseion message
                        unset($_SESSION['add']);//removing session message
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if (isset($_SESSION['update'])) {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['user-not-found'])){
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }
                    if(isset($_SESSION['pwd-not-match'])){
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }
                    if(isset($_SESSION['change-pwd'])){
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }
               ?><br><br><br>
               <!-- button to add admin -->
               <a href="add-admin.php" class="btn-primary">Add Admin</a>
                <br> <br>
                <table class="tbl-full">
                    <tr>
                        <th>Serial No</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        //query to get all admin
                        $sql = "SELECT *FROM tbl_admin";
                        //execute the query
                        $res = mysqli_query($conn, $sql);
                        //chech weather the query is executed or  not
                        if($res==TRUE)
                        {
                            //count rows that we have in database
                            $count = mysqli_num_rows($res); //Function to get all rows in database
                            //check the  number of rows
                            $sn=1; //create and assigned the value 
                        if($count>0)
                        {
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                //using while loop to get all the data from database
                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $username=$rows['username'];

                                //display the  value in table
                                ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $full_name;?></td>
                                <td><?php echo $username;?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>&nbsp &nbsp
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?> " class="btn-secondary">Update Admin</a>&nbsp &nbsp
                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-dangoure">Delete</a>
                                </td>
                            </tr>
                                <?php
                            }
                        }
                        else{
                        }
                        }   
                    ?> 
              </table>
            </div>
            <div class="clearfix"></div>
        </div>
    <!-- main content sections ends-->
<?php include('partials/footer.php'); ?>


