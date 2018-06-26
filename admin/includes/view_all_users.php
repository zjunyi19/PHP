                      <table class = "table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>image</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            <?php
                                $query = "SELECT * FROM users";
                                $result = mysqli_query($connection, $query);
                                while($row = mysqli_fetch_assoc($result)) {
                                    $user_id = $row['user_id'];
                                    $user_name = $row['user_name'];
                                    $user_firstname = $row['user_firstname'];
                                    $user_lastname = $row['user_lastname'];
                                    $user_email = $row['user_email'];
                                    $user_status = $row['user_status'];
                                    $user_role = $row['user_role'];
                                    $user_password = $row['user_password'];
                                    echo "<tr>";
                                    echo "<td>{$user_id}</td>";
                                    echo "<td>{$user_name}</td>";
                                    echo "<td>{$user_firstname}</td>";
                                    echo "<td>{$user_lastname}</td>";
                                    echo "<td>{$user_email}</td>";
                                    echo "<td>{$user_role}</td>";
                                    echo "<td><image width = '100' 
                                                src='../images/$user_image' alt = 'image'></td>";
                                    
                                    echo "<td><a href= 'users.php?admin={$user_id}'>Admin</a></td>";
                                    echo "<td><a href= 'users.php?subscriber={$user_id}'>Subsriber</a></td>";
                                    echo "<td><a onclick=\"javascript: return confirm('Are you sure you want to delete?')   ;\" href= 'users.php?delete={$user_id}'>Delete</a></td>";
                                    echo "<td><a href= 'users.php?source=edit_user&u_id={$user_id}'>Edit</a></td>";
                                    echo "</tr>";
                                }
                                
                                ?>
                        </tbody>
                        
                        </table>
                        

<?php
    if(isset($_GET['admin'])) {
        $user_id = $_GET['admin'];
        $query = "UPDATE users SET user_role='admin' WHERE user_id = $user_id";
        $result = mysqli_query($connection, $query);
        header("Location:users.php");
        confirmQuery($result);
    }
    if(isset($_GET['subscriber'])) {
        $user_id = $_GET['subscriber'];
        $query = "UPDATE users SET user_role='subscriber' WHERE user_id = $user_id";
        $result = mysqli_query($connection, $query);
        header("Location:users.php");
        confirmQuery($result);
    }
    if(isset($_GET['delete'])) {
        $user_id = $_GET['delete'];
        $query = "DELETE FROM users WHERE user_id = {$user_id}";
        $result = mysqli_query($connection, $query);
        header("Location:users.php");
        confirmQuery($result);
    
    }
?>
