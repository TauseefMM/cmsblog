    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/repo/cmsblog/">CMS Blog</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php 
                        $query = "SELECT * FROM categories";
                        $select_all_cate_query = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($select_all_cate_query)){
                            $cat_title = $row['cat_title'];    
                            $cat_id = $row['cat_id'];

                            $category_class = '';
                            $registration_class = '';

                            $pageName = basename($_SERVER['PHP_SELF']);
                            $registration = '/repo/cmsblog/registration';

                            if(isset($_GET['category']) && $_GET['category'] == $cat_id){
                                $category_class = 'active';
                            }else if($pageName == $registration){
                                $registration_class = 'active';
                            }
                            echo "<li class='{$category_class}'><a href ='/repo/cmsblog/category/{$cat_id}'> {$cat_title} </a ></li>";
                        }
                    ?>
                    <?php if(isLoggedIn()):?>
                        echo "<li><a href="/repo/cmsblog/admin">Admin</a></li>";
                        echo "<li><a href="/repo/cmsblog/includes/logout.php">Logout</a></li>";
                    <?php else: ?>
                        echo "<li><a href="/repo/cmsblog/login">Login</a></li>";
                    <?php endif; ?> 
                    
                    
                    <li class = "<?php echo $registration_class;  ?>"><a href="/repo/cmsblog/registration">Registration</a></li> 
                    <?php
                         if(isset($_SESSION['user_role'])){
                             if(isset($_GET['p_id'])){
                                $the_post_id = $_GET['p_id'];
                                echo"<li><a href='/repo/cmsblog/admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
                             }
                         }
                    ?>
                   <li><a href="/repo/cmsblog/contact">Contact</a></li>  

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>