<form action = "" method="post">
  <div class="form-group">
    <label for = "cate-title"> Edit Category</label>
    <?php
      if (isset($_GET['edit'])) {
        $cate_id = $_GET['edit'];
        $query = "select * from categories where cate_id = $cate_id";
        $new_result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($new_result)) {
          $cate_title = $row['cate_title'];
          $cate_id = $row['cate_id'];
       ?>
    <input value = "<?php if(isset($cate_title)){echo $cate_title;} ?>"
             type = "text" class="form-control" name="cate_title">
    <?php }} ?>
    <?php
      if(isset($_POST['update_cate'])) {
        $get_cate_title = $_POST['cate_title'];
        $query = "update categories set cate_title = '{$get_cate_title}'
                  where cate_id = {$cate_id}";
        $update_result = mysqli_query($connection, $query);
        if (!$update_result){
          die("FAILED TO UPDATE".mysqli_error());
        }
        header("Location:categories.php");
      }

    ?>
  </div>
  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_cate" value = "Update Category">
  </div>
</form>
