<div class="center container">
  <?php

    // Create associative array for errors on the page
    $errors = ['title'=>'', 'contents'=>''];

    // Initialize the input values (start as empty)
    $title = $contents = '';

    if(isset($_POST['submit'])){
        if(empty($_POST['title'])){
          $contents = $_POST['contents'];
          $title = $_POST['title'];
          $errors['title'] = "A title is required.";
        }
        else if(empty($_POST['contents'])){
          $contents = $_POST['contents'];
          $title = $_POST['title'];
          $errors['contents'] = "Contents are required.";
        }
        else{
          if(preg_match('/^[a-zA-Z\s]+$/', $_POST['title'])){
            echo "Successfully used the HTTP POST method. <br/>";
            echo "Title: " . $_POST['title'] . "<br/>";
            echo "Contents: " . $_POST['contents'] . "<br/>";
          }
          else{
            $contents = $_POST['contents'];
            $title = $_POST['title'];
            $errors['title'] = "Title must only contain letters.";
          }
        }
      }
  ?>

</div>

<?php include("./templates/header.php") ?>

<section class="container">
  <form class="white" action="./addPost.php" method="POST" autocomplete="off">
    <h4 class="center">Add Post</h4>
    <label>Title:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>">
    <div class="">
      <p class="red-text"><?php echo $errors['title']; ?></p>
    </div>
    <label>Contents:</label>
    <input type="text" name="contents" value="<?php echo htmlspecialchars($contents); ?>">
    <div class="">
      <p class="red-text"><?php echo $errors['contents']; ?></p>
    </div>
    <div class="center">
      <input class="btn beige-color z-depth-0" type="submit" name="submit" value="POST">
    </div>
  </form>
</section>

<?php include("./templates/footer.php") ?>
