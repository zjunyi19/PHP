
   <?php
    if (isset($_GET['p_id'])) {
        $post_id = escape($_GET['p_id']);
    }
    $query = "SELECT * FROM posts WHERE post_id = $post_id";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result)) {
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_author = $row['post_author'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_date = $row['post_date'];
        $post_tags = $row['post_tags'];
        $post_status = $row['post_status'];                          
        $post_comment_count = $row['post_comment_count'];
       
   }

    if(isset($_POST['update_post'])) {
        
        $post_author         =  escape($_POST['post_author']);
        $post_title          =  escape($_POST['post_title']);
        $post_category_id    =  escape($_POST['post_category']);
        $post_status         =  escape($_POST['post_status']);
        $post_image          =  escape($_FILES['image']['name']);
        $post_image_temp     =  escape($_FILES['image']['tmp_name']);
        $post_content        =  escape($_POST['post_content']);
        $post_tags           =  escape($_POST['post_tags']);
        
        move_uploaded_file($post_image_temp, "../images/$post_image"); 
        if(empty($post_image)) {
            $query = "select * from posts where post_id = $post_id";
            $result = mysqli_query($connection, $query);
            while($row = mysqli_fetch_array($result)) {
                $post_image = $row['post_image'];
            }
        }
        
        $query = "UPDATE posts SET ";
        $query .="post_title  = '{$post_title}', ";
        $query .="post_category_id = '{$post_category_id}', ";
        $query .="post_date   =  now(), ";
        $query .="post_author = '{$post_author}', ";
        $query .="post_status = '{$post_status}', ";
        $query .="post_tags   = '{$post_tags}', ";
        $query .="post_content= '{$post_content}', ";
        $query .="post_image  = '{$post_image}' ";
        $query .= "WHERE post_id = {$post_id} ";
        
        $result = mysqli_query($connection,$query);
        
        confirmQuery($result);
        echo "<p class='bg-success'>Post Updated: "." "."<a href='../post.php?p_id={$post_id}'>View Post</a> or <a href='posts.php?'>View All Posts</a></p>";
   
    }
    
?> 
    
<form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="title">Post Title</label>
          <input value = "<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
      </div>
      <div class="form-group">
       <label for="post_category">Post Category</label>
        <select name="post_category" id="">
        <?php
            $query = "select * from categories";
            $new_result = mysqli_query($connection, $query);
            confirmQuery($new_result);
            while ($row = mysqli_fetch_assoc($new_result)) {
                $cate_title = $row['cate_title'];
                $cate_id = $row['cate_id'];
                echo "<option value = '$cate_id'>{$cate_title}</option>";
            }
            
        ?>
          </select>
     </div>
    <div class="form-group">
         <label for="title">Post Author</label>
          <select name="post_author" id="">
        <?php
            echo "<option value = '$post_author'>{$post_author}</option>";
            $query = "select * from users";
            $user_result = mysqli_query($connection, $query);
            confirmQuery($user_result);
            while ($row = mysqli_fetch_assoc($user_result)) {
                if($row['user_name'] != $post_author) {
                    $user_name = $row['user_name'];
                    echo "<option value = '$user_name'>{$user_name}</option>";
                }        
            }
            
        ?>
        </select>
    </div>
    <div class="form-group">
         <label for="post_status">Post Status</label>
             <select name="post_status" id="">
                 <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
                 <?php
                    if($post_status == 'published') {
                        echo "<option value='draft'>draft</option>";
                    } else {
                        echo "<option value='published'>published</option>";
                    }
            ?>
             </select>
    </div>
    <div class="form-group">
         <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
       <input  type="file" name="image">
      </div>
    <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input  value = "<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
      </div>
    <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control "name="post_content" id="" cols="30" rows="10">
         <?php echo $post_title; ?>
         </textarea>
      </div>
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
      </div>
</form>