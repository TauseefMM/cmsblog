<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php 
    if(isset($_POST['login'])){
        login_user($_POST['username'],$_POST['password']);
    }
?>