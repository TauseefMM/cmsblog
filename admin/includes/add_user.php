<?php
    if(isset($_POST['create_user'])){
        $user_firstname = $_POST['user_firstname'];                                           
        $user_lastname = $_POST['user_lastname'];                                    
        $user_role = $_POST['user_role'];
//        $post_date = date('d-m-y');
//        
//        $post_image = $_FILES['post_image']['name'];        
//        $post_image_temp = $_FILES['post_image']['tmp_name'];

        
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
//        $post_comment_count = 2;
        $user_password = $_POST['user_password'];
        
//        move_uploaded_file($post_image_temp,"../images/{$post_image}");
        
        $query = "INSERT INTO `users`(`username`, `user_password`, `user_firstname`,`user_lastname`, `user_email`, `user_role`)";
        $query .= "VALUES ('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_role}') ";
        $create_user_query = mysqli_query($connection,$query);
        
        confirmQuery($create_user_query);
        echo "User Created: " . " " . "<a href='users.php'>View Users </a>";
//        header("Location: users.php");
    }
?> 
<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="user_firstname">First Name</label>
		<input type="text" class="form-control" name="user_firstname"> </div>
	<div class="form-group">
		<label for="user_lasstname">Last Name</label>
		<input type="text" class="form-control" name="user_lastname"> </div>
	<div class="form-group">
		<label for="user_role">User Role</label>
		<select name="user_role" id="" class="form-control">
			<option value='Subscriber'>Select Option</option>
			<option value='Admin'>admin</option>
			<option value='Subscriber'>Subscriber</option>
		</select>
	</div>
	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" name="username"> </div>
	<div class="form-group">
		<label for="user_email">User Email</label>
		<input type="email" class="form-control" name="user_email"> </div>
	<div class="form-group">
		<label for="user_password">Password</label>
		<input type="password" class="form-control" name="user_password"> </div>
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="create_user" value="Add User"> </div>
</form>