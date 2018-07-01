<?php include "includes/admin_header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small><?php echo $_SESSION['user_name']; ?></small>
                        </h1>   
                   <?php
                       if(isset($_GET['p_id'])) {
                           $post_id = $_GET['p_id'];
                        ?>
                        <table class = "table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                   
                                </tr>
                            </thead>
                            
                            <tbody>
                            <?php
                                $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id}";
                                $result = mysqli_query($connection, $query);
                                while($row = mysqli_fetch_assoc($result)) {
                                    $comment_id = $row['comment_id'];
                                    $comment_post_id = $row['comment_post_id'];
                                    $comment_author = $row['comment_author'];
                                    $comment_content = $row['comment_content'];
                                    $comment_email = $row['comment_email'];
                                    $comment_date = $row['comment_date'];
                                    $comment_status = $row['comment_status'];
                                    
                                    echo "<tr>";
                                    echo "<td>{$comment_id}</td>";
                                    echo "<td>{$comment_author}</td>";
                                    echo "<td>{$comment_content}</td>";
                                    echo "<td>{$comment_email}</td>";
                                    echo "<td>{$comment_status}</td>";
                                    echo "<td>{$comment_date}</td>";
                                    
                                    echo "<td><a href= 'post_comments.php?approve={$comment_id}&p_id={$post_id}'>Approve</a></td>";
                                    echo "<td><a href= 'post_comments.php?unapprove={$comment_id}&p_id={$post_id}'>Unapprove</a></td>";
                                    echo "<td><a onclick=\"javascript: return confirm('Are you sure you want to delete?')   ;\" href= 'post_comments.php?delete={$comment_id}&p_id={$post_id}'>Delete</a></td>";
                                    echo "</tr>";
                                }
                                
                       }?>
                            </tbody>
                        
                        </table>
                        

<?php
    if(isset($_GET['unapprove'])) {
        $comment_id = $_GET['unapprove'];
        $query = "UPDATE comments SET comment_status='unapproved' WHERE comment_id = {$comment_id}";
        $result = mysqli_query($connection, $query);
        header("Location:post_comments.php?p_id={$post_id}");
        confirmQuery($result);
    }
    if(isset($_GET['approve'])) {
        $comment_id = $_GET['approve'];
        $query = "UPDATE comments SET comment_status='approved' WHERE comment_id = {$comment_id}";
        $result = mysqli_query($connection, $query);
        header("Location:post_comments.php?p_id={$post_id}");
        confirmQuery($result);
    
    }
    if(isset($_GET['delete'])) {
        $comment_id = $_GET['delete'];
        $query = "DELETE FROM comments WHERE comment_id = {$comment_id}";
        $result = mysqli_query($connection, $query);
        header("Location:post_comments.php?p_id={$post_id}");
        confirmQuery($result);
    }
?>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>