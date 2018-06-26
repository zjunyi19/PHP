<?php 
    include "includes/header.php";
    include "includes/db.php";
?>
    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php
                    if (isset($_GET['page'])) {
                        
                    }
                    
                    
                    $query = "select * from posts WHERE post_status = 'published'";
                    $result = mysqli_query($connection, $query);
                    $num_posts = mysqli_num_rows($result);
                    $count = ceil($num_posts / 5);
                    $query = "select * from posts WHERE post_status = 'published'";
                    $result = mysqli_query($connection, $query);
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0,100);
                        $post_date = $row['post_date'];
                        $post_status = $row['post_status'];
                    if($post_status == 'published'){
                        
                        
                ?>
                   <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="includes/author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id?>"><img class="img-responsive" src="images/<?php echo $post_image; ?>" alt=""></a>
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                    
                        
                                        
                <?php        
                    }}
                ?>

                


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php   include "includes/sidebar.php"; ?> 
        </div>
        <!-- /.row -->

    <hr>
    
    <ul class="pager"> 
       <?php
        for($i = 1; $i <= $count; $i++) {
            echo "<li><a href='#'>{$i}</a></li>"
        }
        ?>
        
    </ul>
    
<?php   include "includes/footer.php"; ?>