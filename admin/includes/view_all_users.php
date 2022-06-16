
<?php 
    if(isset($_POST['checkBoxArray'])){
        foreach($_POST['checkBoxArray'] as $postValueId){
            $bulk_option = $_POST['bulk_options'];
            switch($bulk_option){
                case 'Admin':
                    $query = "UPDATE users SET user_role = '{escape($bulk_option)}' WHERE user_id = {escape($postValueId)} ";
                    $update_to_Admin_role = mysqli_query($connection,$query);
                    confirmQuery($update_to_Admin_role);
                break;
                case 'Subscriber':
                    $query = "UPDATE users SET user_role = '{escape($bulk_option)}' WHERE user_id = {escape($postValueId)} ";
                    $update_to_subscriber_role = mysqli_query($connection,$query);
                    confirmQuery($update_to_subscriber_role);
                break;
                case 'Delete':
                    $query = "DELETE FROM users WHERE user_id = {escape($postValueId)} ";
                    $delete_user = mysqli_query($connection,$query);
                    confirmQuery($delete_user);
                break;
                case 'Clone':
                    $query = "SELECT * FROM users WHERE user_id = {escape($postValueId)} ";
                    $user_record = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($user_record)){
                        $user_id = escape($row['user_id']);
                        $username = escape($row['username']);                                           
                        $user_password = escape($row['user_password']);
                        $user_firstname = escape($row['user_firstname']);                                    
                        $user_lastname = escape($row['user_lastname']);
                        $user_email = escape($row['user_email']);
                        $user_image = escape($row['user_image']);
                        $user_role = escape($row['user_role']);
                
                    }
                    $query = "INSERT INTO `users`(`username`, `user_password`, `user_firstname`,`user_lastname`, `user_email`, `user_role`)";
                    $query .= "VALUES ('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_role}') ";
                    $create_clone_user_query = mysqli_query($connection,$query);
                    confirmQuery($create_clone_user_query);               
                break;
            }
        }
    }
?>

<form action="" method="post">
 <div id="bulkOptionContainer" class="col-xs-4">
     <select class="form-control" name="bulk_options" id="">
         <option value="">Select Option</option>
         <option value="Admin">Admin</option>
         <option value="Subscriber">Subscriber</option>
         <option value="Delete">Delete</option>             
         <option value="Clone">Clone</option>
     </select>
 </div>
 <div class="col-xs-4">
     <input type="submit" name="submit" class="btn btn-success" value="Apply">
     <a class="btn btn-primary" href="users.php?source=add_user"> Add New</a>
 </div>
 <br>

<table class="table table-bordered table-hover">
  <thead>
      <tr>
          <th><input id="selectAllBoxes" type="checkbox"></th>
          <th>ID</th>
          <th>Username</th>
          <th>Firstname</th>
          <th>Lastname</th>
          <th>Email</th>
          <th>Role</th>
          <th class="text-center" colspan="3">Action</th>
      </tr>
  </thead>
  <tbody>

     <?php 
            $query = "SELECT * FROM users";
            $show_all_users = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($show_all_users)){
                $user_id = escape($row['user_id']);
                $username = escape($row['username']);                                           
                $user_password = escape($row['user_password']);
                $user_firstname = escape($row['user_firstname']);                                    
                $user_lastname = escape($row['user_lastname']);
                $user_email = escape($row['user_email']);
                $user_image = escape($row['user_image']);
                $user_role = escape($row['user_role']);
                
                echo "<tr>";
                 ?>
                <td><input class ='checkBoxes' type='checkbox' name='checkBoxArray[]' value="<?php echo $user_id; ?>"></td>
                <?php
                echo "<td>{$user_id}</td>";                                            
                echo "<td>{$username}</td>";                             
                echo "<td>{$user_firstname}</td>";  
                echo "<td>{$user_lastname}</td>";                                       
                echo "<td>{$user_email}</td>";                                       
                echo "<td>{$user_role}</td>";                                       
                echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
                echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
                echo "<td><a href='users.php?source=edit_user&user_id={$user_id}'>Edit</a></td>";
                echo "<td><a href='users.php?delete_user_by_id={$user_id}'>Delete</a></td>";
                echo "</tr>";
            }
      ?>
  </tbody>
</table>
</form>

<?php 
if(isset($_GET['delete_user_by_id'])){
    if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role'] == 'Admin'){
            $delete_user_by_id = mysqli_real_escape_string($_GET['delete_user_by_id']);
            $query = "DELETE FROM users WHERE user_id = {$delete_user_by_id} "; 
            $delete_user_data = mysqli_query($connection,$query);
            confirmQuery($delete_user_data);
            header("Location: users.php");
        }
    }
}

if(isset($_GET['change_to_admin'])){
    $role_change_to_admin = escape($_GET['change_to_admin']);
    $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = {$role_change_to_admin} "; 
    $change_role_to_admin = mysqli_query($connection,$query);
    confirmQuery($change_role_to_admin);
    header("Location: users.php");
}

if(isset($_GET['change_to_sub'])){
    $role_change_to_sub = escape($_GET['change_to_sub']);
    $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = {$role_change_to_sub} "; 
    $change_role_to_sub = mysqli_query($connection,$query);
    confirmQuery($change_role_to_sub);
    header("Location: users.php");
}
?>