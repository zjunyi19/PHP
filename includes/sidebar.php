           <div class="col-md-4">
               

                <!-- Blog Search Well -->
                <div class="well">
                   <form action="search.php" method = "post">
                        <h4>Blog Search</h4>
                        <div class="input-group">
                            <input name = "search" type="text" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" name="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>
                
                <!-- Login -->
                <div class="well">
                   <form action="includes/login.php" method = "post">
                        <h4>Login</h4>
                        <div class="form-group">
                            <input name = "username" type="text" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="input-group">
                            <input name = "password" type="password" class="form-control" placeholder="Enter Password">
                            <span class = "input-group-btn">
                                <button class="btn btn-primary" name="login" type="submit">Submit</button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                   <?php
                        $query = "select * from categories";
                        $result = mysqli_query($connection, $query);
                    ?>
                        <h4>Blog Categories</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <ul class="list-unstyled">
                    <?php
                        while($row = mysqli_fetch_assoc($result)) {
                            $cate_title = $row['cate_title'];
                            $cate_id = $row['cate_id'];
                            echo "<li><a href='category.php?c_id=$cate_id'> {$cate_title} </a></li>";
                        }
                    ?>
                                    </ul>
                                </div>
                            </div>
                    <!-- /.row -->
                </div>
                
                

                <!-- Side Widget Well -->
                <?php include "widget.php" ?>

            </div>

