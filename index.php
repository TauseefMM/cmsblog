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
                $per_page = 5;
                if(isset($_GET['page'])){
                    $page_index = $_GET['page'];
                }else{                    
                    $page_index = "";
                }
                $post_page_index = 0 ;
                if($page_index == "" || $page_index == 1){
                    $post_page_index = 0;
                }else{ 
                    $post_page_index = ($page_index * $per_page) - $per_page;
                }

                   if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin'){
                         $query = "SELECT * FROM posts";
                   }else{
                         $query = "SELECT * FROM posts WHERE post_status = 'Published' ";
                   }
                      

                // $query = "SELECT * FROM posts WHERE post_status = 'Published'";
                $count_post_query = mysqli_query($connection,$query);
                $total_post = mysqli_num_rows($count_post_query);
                if($total_post < 1){
                    echo "<h1 class='text-center   '>NO POSTS AVAIABLE </h1>";
                }else{

                $count = ceil($total_post / $per_page);

                        $query = "SELECT * FROM posts LIMIT $post_page_index ,$per_page ";
                        $select_all_post_query = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($select_all_post_query)){
                            $post_id = $row['post_id'];                            
                            $post_title = $row['post_title'];                            
                            $post_user = $row['post_user'];
                            $post_date = $row['post_date'];                            
                            $post_image = $row['post_image'];
                            $post_content = substr($row['post_content'],0,400);
                            $post_status = $row['post_status'];
                                                          
                 ?>
            
                    <!-- First Blog Post -->
                    <h2>
                        <a href="post/<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author_posts.php?author=<?php echo $post_user; ?>"><?php echo $post_user; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                    <hr>
                    <a href="post/<?php echo $post_id; ?>">
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                    </a>
                    <hr>
                    <p><?php echo $post_content; ?></p>
                    <a class="btn btn-primary" href="post/<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
                        <?php } } ?>
        </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include("includes/sidebar.php"); ?>            

            
        </div>
        <!-- /.row -->
             <div class="container text-center">
                    <ul class="pagination">
                        <?php
                        for($i =1; $i <=  $count; $i++){
                            if($i == $page_index)
                            {
                                echo "<li class='active'><a href='index.php?page={$i}' class='active'>{$i}</li>";
                            }else{
                                echo "<li><a href='index.php?page={$i}'>{$i}</li>";
                            }
                        }
                        ?>
                    </ul>
            </div>
        <hr>
        
        <!-- Footer -->
    <?php include("includes/footer.php"); ?>