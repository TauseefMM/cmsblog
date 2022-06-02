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
                    $query = "SELECT posts WHERE post_id = {$postValueId} ";
                    $delete_posts = mysqli_query($connection,$query);
                    confirmQuery($delete_posts);
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
              <th>Author</th>
              <th>Title</th>
              <th>Categories</th>
              <th>Status</th>
              <th>Image</th>
              <th>Tags</th>
              <th>Comments</th>
              <th>Date</th>
              <th>View Post</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
         <?php 
                $query = "SELECT * FROM posts";
                $show_all_Post = mysqli_query($connection,$query);

                while($row = mysqli_fetch_assoc($show_all_Post)){
                    $post_id = $row['post_id'];
                    $post_category_id = $row['post_category_id'];                                           
                    $post_title = $row['post_title'];                                    
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_status = $row['post_status'];

                    echo "<tr>";
                    ?>
                    <td><input class ='checkBoxes' type='checkbox' name='checkBoxArray[]' value="<?php echo $post_id; ?>"></td>
                    <?php
                    echo "<td>{$post_id}</td>";                                            
                    echo "<td>{$post_author}</td>";                             
                    echo "<td>{$post_title}</td>";  
                    $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                    $get_category_title = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($get_category_title)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title']; 
                    }
                    echo "<td>{$cat_title}</td>";                                       
                    echo "<td>{$post_status}</td>";                                       
                    echo "<td><img width='100' src='../images/{$post_image}'></td>";                                       
                    echo "<td>{$post_tags}</td>";                                       
                    echo "<td>{$post_comment_count}</td>";                                        
                    echo "<td>{$post_date}</td>"; 
                    echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                    echo "<td><a href='posts.php?delete_post_id={$post_id}'>Delete</a></td>";
                    echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                    echo "</tr>";
                }
          ?>
      </tbody>
    </table>
</form>

<?php 
if(isset($_GET['delete_post_id'])){
    $delete_post_id = $_GET['delete_post_id'];
    $query = "DELETE FROM posts WHERE post_id = {$delete_post_id} "; 
    $delete_post_data = mysqli_query($connection,$query);
    confirmQuery($delete_post_data);
    header("Location: posts.php");
}
?>