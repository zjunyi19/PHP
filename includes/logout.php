<?php session_start(); ?>

<?php
     $_SESSION['user_lastname'] = NULL;
     $_SESSION['user_firstname'] = NULL;
     $_SESSION['user_role'] = NULL;
     $_SESSION['user_name'] = NULL;
     header("Location:../index.php");
    
?>