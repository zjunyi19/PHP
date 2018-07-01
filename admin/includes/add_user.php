
<?php

   if(isset($_POST['create_user'])) {
   
        $user_firstname    = $_POST['user_firstname'];
        $user_lastname     = $_POST['user_lastname'];
        $user_role         = $_POST['user_role'];
        $user_name          = $_POST['user_name'];
        $user_email        = $_POST['user_email'];
        $user_password     = $_POST['user_password'];
        $user_password = password_hash($user_password, PASSWORD_DEFAULT, array('cost' => 10));
       
      $query = "INSERT INTO users(user_firstname, user_lastname, user_role,user_name,user_email,user_password) ";
                 
            $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$user_name}','{$user_email}', '{$user_password}') "; 
             
      $add_user_result = mysqli_query($connection, $query);  
          
      confirmQuery($add_user_result);
      echo "<p class='bg-success'>User Created: "." "."<a href='users.php'>View Users</a></p>";
   }
    
?> 

    
<form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="user_firstname">First name</label>
          <input type="text" class="form-control" name="user_firstname">
      </div>
      <div class="form-group">
         <label for="user_lastname">Last name</label>
          <input type="text" class="form-control" name="user_lastname">
     </div>
    <div class="form-group">
         <label for="user_name">Username</label>
          <input type="text" class="form-control" name="user_name">
     </div>
     <div class="form-group">
         <label for="user_email">Email</label>
          <input type="email" class="form-control" name="user_email">
     </div>
    <div class="form-group">
         <label for="user_password">Password</label>
          <input type="password" class="form-control" name="user_password">
     </div>

    <div class="form-group">
       <label for="user_role">User role</label>
        <select name="user_role" id="">
            <option value="subscriber">Select Options</option>
              <option value="admin">Admin</option>
              <option value="subscriber">Subscriber</option>
        </select>
    </div>
    <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_user" value="Submit">
    </div>
</form>