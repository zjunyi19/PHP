<?php

   if(isset($_POST['create_post'])) {
       
        $post_title        = escape($_POST['post_title']);
        $post_author       = escape($_POST['post_author']);
        $post_category_id  = escape($_POST['post_category']);           
        $post_status       = escape($_POST['post_status']);
        $post_image        = escape($_FILES['image']['name']);
        $post_image_temp   = escape($_FILES['image']['tmp_name']);
    
        $post_tags         = escape($_POST['post_tags']);      
        $post_content      = escape($_POST['post_content']);
        $post_date         = date('d-m-y');
        move_uploaded_file($post_image_temp, "../images/$post_image" );
       
        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date,post_image,post_content,post_tags,post_status) ";
             
        $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') "; 
             
        $add_post_result = mysqli_query($connection, $query);      
        confirmQuery($add_post_result);
        $post_id = mysqli_insert_id($connection);
        echo "<p class='bg-success'>Post Added: "." "."<a href='../post.php?p_id={$post_id}'>View Post</a> or <a href='posts.php?'>View All Posts</a></p>";
   }
    
?> 
    
<form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="title">Post Title</label>
          <input type="text" class="form-control" name="post_title">
      </div>
      <div class="form-group">
         <label for="post_category">Post Category</label>
          <select name="post_category" id="">
        <?php
            $query = "select * from categories";
            $cate_result = mysqli_query($connection, $query);
            confirmQuery($cate_result);
            while ($row = mysqli_fetch_assoc($cate_result)) {
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
            $query = "select * from users";
            $user_result = mysqli_query($connection, $query);
            confirmQuery($user_result);
            while ($row = mysqli_fetch_assoc($user_result)) {
                $user_name = $row['user_name'];
                $user_id = $row['user_id'];
                echo "<option value = '$user_id'>{$user_name}</option>";
            }
            
        ?>
          </select>
      </div>
        <div class="form-group">
         <label for="post_status">Post Status</label>
             <select name="post_status" id="">
                 <option value="">Select Option</option>
                 <option value="draft">draft</option>
                 <option value="published">published</option>
             </select>
    </div>
    <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>
    <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" name="post_tags">
      </div>
            <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
      </div>
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
      </div>
</form>