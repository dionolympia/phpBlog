<?php

  $conn = mysqli_connect('localhost', 'dion', 'password', 'php_blog');

  if(!$conn){
    echo 'Connection error: ' . mysqli_connect_error();
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Templating Header & Footer - Practice Exercise</title>
  </head>

  <body class = "grey lighten-4">
    <?php include('./templates/header.php'); ?>
    <?php include('./templates/footer.php') ?>
</html>
