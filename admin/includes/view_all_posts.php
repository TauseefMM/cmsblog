<table class="table table-bordered table-hover">
  <thead>
      <tr>
          <th>ID</th>
          <th>Author</th>
          <th>Title</th>
          <th>Categories</th>
          <th>Status</th>
          <th>Image</th>
          <th>Tags</th>
          <th>Comments</th>
          <th>Date</th>
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
                echo "<td><a href='posts.php?delete_post_id={$post_id}'>Delete</a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "</tr>";
            }
      ?>
  </tbody>
</table>


<?php 
if(isset($_GET['delete_post_id'])){
    $delete_post_id = $_GET['delete_post_id'];
    echo $query = "DELETE FROM posts WHERE post_id = {$delete_post_id} "; 
    $delete_post_data = mysqli_query($connection,$query);
    confirmQuery($delete_post_data);
    header("Location: posts.php");
}
?>