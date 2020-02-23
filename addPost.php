<div class="center container">
  <?php

    // Establish MySQL connection
    $conn = mysqli_connect('localhost', 'dion', 'password', 'php_blog');

    // Setting user to 1
    $user = 1;

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
            echo "Posted: {$_POST['title']}";

            // Adding post to the blog table
            $sql_title = mysqli_real_escape_string($conn, $_POST['title']);
            $sql_contents = mysqli_real_escape_string($conn, $_POST['contents']);
            $query = "INSERT blogs VALUES(NULL, '$sql_title', '$sql_contents', $user, NULL)";
            mysqli_query($conn, $query);

            // Error handling
            $error = mysqli_error($conn);
            if(mysqli_error($conn)){
              echo "MySQL Error: {$error}";
            }

            // Clear inputs after posting
            $title = $contents = '';

          }
          else{
            $contents = $_POST['contents'];
            $title = $_POST['title'];
            $errors['title'] = "Title must only contain letters.";
          }
        }
      }

      if(isset($_POST['clear'])){
        $query1 = "DELETE FROM blogs";
        $query2 = "ALTER TABLE blogs AUTO_INCREMENT = 1";

        mysqli_query($conn, $query1);
        mysqli_query($conn, $query2);
      }


      // Query to get all blogs
      $query = "SELECT * FROM blogs";
      $result = mysqli_query($conn, $query);
      $blogs = mysqli_fetch_all($result, MYSQLI_ASSOC);
      mysqli_free_result($result);

  ?>

</div>

<?php include("./templates/header.php") ?>

<section class="center">
  <?php foreach($blogs as $blog){ ?>
    <div class="center">
      <p><?php echo $blog['title']; ?></p>
      <p><?php echo $blog['contents']; ?></p>
    </div>
  <?php } ?>
</section>

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

<section class="container">
  <form class="white" action="./addPost.php" method="POST">
    <input class="btn beige-color" type="submit" name="clear" value="clear">
  </form>
</section>

<?php include("./templates/footer.php") ?>
