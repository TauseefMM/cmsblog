<?php include("delete_modal.php"); ?>
<?php 
    if(isset($_POST['checkBoxArray'])){
        foreach($_POST['checkBoxArray'] as $postValueId){
            $bulk_option = $_POST['bulk_options'];
            switch($bulk_option){
                case 'Published':
                    $query = "UPDATE posts SET post_status = '{$bulk_option}' WHERE post_id = {$postValueId} ";
                    $update_to_published_status = mysqli_query($connection,$query);
                    confirmQuery($update_to_published_status);
                break;
                case 'Draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_option}' WHERE post_id = {$postValueId} ";
                    $update_to_Draft_status = mysqli_query($connection,$query);
                    confirmQuery($update_to_Draft_status);
                break;
                case 'Delete':
                    $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
                    $delete_posts = mysqli_query($connection,$query);
                    confirmQuery($delete_posts);
                break;
                case 'Clone':
                    $query = "SELECT * FROM posts WHERE post_id = {$postValueId} ";
                    $post_record = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($post_record)){
                        $post_id = $row['post_id'];
                        $post_category_id = $row['post_category_id'];                                           
                        $post_title = $row['post_title'];                                    
                        $post_author = $row['post_author'];
                        $post_user = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_tags = $row['post_tags'];
                        $post_comment_count = $row['post_comment_count'];
                        $post_status = $row['post_status'];
                    }
                    $query = " INSERT INTO `posts`(`post_category_id`, `post_title`, `post_author`,`post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`) VALUES ({$post_category_id},'{$post_title}','{$post_author}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";
                    $create_clone_post_query = mysqli_query($connection,$query);
                    confirmQuery($create_clone_post_query);               
                break;
            }
        }
    }
?>
    <form action="" method="post">
     <div id="bulkOptionContainer" class="col-xs-4">
         <select class="form-control" name="bulk_options" id="">
             <option value="">Select Option</option>
             <option value="Published">Published</option>
             <option value="Draft">Draft</option>
             <option value="Delete">Delete</option>             
             <option value="Clone">Clone</option>

         </select>
     </div>
     <div class="col-xs-4">
         <input type="submit" name="submit" class="btn btn-success" value="Apply">
         <a class="btn btn-primary" href="posts.php?source=add_post"> Add New</a>
     </div>
     <br>
     <table class="table table-bordered table-hover">
      <thead>
          <tr>
             <th><input id="selectAllBoxes" type="checkbox"></th>
              <th>ID</th>
              <th>Users</th>
              <th>Title</th>
              <th>Categories</th>
              <th>Status</th>
              <th>Image</th>
              <th>Tags</th>
              <th>Comments</th>
              <th>Date</th>
              <th>Views Count</th>
              <th>Redirect To Post</th>
              <th colspan="2" class="text-center">Action</th>
              <th>Reset View count</th>
          </tr>
      </thead>
      <tbody>
         <?php 
                $query = "SELECT * FROM posts pts LEFT JOIN categories cat ON cat.cat_id = pts.post_category_id ORDER BY pts.post_id DESC";
                $show_all_Post = mysqli_query($connection,$query);

                while($row = mysqli_fetch_assoc($show_all_Post)){
                    $post_id = $row['post_id'];
                    $post_category_id = $row['post_category_id'];                                           
                    $post_title = $row['post_title'];                                    
                    $post_author = $row['post_author'];
                    $post_user = $row['post_user'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_status = $row['post_status'];
                    $post_views_count = $row['post_views_count'];
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];

                    echo "<tr>";
                    ?>
                    <td><input class ='checkBoxes' type='checkbox' name='checkBoxArray[]' value="<?php echo $post_id; ?>"></td>
                    <?php
                    echo "<td>{$post_id}</td>";  
                   
                    if(!empty($post_author)){
                        echo "<td>{$post_author}</td>";
                    }elseif (!empty($post_user)){
                        echo "<td>{$post_user}</td>";                                                     
                    }  

                    echo "<td>{$post_title}</td>";  
                    echo "<td>{$cat_title}</td>";                                       
                    echo "<td>{$post_status}</td>";                                       
                    echo "<td><img width='100' src='../images/{$post_image}'></td>";                                       
                    echo "<td>{$post_tags}</td>"; 
                    $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id}";
                    $send_comment_query = mysqli_query($connection,$query);

                    $row = mysqli_fetch_array($send_comment_query);
                    $comment_id = $row['comment_id'];
                    $count_comments = mysqli_num_rows($send_comment_query);


                    echo "<td><a href='post_comment.php?comment_post_id={$post_id}'>{$count_comments}</a></td>";                            
                    echo "<td>{$post_date}</td>";                    
                    echo "<td>{$post_views_count}</td>"; 
                    echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                    ?>
                        <form action="post">
                            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                          <?php echo '<td><input class="btn btn-danger delete_link" type="submit" name="delete_post_id" href="javascript:void(0)" value= "Delete"></td>';  ?>  
                        </form>
                    <?php

                    // echo "<td><a rel='{$post_id}' href='javascript:void(0)' class='delete_link'>Delete</a></td>";

                    // echo "<td><a onClick=\" javascript: return confirm('Are You Sure You Want To Delete'); \" href='posts.php?delete_post_id={$post_id}'>Delete</a></td>";
                    echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}' class='btn btn-info'>Edit</a></td>";
                    echo "<td><a href='posts.php?reset={$post_id}' class='btn btn-primary'>{$post_views_count}</a></td>";
                    echo "</tr>";
                }
          ?>
      </tbody>
    </table>
</form>

<?php 
if(isset($_POST['variable']['delete_post_id'])){
    $delete_post_id = $_GET['delete_post_id'];
    $query = "DELETE FROM posts WHERE post_id = {$delete_post_id} "; 
    $delete_post_data = mysqli_query($connection,$query);
    confirmQuery($delete_post_data);
    header("Location: posts.php");
}
if(isset($_GET['reset'])){
    $reset_view_post_id = $_GET['reset'];
    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =". mysqli_real_escape_string($connection,$_GET['reset']) ." "; 
    $reset_query = mysqli_query($connection,$query);
    confirmQuery($reset_query);
    header("Location: posts.php");
}
?>
<script>
    
    $(document).ready(function(){
        $(".delete_link").on('click',function(e){
            e.preventDefault();
            console.log("test");
            var id = $(this).attr("rel");
             console.log("id",id);
            var delete_url = "posts.php?delete_post_id="+ id + " ";
             console.log("delete_url",id);

            $(".modal_delete_link").attr("href", delete_url);
            $("#myModal").modal('show');

        });
    });
</script>