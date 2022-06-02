 <?php include("includes/admin_header.php"); ?>
 <div id="wrapper">
     <!-- Navigation -->
    <?php include("includes/admin_navigation.php"); ?>
        <div id="page-wrapper">
            <div class="container-fluid">
<!--
               SELECT
    *,COUNT(post_id) AS Total_post,COUNT(comment_id) AS Total_comment,
	  SUM(CASE WHEN pst.post_status = 'draft' THEN 1 ELSE 0 END) AS Draft,
    SUM(CASE WHEN pst.post_status = 'published' THEN 1 ELSE 0 END) AS published,
	  SUM(CASE WHEN cmts.comment_status = 'Approved' THEN 1 ELSE 0 END) AS Approved,
	  SUM(CASE WHEN cmts.comment_status = 'Unapproved' THEN 1 ELSE 0 END) AS Unapproved,
	  SUM(CASE WHEN cat.cat_title= 'Javascript' THEN 1 ELSE 0 END) AS Javascript,
		SUM(CASE WHEN cat.cat_title= 'PHP' THEN 1 ELSE 0 END) AS PHP
FROM
	posts pst
	JOIN categories cat ON cat.cat_id = pst.post_category_id
	JOIN comments cmts ON cmts.comment_post_id = pst.post_id
-->
	
	
	
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->                
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php 
                                         $query = "SELECT * FROM posts";
                                         $post_count_query= mysqli_query($connection,$query);
                                         $total_post = mysqli_num_rows($post_count_query);
                                         echo "<div class='huge'>{$total_post}</div>";
                                    ?>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php 
                                         $query = "SELECT * FROM comments";
                                         $comment_count_query= mysqli_query($connection,$query);
                                         $total_comments = mysqli_num_rows($comment_count_query);
                                         echo "<div class='huge'>{$total_comments}</div>";
                                    ?>
                                      <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php 
                                         $query = "SELECT * FROM users";
                                         $user_count_query= mysqli_query($connection,$query);
                                         $total_users = mysqli_num_rows($user_count_query);
                                         echo "<div class='huge'>{$total_users}</div>";
                                    ?>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                       <?php 
                                             $query = "SELECT * FROM categories";
                                             $categories_count_query= mysqli_query($connection,$query);
                                             $total_categories = mysqli_num_rows($categories_count_query);
                                             echo "<div class='huge'>{$total_categories}</div>";
                                        ?>
                                       <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                                    <!-- /.row -->
                <div class="row">
                  <?php
                     $query = "SELECT * FROM posts WHERE post_status = 'draft' ";
                     $draft_post_count_query = mysqli_query($connection,$query);
                     $total_draft_post = mysqli_num_rows($draft_post_count_query);
                    
                     $query = "SELECT * FROM posts WHERE post_status = 'published' ";
                     $published_post_count_query = mysqli_query($connection,$query);
                     $total_published_post = mysqli_num_rows($published_post_count_query);
                    
                     $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
                     $unapproved_comment_count_query= mysqli_query($connection,$query);
                     $total_unapproved_comments = mysqli_num_rows($unapproved_comment_count_query);
                    
                     $query = "SELECT * FROM users WHERE user_role = 'Subscriber' ";
                     $Subscriber_count_query= mysqli_query($connection,$query);
                     $total_Subscribers = mysqli_num_rows($Subscriber_count_query);
                   ?>
                   <script type="text/javascript">
                      google.charts.load('current', {'packages':['bar']});
                      google.charts.setOnLoadCallback(drawChart);

                      function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data','Count'],
                          <?php
                          $bar_chart_title = ['Active Posts', 'Published Posts', 'Draft Posts', 'Comments', 'Pending Comments','Users','Subscriber' ,'Categories'];
                          $bar_chart_value = [$total_post,$total_published_post,$total_draft_post,$total_comments,$total_unapproved_comments,$total_users,$total_Subscribers,$total_categories]; 
                          for($i = 0; $i < 8; $i++){
                              echo "['{$bar_chart_title[$i]}'" . "," . "{$bar_chart_value[$i]}],";
                          }?>]);

                        var options = {
                          chart: {
                            title: '',
                            subtitle: '',
                          }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                      }
                    </script>
                    <div id="columnchart_material" style="width: auto; height: 500px;"></div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    <?php include("includes/admin_footer.php"); ?>