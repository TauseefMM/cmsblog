 <?php include("includes/admin_header.php"); ?>
 <div id="wrapper">
     <!-- Navigation -->
    <?php include("includes/admin_navigation.php"); ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Comment  Post Page
                            <small>Author</small>
                        </h1>
                            <table class="table table-bordered table-hover">
                              <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>Author</th>
                                      <th>Comment</th>
                                      <th>Email</th>
                                      <th>Status</th>
                                      <th>In Response To</th>
                                      <th>Date</th>
                                      <th>Approve</th>
                                      <th>Unapprove</th>
                                      <th>Delete</th>
                                  </tr>
                              </thead>
                              <tbody>
                                 <?php 
                                        if(isset($_GET['comment_post_id'])){
                                            $comment_post_id = $_GET['comment_post_id'];
                                        }
                                        $query = "SELECT * FROM comments WHERE comment_post_id = {$comment_post_id}";
                                        $show_all_comment = mysqli_query($connection,$query);

                                        while($row = mysqli_fetch_assoc($show_all_comment)){
                                            $comment_id = $row['comment_id'];
                                            $comment_post_id = $row['comment_post_id'];                                           
                                            $comment_author = $row['comment_author'];                                    
                                            $comment_email = $row['comment_email'];
                                            $comment_content = $row['comment_content'];
                                            $comment_status= $row['comment_status'];
                                            $comment_date = $row['comment_date'];

                                            echo "<tr>";
                                            echo "<td>{$comment_id}</td>";                                            
                                            echo "<td>{$comment_author}</td>";                             
                                            echo "<td>{$comment_content}</td>";  
                                            echo "<td>{$comment_email}</td>";                                       
                                            echo "<td>{$comment_status}</td>";
                                            
                                            $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
                                            $redirect_to_post_query = mysqli_query($connection,$query);
                                            confirmQuery($redirect_to_post_query);
                                            while($row = mysqli_fetch_assoc($redirect_to_post_query)){
                                                 $post_title = $row['post_title'];          
                                                 $post_id = $row['post_id']; 
                                                 echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</td>";  
                                            }
                                                                                
                                            echo "<td>{$comment_date}</td>";   
                                            echo "<td><a href='post_comment.php?approve={$comment_id}&comment_post_id={$comment_post_id}'>Approve</a></td>";
                                            echo "<td><a href='post_comment.php?unapprove={$comment_id}&comment_post_id={$comment_post_id}'>Unapprove</a></td>";
                                            echo "<td><a href='post_comment.php?delete_comment_by_id={$comment_id}&comment_post_id={$comment_post_id}'>Delete</a></td>";
                                            echo "</tr>";
                                        }
                                  ?>
                              </tbody>
                            </table>


                            <?php 
                            if(isset($_GET['delete_comment_by_id'])){
                                $delete_comment_by_id = $_GET['delete_comment_by_id'];
                           
                                echo $query = "DELETE FROM comments WHERE comment_id = {$delete_comment_by_id} ";
                                $delete_comment_data = mysqli_query($connection,$query);
                                confirmQuery($delete_comment_data);
                                header("Location: post_comment.php?comment_post_id={$post_id}");
                            }

                            if(isset($_GET['approve'])){
                                $apppove_comment_status = $_GET['approve'];
                                echo $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$apppove_comment_status} "; 
                                $apppove_comment_status = mysqli_query($connection,$query);
                                confirmQuery($apppove_comment_status);
                                header("Location: post_comment.php?comment_post_id={$post_id}");
                            }

                            if(isset($_GET['unapprove'])){
                                $unapppove_comment_status = $_GET['unapprove'];
                                echo $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = {$unapppove_comment_status} "; 
                                $unapppove_comment_status = mysqli_query($connection,$query);
                                confirmQuery($unapppove_comment_status);
                                header("Location: post_comment.php?comment_post_id={$post_id}");
                            }
                            ?>
              </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
    <?php include("includes/admin_footer.php"); ?>