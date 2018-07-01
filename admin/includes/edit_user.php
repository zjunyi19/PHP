<?php  
    if(isset($_GET['u_id'])){
        $user_id = $_GET['u_id'];
        $query = "SELECT * FROM users WHERE user_id = $user_id";
        $select_users_query = mysqli_query($connection,$query);  
        while($row = mysqli_fetch_assoc($select_users_query)) {

          $user_id        = $row['user_id'];
          $user_name       = $row['user_name'];
          $user_password  = $row['user_password'];
          $user_firstname = $row['user_firstname'];
          $user_lastname  = $row['user_lastname'];
          $user_email     = $row['user_email'];
          $user_role      = $row['user_role'];
          
      }
?>
  

   
 <?php  // Post request to update user 
   

   if(isset($_POST['update_user'])) {
        $user_firstname   = $_POST['user_firstname'];
        $user_lastname    = $_POST['user_lastname'];
        $user_role        = $_POST['user_role'];
        $user_name      = $_POST['user_name'];
        $user_email    = $_POST['user_email'];
        $user_password = $_POST['user_password'];
       if(empty($user_password)) { 
          $query = "SELECT user_password FROM users WHERE user_id =  $user_id";
          $result = mysqli_query($connection, $query);
          confirmQuery($result);
          $row = mysqli_fetch_array($result);
          $user_password = $row['user_password'];  
       } else {
          $user_password = password_hash($user_password, PASSWORD_DEFAULT, array('cost' => 10));
       }
            $query = "UPDATE users SET ";
            $query .="user_firstname  = '{$user_firstname}', ";
            $query .="user_lastname = '{$user_lastname}', ";
            $query .="user_role   =  '{$user_role}', ";
            $query .="user_name = '{$user_name}', ";
            $query .="user_email = '{$user_email}', ";
            $query .="user_password   = '{$user_password}' ";
            $query .= "WHERE user_id = {$user_id} ";
  
            $edit_user_query = mysqli_query($connection,$query);
       
            confirmQuery($edit_user_query);
             echo "<p class='bg-success'>User Updated: "." "."<a href='users.php?u_id'>View Users</a></p>";
        }
    } else {
        header("Location:index.php");
    }
?>

    <form action="" method="post" enctype="multipart/form-data">    
      <div class="form-group">
         <label for="title">Firstname</label>
          <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
      </div>
       <div class="form-group">
         <label for="post_status">Lastname</label>
          <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
      </div>
     
     
    <div class="form-group">
       <select name="user_role" id="">   
           <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
       <?php 
          if($user_role == 'admin') {
             echo "<option value='subscriber'>subscriber</option>";
          } else {
            echo "<option value='admin'>admin</option>";
          }
      ?>
          </select>
      </div>


      <div class="form-group">
         <label for="post_tags">Username</label>
          <input type="text" value="<?php echo $user_name; ?>" class="form-control" name="user_name">
      </div>
      
      <div class="form-group">
         <label for="post_content">Email</label>
          <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
      </div>
      
      <div class="form-group">
         <label for="post_content">Password</label>
          <input type="password" value="" class="form-control" name="user_password">
      </div>
 
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
      </div>


</form>
    