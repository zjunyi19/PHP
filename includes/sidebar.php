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
                            echo "<li><a href='#'> {$cate_title} </a></li>";
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

