<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 
<?php
    if (isset($_POST['submit'])) {
        $to = "Claudia_Zhang@homedepot.com";
        $subject = wordwrap($_POST['subject'], 70);
        $message = $_POST['message'];
       //$header = "From" . '{$_POST['email']}';
        mail($to, $subject, $message);
        
        if (!empty($username) && !empty($email) && !empty($password)) {
            $username = mysqli_real_escape_string($connection, $username);
            $email = mysqli_real_escape_string($connection, $email);
            $password = mysqli_real_escape_string($connection, $password);
            $password = password_hash($password, PASSWORD_DEFAULT, array('cost' => 10));
            $query = "INSERT INTO users(user_name, user_email, user_password, user_role)";
            $query .= "VALUES('{$username}', '{$email}', '{$password}', 'subscriber')";
            $result = mysqli_query($connection, $query);
            if (!$result) {
                die("QUERY FAILED".mysqli_error());
            }
            
        } 
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
                <h1>Contact</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                       
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" autocomplete="on" value="<?php echo isset($email) ? $email : '' ?>" >
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" autocomplete="on" placeholder="Enter Your Subject" value="<?php echo isset($subject) ? $subject : '' ?>" >
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Message</label>
                             <textarea class="form-control" name="message" id="message" cols="30" rows="10" placeholder="Enter Your Message"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
