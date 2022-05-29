<?php include("includes/admin_header.php"); ?>
 <div id="wrapper">
     <!-- Navigation -->
    <?php include("includes/admin_navigation.php"); ?>
        
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Categories
                            <small>Author</small>
                        </h1>
                        <div class="col-xs-6">
                        <!-- Insert category in the table-->
                        <?php insert_categories(); ?>
                        
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat-title">Add Category</label>
                                <input type="text" name="cat_title" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-primary" value="Add Category">
                            </div>
                        </form>
                     
                     <?php if(isset($_GET['edit'])){ ?>
                         <form action="" method="post">
                                    <div class="form-group">
                                        <label for="cat-title">Edit Category</label>
                                    <?php   
                                        $cat_id = $_GET['edit'];
                                        $query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";
                                        $edit_cat_row_record = mysqli_query($connection,$query);
                                        while($row = mysqli_fetch_assoc($edit_cat_row_record)){
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title']; ?>
                                             <input value="<?php if(isset($cat_title)){echo $cat_title; }?>" type="text" name="cat_title" class="form-control">
                                    <?php  } ?>
                                               </div>
                                            <div class="form-group">
                                                <input type="submit" name="update_Category" class="btn btn-primary" value="Update Category">
                                            </div>
                             </form>
                   
                           <?php 
                            if(isset($_POST['update_Category'])){
                                $updaed_cat_title = $_POST['cat_title'];
                                $query = "UPDATE categories SET cat_title = '{$updaed_cat_title}' WHERE cat_id = {$cat_id} ";
                                $update_query = mysqli_query($connection,$query);
                                if(!$update_query){
                                    die("QUERY FAILED" .mysqli_error($connection));
                                }
                            }
                            } ?>
                     
                        
                        </div>
                        <?php 
                            
                        ?>  
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                       // Render all categories from a table
                                          findAllCategories();
                                    
                                       // Delete a row from categories table 
                                          deleteCategory();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
    <?php include("includes/admin_footer.php"); ?>