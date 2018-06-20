<?php
    if(isset($_POST['checkBoxArray'])) {
        foreach($_POST['checkBoxArray'] as $postValueId) {
            $bulk_options = $_POST['bulk_options'];
            switch($bulk_options) {
                case 'published':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                    $result = mysqli_query($connection,$query);       
                    confirmQuery($result);
                break;
                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}  ";
                    $result = mysqli_query($connection,$query);
                    confirmQuery($result);
                break;
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = {$postValueId}  ";
                    $result = mysqli_query($connection,$query);
                    confirmQuery($result);
                break;
                case 'clone':
                     $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
                     $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_array($result)) {
                         $post_title         = $row['post_title'];
                        $post_category_id   = $row['post_category_id'];
                        $post_date          = $row['post_date']; 
                        $post_author        = $row['post_author'];
                        $post_status        = $row['post_status'];
                        $post_image         = $row['post_image'] ; 
                        $post_tags          = $row['post_tags']; 
                        $post_content       = $row['post_content'];
                    }

                  $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date,post_image,post_content,post_tags,post_status) ";
                  $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') "; 
                  $copy_query = mysqli_query($connection, $query);   
                  confirmQuery($copy_query);
                break;
            
            }
            
        }
    }


?>              
                       
                        
                     <form action="" method = "post">
                        <table class = "table table-bordered table-hover">
                           <div id="bulkkOptionsContainer" class="col-xs-4">
                               <select class="form-control" name="bulk_options">
                                   <option value="">Select Option</option>
                                   <option value="published">Published</option>
                                   <option value="draft">Draft</option>
                                   <option value="delete">Delete</option>
                                   <option value="clone">Clone</option>
                               </select>
                               
                           </div>
                           <div class="col-xs-4">
                               <input type="submit" name="submit" class="btn btn-success" value="Apply">
                               <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
                            </div>
                           
                           
                           
                            <thead>
                                <tr>
                                    <th><input id="selectAllBoxes" type="checkbox"></th>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                    <th>View Post</th>
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
                                    echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]'></td>";
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
                                    echo "<td><a href='../post.php?p_id={$post_id}'>view post</a></td>";
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
                        
                        
                    </form>
                        