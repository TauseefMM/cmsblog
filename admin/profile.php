 <?php include("includes/admin_header.php"); ?>
 <?php 
        if(isset($_SESSION['username'])){
            $login_username = $_SESSION['username'];
            $query = "SELECT * FROM users WHERE username = '{$login_username}' ";
            $get_user_profile_data = mysqli_query($connection,$query);
            confirmQuery($get_user_profile_data);
            
               while($row = mysqli_fetch_assoc($get_user_profile_data)){
                $user_id = $row['user_id'];
                $username = $row['username'];                                           
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];                                    
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];
               }            
        }
        
        if(isset($_POST['edit_profile'])){
            $user_firstname = $_POST['user_firstname'];                                           
            $user_lastname = $_POST['user_lastname'];   
            $username = $_POST['username'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];                                 
            
            // $user_role = $_POST['user_role'];
            // $post_comment_count = 2;
            // $post_date = date('d-m-y');
            // $post_image = $_FILES['post_image']['name'];        
            // $post_image_temp = $_FILES['post_image']['tmp_name'];
            // move_uploaded_file($post_image_temp,"../images/{$post_image}");

            $query = "UPDATE `users` SET `username`='{$username}',`user_password`='{$user_password}',`user_firstname`='{$user_firstname}',`user_lastname`='{$user_lastname}',`user_email`='{$user_email}' WHERE username = '{$login_username}' ";
            $update_user_profile_by_id_query = mysqli_query($connection,$query);

            confirmQuery($update_user_profile_by_id_query);
            header("Location: users.php");
        }
?>
 <div id="wrapper">
     <!-- Navigation -->
    <?php include("includes/admin_navigation.php"); ?>
        
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                          <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="user_firstname">First Name</label>
                                <input type="text" class="form-control" name="user_firstname" value= "<?php echo $user_firstname ?>"> </div>
                            <div class="form-group">
                                <label for="user_lasstname">Last Name</label>
                                <input type="text" class="form-control" name="user_lastname" value= "<?php echo $user_lastname ?>"> </div>
                         <!--    <div class="form-group">
                                <label for="user_role">User Role</label>
                                <select name="user_role" id="" class="form-control">
                                    // <option value='subscriber'><?php echo $user_role; ?></option>
                                    <?php
                                    // if($user_role == 'Admin'){
                                    //     echo "<option value='Subscriber'>Subscriber</option>";
                                    // }else{
                                    //     echo "<option value='Admin'>Admin</option>";
                                    // }
                                    ?>

                                </select>
                            </div> -->
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" value= "<?php echo $username; ?>"> </div>
                            <div class="form-group">
                                <label for="user_email">User Email</label>
                                <input type="email" class="form-control" name="user_email" value= "<?php echo $user_email; ?>"> </div>
                            <div class="form-group">
                                <label for="user_password">Password</label>
                                <input type="password" class="form-control" name="user_password" autocomplete="off"> </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="edit_profile" value="Update Profile"> </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
    <?php include("includes/admin_footer.php"); ?>