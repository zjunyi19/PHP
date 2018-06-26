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
                    if(isset($_GET['author'])) {
                        $post_author = $_GET['author'];
                        echo $post_author;
                    }
                    $get_post_query = "select * from posts where post_author = '{$post_author}'";
                    $get_post_result = mysqli_query($connection, $get_post_query);
                    while ($row = mysqli_fetch_assoc($get_post_result)) {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_date = $row['post_date'];
                ?>
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="posts.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <?php echo $post_author; ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>

                <hr>                       
                <?php }?>
                            
                <!-- Blog Comments -->
                
                <?php
                if(isset($_POST['create_comment'])) {
                    $comment_post_id = $_GET['p_id'];
                    $comment_author = $_POST['comment_author'];
                    $comment_content = $_POST['comment_content'];
                    $comment_email = $_POST['comment_email'];
                    if(!empty($comment_author) && !empty($comment_content) && !empty($comment_email)) {
                         $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                        $query .= "VALUES ({$comment_post_id}, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";
                        $create_comment = mysqli_query($connection, $query);
                        if(!$create_comment) {
                            die('QUERY FAILED' . mysqli_error($connection));
                        }
                        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1";
                        $query .= "WHERE post_id = {$comment_post_id}";
                        $update_comment_count = mysqli_query($connection, $query);
                        if(!$create_comment) {
                            die('QUERY FAILED' . mysqli_error($update_comment_count));
                        }
                    } else {
                        echo "<script>alert('FILED SHOULD NOT BE EMPTY')</script>";
                    }
                   
                }                
                ?>

<!--                 Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action = "" method = "post" role="form">
                        <div class="form-group">
                            <label for ="Author">Author:</label>
                            <input type = "text" class = "form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for ="Email">Email:</label>
                            <input type = "email" class = "form-control"  name="comment_email">
                        </div>
                        <div class="form-group">
                           <label for ="Comment">Leave your comment</label>
                            <textarea class="form-control" name = "comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit" name = "create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                $query="SELECT * FROM comments WHERE comment_post_id='{$post_id}'";
                $query.="AND comment_status='approved'";
                $query.="ORDER BY comment_id DESC";
                $result = mysqli_query($connection, $query);
                if (!$result) {
                    die("FAILED QUERY" .mysqli_error());
                }
                while($row = mysqli_fetch_assoc($result)) {
                    $comment_author = $row['comment_author'];
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    ?>
                     <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author;?>
                            <small><?php echo $comment_date;?></small>
                        </h4>
                       <?php echo $comment_content;?>
                    </div>
                </div>
                <?php }?>

               

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php   include "includes/sidebar.php"; ?> 
        </div>
    </div>
        <!-- /.row -->

    <hr>
    
<?php   include "includes/footer.php"; ?>
