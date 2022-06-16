<?php
//***************************************************//
//            General Function
//***************************************************//

function redirect($location){
   header('Location:'. $location);
   exit;
}

function ifItIsMethod($method = null){
     if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
        return true;
     }
     return false;
}

function isLoggedIn(){
    if(isset($_SESSION['user_role'])){
        return true;
    }
    return false;
}

function checkIfUserLoggedInAndRedirect($redirectLocation = null){
    if(isLoggedIn()){
        redirect($redirectLocation);
    }
}

function escape($string){
    echo $string;
    global $connection;
    $result = mysqli_real_escape_string($connection,$string);
    return $result;
}

function confirmQuery($result){
    global $connection;
    if(!$result){
        die("QUERY FAILED . " . mysqli_error($connection));
    }
}

function user_online(){
    if(isset($_GET['onlineusers'])){
        global $connection;
        if(!$connection){
            session_start();
            include("../includes/db.php"); 
            $count_user = 0;
            $session = session_id();
            $time = time(); 
            $time_out_in_second = 10; 
            $time_out = $time - $time_out_in_second; 
            $query = "SELECT * FROM user_online WHERE session = '{$session}' ";
            $send_query = mysqli_query($connection,$query);
            $count = mysqli_num_rows($send_query);

                if($count == NULL){
                    mysqli_query($connection,"INSERT INTO user_online(`session`,`time`) VALUES('{$session}','{$time}')");
                }else{
                    mysqli_query($connection,"UPDATE user_online SET `time` = '{$time}' WHERE session = $session'");
                }
                echo $users_online_query =  mysqli_query($connection,"SELECT * FROM user_online WHERE `time` => '$time'");
                echo $count_user = mysqli_num_rows(mysqli_query($connection,"SELECT * FROM user_online WHERE `time` < '$time_out'"));
        }
    }
}
user_online();
//***************************************************//
//            Categories Crud Operation
//***************************************************//


//insert data into a categories table
function insert_categories(){
    global $connection;
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title']; 
        if($cat_title == "" || empty($cat_title)){
            echo "Category Field Should Not Be Empty";
        }else{
            $stmt = mysqli_prepare($connection,"INSERT INTO categories (cat_title) VALUES (?)") ;
            mysqli_stmt_bind_param($stmt,'s',$cat_title);
            mysqli_stmt_execute($stmt);
            confirmQuery($stmt);
            mysqli_stmt_close($stmt);
        }
    }
}


function findAllCategories(){
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";                                            
        echo "<td>{$cat_title}</td>";                                       
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
}

function deleteCategory(){
    global $connection;
    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection,$query);
        header("Location: categories.php");
    }
}  

function recordCount($table){
     global $connection;
     $query = "SELECT * FROM " .$table;
     $select_all_post = mysqli_query($connection,$query);
     $result = mysqli_num_rows($select_all_post);
     confirmQuery($result);
     return $result;
}

function checkStatus($table,$column,$status){
     global $connection;
     $query  = "SELECT * FROM $table WHERE $column = '$status' ";
     $result = mysqli_query($connection,$query);
     confirmQuery($result);
     return mysqli_num_rows($result);
}

function checkUserRole($table,$column,$role){
     global $connection;
     $query  = "SELECT * FROM $table WHERE $column = '$role' ";
     $select_all_users = mysqli_query($connection,$query);
     $result = mysqli_num_rows($select_all_users);
     confirmQuery($result);
     return $result;
}

function is_admin($username = ""){
    global $connection;
    $query = "SELECT user_role FROM users WHERE username = '{$username}' ";
    $user_role_query = mysqli_query($connection,$query);
    confirmQuery($user_role_query);
    $row = mysqli_fetch_array($user_role_query);

    if($row['user_role'] == 'Admin'){
        return true;
    }else{
        return false;
    }
}

function username_exists($username){
    global $connection;

    $query = "SELECT username FROM users WHERE username = '{$username}' ";
    $username_query = mysqli_query($connection,$query);
    confirmQuery($username_query);
    if(mysqli_num_rows($username_query) > 0){
        return true;
    }else{
        return false;
    }
}

function email_exists($email){
    global $connection;

    $query = "SELECT user_email FROM users WHERE user_email = '{$email}' ";
    $email_query = mysqli_query($connection,$query);
    confirmQuery($email_query);
    if(mysqli_num_rows($email_query) > 0){
        return true;
    }else{
        return false;
    }
}

function register_user($username,$email,$password){
    global $connection;
    $username   = escape($username);         
    $password   = escape($password);
    $email      = escape($email);
    $password = password_hash($password, PASSWORD_BCRYPT,array('cost' => 12));
    $query = "INSERT INTO `users`(`username`, `user_password`, `user_email`, `user_role`)";
    $query .= "VALUES ('{$username}','{$password}','{$email}','Subscriber') ";
    $create_registration_query = mysqli_query($connection,$query);
    confirmQuery($create_registration_query);
}


function  login_user($username,$password){
    global $connection;
    echo $username = trim($username);
    echo $password = trim($password);
    $username = escape($username);       
    $password = escape($password);
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
        if(password_verify($password,$db_user_password)){
             $_SESSION['username'] = $db_username;            
             $_SESSION['firstname'] = $db_user_firstname;
             $_SESSION['lastname'] = $db_user_lastname;
             $_SESSION['user_role'] = $db_user_role;
             header("Location: /repo/cmsblog/admin");
        } else{
             return false;
        }
    }
        return true;
}

?>