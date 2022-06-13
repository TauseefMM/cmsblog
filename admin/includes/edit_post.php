<?php

// get post record by id
    if(isset($_GET['p_id'])){
        $edit_post_id = $_GET['p_id'];
    }
    $query = "SELECT * FROM posts WHERE post_id = {$edit_post_id} ";
    $edit_post_record = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($edit_post_record)){
        $post_id = $row['post_id'];
        $post_category_id = $row['post_category_id'];                                           
        $post_title = $row['post_title'];                                    
        $post_user = $row['post_user'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_status = $row['post_status'];
    }

//  update post record 

    if(isset($_POST['update_post'])){
        $post_category_id = $_POST['post_category_id'];                                           
        $post_title = $_POST['post_title'];                                    
        $post_user = $_POST['post_user'];
        $post_date = date('d-m-y');
        
        $post_image = $_FILES['post_image']['name'];        
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        
        $post_content = mysqli_real_escape_string($connection,$_POST['post_content']); 
        $post_tags = $_POST['post_tags'];
        $post_status = $_POST['post_status'];
        
        move_uploaded_file($post_image_temp,"../images/{$post_image}");
        
        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = {$edit_post_id} ";
            $get_old_post_image = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($get_old_post_image)){
                $post_image = $row['post_image'];
            }
        }
        
        $query = "UPDATE `posts` SET `post_category_id`={$post_category_id},`post_title`='{$post_title}',`post_user`='{$post_user}',`post_date`= now(),`post_image`='{$post_image}',`post_content`='{$post_content}',`post_tags`='{$post_tags}',`post_status`='{$post_status}' WHERE `post_id` = {$edit_post_id} "; 
        $update_post_record_by_id = mysqli_query($connection,$query); 
        confirmQuery($update_post_record_by_id);
        echo "<p class='bg-success'>Post Updated : <a href = '../post.php?p_id={$edit_post_id}'>View Post</a>|<a href = 'posts.php'>Edit More Posts</a></p>";
    }
?>  
     <form action="" method="post" enctype="multipart/form-data">    
      <div class="form-group">
         <label for="title">Post Title</label>
          <input type="text" class="form-control" name="post_title" value="<?php echo $post_title?>">
      </div>

     <div class="form-group">
       <label for="category">Category</label>
       <select name="post_category_id" id="" class="form-control">  
    <?php  $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection,$query);
            confirmQuery($select_categories);
            while($row = mysqli_fetch_assoc($select_categories )) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<option value='$cat_id'>{$cat_title}</option>";
             } ?>
        </select>
      </div>
      <div class="form-group">
           <label for="users">Users</label>
           <select name="post_user" id="" class="form-control" >
 <?php
            echo "<option value='{$post_user}'>{$post_user}</option>";
            $users_query = "SELECT * FROM users";
            $select_users = mysqli_query($connection,$users_query);
            confirmQuery($select_users);
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
             <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
             <?php
                 if($post_status == 'Draft'){
                     echo "<option value='Published'>Published</option>";
                 }else{
                    echo "<option value='Draft'>Draft</option>"; 
                 }
             ?>
         </select>
      </div>
       <div class="form-group">
          <img src="../images/<?php echo $post_image?>" width="100" alt="<?php echo $post_image?>">
      </div>
       <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="post_image" class="form-control">
      </div>
      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags ?>">
      </div>
      <div class="form-group">
         <label for="summernote">Post Content</label>
         <textarea name="post_content" id="summernote"><?php echo $post_content ?></textarea>
      </div>
      <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_post" value="update Post">
      </div>
</form>
    