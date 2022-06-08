    <?php include("includes/db.php"); ?>
    <?php include("includes/header.php"); ?>

    <!-- Navigation -->
    <?php include("includes/navigation.php"); ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php 
                if(isset($_GET['p_id'])){
                   $view_post_id = $_GET['p_id'];
                   // $query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$view_post_id}";
                   //  $post_views_count = mysqli_query($connection,$query);
                   //  if(!$post_views_count){
                   //      die("QUERY FAILED : " . mysqli_error($connection) .' '. mysqli_errno($connection));
                   //  }
                    $query = "SELECT * FROM posts WHERE post_id = {$view_post_id}";
                    $select_all_post_query = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select_all_post_query)){
                        $post_title = $row['post_title'];                            
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];                            
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                  
                 ?>
                    <h1 class="page-header">
                        Page Heading
                    <small>Secondary Text</small>
                    </h1>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="#"><?php echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                    <hr>
                    <p><?php echo $post_content; ?></p>
                    <hr>
                    <?php } ?>
               
                <!-- Blog Comments -->
                    <?php 
                        if(isset($_POST['create_comment'])){
                            $comment_post_id = $_GET['p_id'];
                            $comment_author = $_POST['comment_author'];
                            $comment_email  = $_POST['comment_email'];
                            $comment_content= $_POST['comment_content'];
                            if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                                $query = "INSERT INTO `comments`(`comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES ({$comment_post_id},'{$comment_author}','{$comment_email}','{$comment_content}','Unapprove',now())";

                                $comment_on_post_query = mysqli_query($connection,$query);
                                // confirmQuery($comment_on_post_query);

                                // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $comment_post_id ";
                                // $update_comment_count = mysqli_query($connection,$query);
                                // //confirmQuery($update_comment_count);
                            }else{
                                $message = "All Field Are Required.";
                                echo "<script type='text/javascript'>alert('$message');</script>";
                            }
                        }
                    ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                       <div class="form-group">
                           <label for="comment_author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                           <label for="comment_email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="comment_content">Your Comment</label>
                            <textarea class="form-control" name="comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                        $query = "SELECT * FROM comments WHERE comment_post_id = {$view_post_id} AND comment_status = 'approved' ORDER BY comment_id DESC ";
                        $show_all_comment_on_post = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($show_all_comment_on_post)){
                            $comment_date = $row['comment_date'];                                           
                            $comment_author = $row['comment_author'];                                    
                            $comment_content = $row['comment_content'];
                        ?>
                            <!-- Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $comment_author ?>
                                    <small><?php echo $comment_date ?></small>
                                </h4>
                                <?php echo $comment_content ?>
                            </div>
                        </div>
                    <?php } }else{
                    header("Location: index.php");
                } ?>
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include("includes/sidebar.php"); ?>            

        </div>
        <!-- /.row -->
        <hr>
        <!-- Footer -->
    <?php include("includes/footer.php"); ?>