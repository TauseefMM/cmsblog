<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
    <!-- Navigation -->
    <?php  include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <?php 
        if(isset($_POST['submit'])){
            $to       = "mtauseef67@gmail.com";
            $subject  = wordwrap($_POST['subject'],70);
            $message  = $_POST['body'];
            $header   = "From : ". $_POST['email'];

            mail($to, $subject, $message, $header);
            
        }       

    ?>
    <div class="container">
        <section id="login">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-wrap">
                        <h1>Contact</h1>
                            <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                                <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email" autocomplete="off">
                                </div>
                                 <div class="form-group">
                                    <label for="subject" class="sr-only">Subject</label>
                                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Your subject" autocomplete="off">
                                </div>
                                 <div class="form-group">
                                    <textarea name="body" id="body" cols="76" rows="10"></textarea>
                                </div>

                                <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                            </form>

                        </div>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </section>
        <hr>

<?php include "includes/footer.php";?>
