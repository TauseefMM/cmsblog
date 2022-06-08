<?php 
    if(isset($_POST['checkBoxArray'])){
        foreach($_POST['checkBoxArray'] as $postValueId){
            $bulk_option = $_POST['bulk_options'];
            switch($bulk_option){
                case 'Approve':
                    $query = "UPDATE comments SET comment_status = '{$bulk_option}' WHERE comment_id = {$postValueId} ";
                    $update_to_approve_status = mysqli_query($connection,$query);
                    confirmQuery($update_to_approve_status);
                break;
                case 'Unapprove':
                    $query = "UPDATE comments SET comment_status = '{$bulk_option}' WHERE comment_id = {$postValueId} ";
                    $update_to_Unapprove_status = mysqli_query($connection,$query);
                    confirmQuery($update_to_Unapprove_status);
                break;
                case 'Delete':
                    $query = "DELETE FROM comments WHERE comment_id = {$postValueId} ";
                    $delete_comment = mysqli_query($connection,$query);
                    confirmQuery($delete_comment);
                break;
                case 'Clone':
                    $query = "SELECT * FROM comments WHERE comment_id = {$postValueId} ";
                    $comment_record = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($comment_record)){
                        $comment_id = $row['comment_id'];
                        $comment_post_id = $row['comment_post_id'];                                           
                        $comment_author = $row['comment_author'];                                    
                        $comment_email = $row['comment_email'];
                        $comment_content = $row['comment_content'];
                        $comment_status = $row['comment_status'];
                        $comment_date = $row['comment_date'];
                
                    }
                    $query = " INSERT INTO `comments`(`comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES ({$comment_post_id},'{$comment_author}','{$comment_email}','{$comment_content}','{$comment_status}',now()) ";
                    $create_clone_comment_query = mysqli_query($connection,$query);
                    confirmQuery($create_clone_comment_query);               
                break;
            }
        }
    }
?>

<form action="" method="post">
 <div id="bulkOptionContainer" class="col-xs-4">
     <select class="form-control" name="bulk_options" id="">
         <option value="">Select Option</option>
         <option value="Approve">Approve</option>
         <option value="Unapprove">Unapprove</option>
         <option value="Delete">Delete</option>             
         <option value="Clone">Clone</option>
     </select>
 </div>
 <div class="col-xs-4">
     <input type="submit" name="submit" class="btn btn-success" value="Apply">
     <a class="btn btn-primary" href="comments.php?source=add_post"> Add New</a>
 </div>
 <br>
<table class="table table-bordered table-hover">
  <thead>
      <tr>
          <th><input id="selectAllBoxes" type="checkbox"></th>
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
            $query = "SELECT * FROM comments";
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
                 ?>
                <td><input class ='checkBoxes' type='checkbox' name='checkBoxArray[]' value="<?php echo $comment_id; ?>"></td>
                <?php
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
                echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
                echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
                echo "<td><a href='comments.php?delete_comment_by_id={$comment_id}'>Delete</a></td>";
                echo "</tr>";
            }
      ?>
  </tbody>
</table>
</form>

<?php 
if(isset($_GET['delete_comment_by_id'])){
    $delete_comment_by_id = $_GET['delete_comment_by_id'];
    echo $query = "DELETE FROM comments WHERE comment_id = {$delete_comment_by_id} "; 
    $delete_comment_data = mysqli_query($connection,$query);
    confirmQuery($delete_comment_data);
    header("Location: comments.php");
}

if(isset($_GET['approve'])){
    $apppove_comment_status = $_GET['approve'];
    echo $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$apppove_comment_status} "; 
    $apppove_comment_status = mysqli_query($connection,$query);
    confirmQuery($apppove_comment_status);
    header("Location: comments.php");
}

if(isset($_GET['unapprove'])){
    $unapppove_comment_status = $_GET['unapprove'];
    echo $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = {$unapppove_comment_status} "; 
    $unapppove_comment_status = mysqli_query($connection,$query);
    confirmQuery($unapppove_comment_status);
    header("Location: comments.php");
}
?>