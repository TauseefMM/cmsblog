<?php
    if(isset($_GET['user_id'])){
        $get_update_user_id = $_GET['user_id'];
        $query = "SELECT * FROM users WHERE user_id = {$get_update_user_id} ";
        $updated_user_data = mysqli_query($connection,$query);

        while($row = mysqli_fetch_assoc($updated_user_data)){
            $user_id = $row['user_id'];
            $username = $row['username'];                                           
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];                                    
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
        }

	    if(isset($_POST['edit_user'])){
	        $user_firstname = $_POST['user_firstname'];                                           
	        $user_lastname = $_POST['user_lastname'];                                    
	        $user_role = $_POST['user_role'];
	        $username = $_POST['username'];
	        $user_email = $_POST['user_email'];
	        $user_password = $_POST['user_password'];

	        // $post_date = date('d-m-y');
	        // $post_image = $_FILES['post_image']['name'];        
	        // $post_image_temp = $_FILES['post_image']['tmp_name'];
	        // $post_comment_count = 2;
	        // move_uploaded_file($post_image_temp,"../images/{$post_image}");
	        // $query = "SELECT randSalt FROM users";
	        // $get_randsalt_query = mysqli_query($connection,$query);
	        // if(!$get_randsalt_query){
	        //     die("QUERY FAILED : " . mysqli_erorr($connection) . ' ' . mysqli_errorno($connection)); 
	        // }
	        // $row = mysqli_fetch_array($get_randsalt_query);
	        // $salt = $row['randSalt']; 
	        // $hashed_password = crypt($user_password,$salt);

	        if(!empty($user_password)){
	        	$query_password = "SELECT user_password FROM users WHERE user_id = {$get_update_user_id}";
	        	$get_user_query = mysqli_query($connection,$query_password);
	        	confirmQuery($get_user_query);
	        	$row = mysqli_fetch_array($get_user_query);
	        	$db_user_password = $row['user_password'];

	        	if($db_user_password != $user_password){
	            	$hashed_password = password_hash($user_password, PASSWORD_BCRYPT,array('cost' => 12));
	        	}
	        	$query = "UPDATE `users` SET `username`='{$username}',`user_password`='{$hashed_password}',`user_firstname`='{$user_firstname}',`user_lastname`='{$user_lastname}',`user_email`='{$user_email}',`user_role`='{$user_role}' WHERE user_id = {$get_update_user_id } ";
		        $update_user_record_by_id_query = mysqli_query($connection,$query);
		        
		        confirmQuery($update_user_record_by_id_query);
		        header("Location: users.php");
	        }
	    }
    }else{
    			 header("Location: index.php");
    }
?> 
<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="user_firstname">First Name</label>
		<input type="text" class="form-control" name="user_firstname" value= "<?php echo $user_firstname ?>"> </div>
	<div class="form-group">
		<label for="user_lasstname">Last Name</label>
		<input type="text" class="form-control" name="user_lastname" value= "<?php echo $user_lastname ?>"> </div>
	<div class="form-group">
		<label for="user_role">User Role</label>
		<select name="user_role" id="" class="form-control">
			<option value='subscriber'><?php echo $user_role; ?></option>
			<?php
			if($user_role == 'Admin'){
			    echo "<option value='Subscriber'>Subscriber</option>";
			}else{
			    echo "<option value='Admin'>Admin</option>";
			}
            ?>
			
		</select>
	</div>
	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" name="username" value= "<?php echo $username; ?>"> </div>
	<div class="form-group">
		<label for="user_email">User Email</label>
		<input type="email" class="form-control" name="user_email" value= "<?php echo $user_email; ?>"> </div>
	<div class="form-group">
		<label for="user_password">Password</label>
		<input autocomplete="off" type="password" class="form-control" name="user_password" > </div>
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="edit_user" value="Update User"> </div>
</form>