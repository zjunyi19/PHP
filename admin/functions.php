<?php
function insert_categories(){
  global $connection;
  if (isset($_POST['submit'])) {
    $cate_title = $_POST['cate_title'];
    if($cate_title == " " || empty($cate_title)) {
      echo "This field should not be empty.";
    } else {
      $query = "insert into categories(cate_title)";
      $query .= "value('{$cate_title}')";
      $result = mysqli_query($connection, $query);
      if (!$result) {
        die("FAILED TO INSERT".mysqli_error());
      }
    }
  }
}
function delete_categories(){
  global $connection;
  if(isset($_GET['delete'])) {
    $get_cate_id = $_GET['delete'];
    $query = "delete from categories where cate_id = {$get_cate_id}";
    $get_result = mysqli_query($connection, $query);
    if (!$get_result){
      die("FAILED TO DELETE".mysqli_error());
    }
    // refresh the page, otherwise we need to click delete twice
    header("Location:categories.php");
  }
}

function find_all_categories(){
  global $connection;
  $query = "select * from categories";
  $result = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    $cate_title = $row['cate_title'];
    $cate_id = $row['cate_id'];
    echo "<tr>";
    echo "<td>{$cate_id}</td>";
    echo "<td>{$cate_title}</td>";
    echo "<td><a href='categories.php?delete={$cate_id}'>delete</a></td>";
    echo "<td><a href='categories.php?edit={$cate_id}'>Edit</a></td>";
    echo "</tr>";
  }
}

function confirmQuery($result){
    global $connection;
    if(!result) {
        die("FAILED QUERY". mysqli_error($connection));
    }
}











?>
