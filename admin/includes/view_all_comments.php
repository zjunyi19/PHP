                      <table class = "table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In Response to</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                   
                                </tr>
                            </thead>
                            
                            <tbody>
                            <?php
                                $query = "SELECT * FROM comments";
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
                                    
                                    $comment_query = "select * from posts where post_id = {$comment_post_id}";
                                    $comment_result = mysqli_query($connection, $comment_query);
                                    while($row = mysqli_fetch_assoc($comment_result)) {
                                        $comment_post_title = $row['post_title'];
                                    } 
                        
                                    echo "<td>{$comment_email}</td>";
                                    
                                    
                                    echo "<td>{$comment_status}</td>";
                                    echo "<td><a href = '../post.php?p_id=$comment_post_id'>{$comment_post_title}</a></td>";
                                    echo "<td>{$comment_date}</td>";
                                    
                                    echo "<td><a href= 'comments.php?approve={$comment_id}'>Approve</a></td>";
                                    echo "<td><a href= 'comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
                                    echo "<td><a onclick=\"javascript: return confirm('Are you sure you want to delete?')   ;\" href= 'comments.php?delete={$comment_id}'>Delete</a></td>";
                                    echo "</tr>";
                                }
                                
                                ?>
                            </tbody>
                        
                        </table>
                        

<?php
    if(isset($_GET['unapprove'])) {
        $comment_id = escape($_GET['unapprove']);
        $query = "UPDATE comments SET comment_status='unapproved' WHERE comment_id = {$comment_id}";
        $result = mysqli_query($connection, $query);
        header("Location:comments.php");
        confirmQuery($result);
    }
    if(isset($_GET['approve'])) {
        $comment_id = escape($_GET['approve']);
        $query = "UPDATE comments SET comment_status='approved' WHERE comment_id = {$comment_id}";
        $result = mysqli_query($connection, $query);
        header("Location:comments.php");
        confirmQuery($result);
    
    }
    if(isset($_GET['delete'])) {
        $comment_id = escape($_GET['delete']);
        $query = "DELETE FROM comments WHERE comment_id = {$comment_id}";
        $result = mysqli_query($connection, $query);
        header("Location:comments.php");
        confirmQuery($result);
    }
?>
