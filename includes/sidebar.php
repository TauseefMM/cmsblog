<div class="col-md-4">
   <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input type="text" name="search" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit">
                        <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
             </div>
         </form>
        <!-- /.input-group -->
    </div>

    <!-- Blog login Well -->
    <div class="well">
        <h4>Login</h4>
        <form action="includes/login.php" method="post">
             <div class="form-group">
                 <input type="text" class="form-control" name="username" placeholder="Enter Username"> 
             </div>
            <div class="input-group">
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit" name="login">Submit
                </button>
                </span>
             </div>
         </form>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>

        <?php 
            $query = "SELECT * FROM categories";
            $select_all_cat_sidebar = mysqli_query($connection,$query);

        ?>  
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php 
                        while($row = mysqli_fetch_assoc($select_all_cat_sidebar )){
                            $cat_title = $row['cat_title'];    
                            $cat_id = $row['cat_id'];
                            echo "<li><a href ='category.php?category={$cat_id}'> {$cat_title} </a ></li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include("includes/widget.php"); ?>
</div>