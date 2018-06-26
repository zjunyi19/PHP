<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 
<?php
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if (!empty($username) && !empty($email) && !empty($password)) {
            $username = mysqli_real_escape_string($connection, $username);
            $email = mysqli_real_escape_string($connection, $email);
            $password = mysqli_real_escape_string($connection, $password);
        
            $query = "SELECT user_randSalt FROM users";
            $result = mysqli_query($connection, $query);
            if (!$result) {
                die("QUERY FAILED".mysqli_error());
            }
            $row = mysqli_fetch_assoc($result);
            $randSalt = $row['user_randSalt'];
        
            $password = crypt($password, $randSalt);
            $query = "INSERT INTO users(user_name, user_email, user_password, user_role)";
            $query .= "VALUES('{$username}', '{$email}', '{$password}', 'subscriber')";
            $result = mysqli_query($connection, $query);
            if (!$result) {
                die("QUERY FAILED".mysqli_error());
            }
            $message = "Your registration has been submitted";
        } else {
            $message = "Fields cannot be empty";
        }     
    } else {
        $message = "111111";
    }
?>
 

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                       
                        <h6 class="text-center"><?php echo $message;?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username"

                            autocomplete="on"

                            value="<?php echo isset($username) ? $username : '' ?>">

                           
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" autocomplete="on" value="<?php echo isset($email) ? $email : '' ?>" >

              
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">

                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
