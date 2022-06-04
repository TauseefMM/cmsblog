<?php
    
    include("db.php");
    session_start();

    if(isset($_POST['login'])){
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $username = mysqli_real_escape_string($connection,$username);       
        $password = mysqli_real_escape_string($connection,$password);
        
        $query = "SELECT * FROM users WHERE username = '{$username}' ";
        $get_username_data = mysqli_query($connection,$query);
                
        while($row = mysqli_fetch_array($get_username_data)){
                $db_user_id = $row['user_id'];
                $db_username = $row['username'];                                           
                $db_user_password = $row['user_password'];
                $db_user_firstname = $row['user_firstname'];                                    
                $db_user_lastname = $row['user_lastname'];
                $db_user_email = $row['user_email'];
                $db_user_image = $row['user_image'];
                $db_user_role = $row['user_role'];
                 $salt = $row['randSalt']; 
        }
                $password = crypt($password,$db_user_password);
        if($username === $db_username && $password === $db_user_password){
            $_SESSION['username'] = $db_username;            
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;
            header("Location: ../admin");
        } else{
            header("Location: ../index.php");
        }
    }
?>