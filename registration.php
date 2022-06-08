<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
    <!-- Navigation -->
    <?php  include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <?php 
        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $email    = $_POST['email'];
            $password = $_POST['password'];
            if(!empty($username) && !empty($email) && !empty($password)){ 
                $username = mysqli_real_escape_string($connection,$username);         
                $password = mysqli_real_escape_string($connection,$password);
                $email = mysqli_real_escape_string($connection,$email);

                $password = password_hash($password, PASSWORD_BCRYPT,array('cost' => 12));

                // $query = "SELECT randSalt FROM users";
                // $get_randsalt_query = mysqli_query($connection,$query);
                // if(!$get_randsalt_query){
                //     die("QUERY FAILED : " . mysqli_erorr($connection) . ' ' . mysqli_errorno($connection)); 
                // }
                
                // $row = mysqli_fetch_array($get_randsalt_query);
                // $salt = $row['randSalt']; 
                // $password = crypt($password,$salt);

                $query = "INSERT INTO `users`(`username`, `user_password`, `user_email`, `user_role`)";
                $query .= "VALUES ('{$username}','{$password}','{$email}','Subscriber') ";
                $create_registration_query = mysqli_query($connection,$query);
                if(!$create_registration_query){
                    die("QUERY FAILED : " . mysqli_erorr($connection) . ' ' . mysqli_errorno($connection)); 
                }
                $message = "Your Registration Has Been Submitted";
            }else{
                $message = "Fields Cannot be Empty..";
            }
        }else{
                $message = "";
        }

    ?>
    <div class="container">
        <section id="login">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-wrap">
                        <h1>Register</h1>
                            <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                               <h6 class="text-center"> <?php echo $message; ?></h6>
                                <div class="form-group">
                                    <label for="username" class="sr-only">username</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" autocomplete="off">
                                </div>
                                 <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" autocomplete="off">
                                </div>
                                 <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="key" class="form-control" placeholder="Password" autocomplete="off">
                                </div>

                                <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                            </form>

                        </div>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </section>
        <hr>

<?php include "includes/footer.php";?>
