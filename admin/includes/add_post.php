<?php
    if(isset($_POST['create_post'])){
        $post_category_id = $_POST['post_category_id'];                                           
        $post_title = $_POST['post_title'];                                    
        // $post_author = $_POST['post_author'];
        $post_user = $_POST['post_user'];
        $post_date = date('d-m-y');
        
        $post_image = $_FILES['post_image']['name'];        
        $post_image_temp = $_FILES['post_image']['tmp_name'];

        
        $post_content = strip_tags($_POST['post_content']); 
        $post_tags = $_POST['post_tags'];
//        $post_comment_count = 2;
        $post_status = $_POST['post_status'];
        
        move_uploaded_file($post_image_temp,"../images/{$post_image}");
        
        $query = " INSERT INTO `posts`(`post_category_id`, `post_title`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`) VALUES ({$post_category_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";
       
        $create_post_query = mysqli_query($connection,$query);
        
        $last_insert_post_id = mysqli_insert_id($connection);
        
        confirmQuery($create_post_query);
        "<p class='bg-success'>Post Created : <a href = '../post.php?p_id={$last_insert_post_id}'>View Post</a>|<a href = 'posts.php'>Edit More Posts</a></p>";
    }
?> 
     <form action="" method="post" enctype="multipart/form-data">    
      <div class="form-group">
         <label for="title">Post Title</label>
          <input type="text" class="form-control" name="post_title">
      </div>

     <div class="form-group">
       <label for="category">Category</label>
       <select name="post_category_id" id="" class="form-control">   
    <?php  $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection,$query);
            confirmQuery($select_categories);
            while($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<option value='$cat_id'>{$cat_title}</option>";
             } ?>
        </select>
      </div>
      <div class="form-group">
           <label for="users">Users</label>
           <select name="post_user" id="" class="form-control">
 <?php
            $users_query = "SELECT * FROM users";
            $select_users = mysqli_query($connection,$users_query);
          //  confirmQuery($select_users);
            while($row = mysqli_fetch_assoc($select_users)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
                echo "<option value='{$username}'>{$username}</option>";
            } ?>
            </select>
      </div>
     <div class="form-group">
         <label for="post_status">Post Status</label>
         <select name="post_status" id="" class="form-control">
             <option value="Draft">Post Status</option>
             <option value="Published">Published</option>
             <option value="Draft">Draft</option>
         </select>
      </div>
       <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="post_image" class="form-control">
      </div>
      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" name="post_tags">
      </div>
      <div class="form-group">
         <label for="summernote">Post Content</label>
         <textarea name="post_content" id="summernote"></textarea>
      </div>
      <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
      </div>
</form>
    