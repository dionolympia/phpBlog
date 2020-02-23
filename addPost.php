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

        // Don't allow empty title
        if(empty($_POST['title'])){
          $contents = $_POST['contents'];
          $title = $_POST['title'];
          $errors['title'] = "A title is required.";
        }

        // Don't allow empty content
        if(empty($_POST['contents'])){
          $contents = $_POST['contents'];
          $title = $_POST['title'];
          $errors['contents'] = "Contents are required.";
        }

        // Validate title

        if(!empty($_POST['title']) && preg_match('/^[a-zA-Z\s]+$/', $_POST['title'])){

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
            if(!empty($_POST['title'])){
              $contents = $_POST['contents'];
              $title = $_POST['title'];
              $errors['title'] = "Title must only contain letters.";
            }
          }

        }


      // Clear blogs
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
  <main>


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




    <section>
      <div class="container">
        <?php foreach(array_reverse($blogs) as $blog){ ?>
          <div class="row">
            <div class="col s3">
            </div>
            <div class="card center">
              <div class="card-content grey lighten-1">
                <p><?php echo "{$blog['title']}"; ?></p>
              </div>
              <div class="card-content white">
                <p class="flow-text"><?php echo "{$blog['contents']}";?></p>
              </div>
              <div class="card-action">
                  <a class="black-text"><?php echo "Post ID: {$blog['id']}"; ?></a>
                  <a class="black-text"><?php echo "User ID: {$blog['user_id']}"; ?></a>
                  <a class="black-text"><?php echo "Time Created: {$blog['time_created']}"; ?></a>
              </div>


            </div>
            <div class="col s3">
            </div>
          </div>
        <?php } ?>
      </div>
    </section>

    <?php if($blogs){?>
      <form class="white" action="./addPost.php" method="POST">
        <input class="btn beige-color z-depth-0" type="submit" name="clear" value="clear">
      </form>
    <?php } ?>
  </main>


<?php include("./templates/footer.php") ?>
