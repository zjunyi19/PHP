                      <table class = "table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            <?php
                                $query = "SELECT * FROM posts";
                                $result = mysqli_query($connection, $query);
                                while($row = mysqli_fetch_assoc($result)) {
                                    $post_id = $row['post_id'];
                                    $post_title = $row['post_title'];
                                    $post_category_id = $row['post_category_id'];
                                    $post_author = $row['post_author'];
                                    $post_image = $row['post_image'];
                                    $post_content = $row['post_content'];
                                    $post_date = $row['post_date'];
                                    $post_tags = $row['post_tags'];
                                    $post_status = $row['post_status'];
                                    $post_comment_count = $row['post_comment_count'];
                                    
                                    echo "<tr>";
                                    echo "<td>{$post_id}</td>";
                                    echo "<td>{$post_author}</td>";
                                    echo "<td>{$post_title}</td>";
                                    
                                    $cate_query = "select * from categories where cate_id = {$post_category_id}";
                                    $cate_result = mysqli_query($connection, $cate_query);
                                    while($row = mysqli_fetch_assoc($cate_result)) {
                                        $cate_title = $row['cate_title'];
                                    } 
                        
                                    echo "<td>{$cate_title}</td>";
                                    
                                    
                                    echo "<td>{$post_status}</td>";
                                    echo "<td><image width = '100' 
                                                src='../images/$post_image' alt = 'image'></td>";
                                    echo "<td>{$post_tags}</td>";
                                    echo "<td>{$post_comment_count}</td>";
                                    echo "<td>{$post_date}</td>";
                                    echo "<td><a href= 'posts.php?delete={$post_id}'>delete</a></td>";
                                    echo "<td><a href= 'posts.php?source=edit_post&p_id={$post_id}'>edit</a></td>";
                                    echo "</tr>";
                                }
                                
                                ?>
                        </tbody>
                        
                        </table>
                        
<?php
    if(isset($_GET['delete'])) {
        $post_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id = {$post_id}";
        $result = mysqli_query($connection, $query);
        header("Location:posts.php");
        if (!result) {
            die("FAILED TO DELETE" . mysqli_error());
        }
    
    }

?>