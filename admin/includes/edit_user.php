
   <?php
    if (isset($_GET['edit_user'])) {
        $post_id = $_GET['edit_user'];
    }
    $query = "SELECT * FROM posts WHERE user_id = $user_id";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result)) {
        $user_name = $row['user_name'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_status = $row['user_status'];
        $user_role = $row['user_role'];
        $user_password = $row['user_password'];
       
   }
?> 
    
<form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="title">First name</label>
          <input value = "<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
      </div>
      <div class="form-group">
       <label for="post_category">Last name</label>
        <select name="Last" id="">
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
          <input value = "<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
      </div>
    <div class="form-group">
         <label for="post_status">Post Status</label>
          <input value = "<?php echo $post_status; ?>" type="text" class="form-control" name="post_status">
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