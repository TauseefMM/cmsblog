<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

    <!-- Navigation -->
    <?php  include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <?php 
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $username = trim($_POST['username']);
            $email    = trim($_POST['email']);
            $password = trim($_POST['password']);
            $error = [
                'username' => '',
                'email' => '',
                'password' => ''
            ];

            if(strlen($username) < 4){
                $error['username'] = 'Username need to be longer';
            }

            if($username ==  ''){
                $error['username'] = 'Username Can not be Empty';
            }

            if(username_exists($username)){
                $error['username'] = 'Username Already exists, Pick Another One.';
            }

            if($email == ''){
                $error['email'] = 'Email Can not be Empty.';
            }

            if(email_exists($email)){
                $error['email'] = 'Email Already exists, <a href = "index.php">Please Login</a>';
            }
            
            if($password == ''){
                 $error['password'] = 'Password Can not be Empty.';
            }

            foreach($error as $key => $value){
                if(empty($value)){
                    unset($error[$key]);
                }
            }
            if(empty($error)){
                register_user($username,$email,$password);
                login_user($username,$password);
            }
        }

    ?>
    <div class="container">
        <section id="login">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-wrap">
                        <h1>Register</h1>
                            <form role="form" action="" method="post" id="login-form" autocomplete="off">
                                <div class="form-group">
                                    <label for="username" class="sr-only">username</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" autocomplete="on" value="<?php isset($username) ? $username : '' ?>">
                                    <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
                                </div>
                                 <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" autocomplete="on" value="<?php isset($email) ? $email : '' ?>">
                                    <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
                                </div>
                                 <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="key" class="form-control" placeholder="Password" autocomplete="off">
                                    <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
                                </div>

                                <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                            </form>

                        </div>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </section>
        <hr>

<?php include "includes/footer.php";?>
