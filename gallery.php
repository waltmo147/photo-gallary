<?php
include('includes/init.php');
include('includes/image.php');
$search = NULL;

if (isset($_GET["search"])) {
  $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);
  $search = trim($search);
  if ($search) {
    $sql = 'SELECT photos.id, photos.file_ext FROM photos INNER JOIN matches ON photos.id = matches.photo_id INNER JOIN tags ON tags.id = matches.tag_id WHERE tags.tag = :tag';
    $params = array(':tag' => $search);
    $images = exec_sql_query($db, $sql, $params)->fetchAll();
  }
}

?>


<!DOCTYPE html>
<html lang = "en">


<head>
  <meta charset='UTF-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <link rel='stylesheet' type='text/css' href='styles/all.css' media='all' />
  <!-- <link href='http://fonts.googleapis.com/css?family=Oleo+Script' rel='stylesheet' type='text/css'> -->

  <title>Home</title>
</head>

<body id='index'>
  <?php
  include('includes/header.php');
  ?>

  <div id='content'>
    <div class = 'super_container'>

        <div class = 'main'>
          <div class = 'top-shelf-grey'>
            <h1>
              <?php
              if ($images) {
                echo htmlspecialchars($search);
              }
              else {
                echo "No result for ".htmlspecialchars($search);
              }
              ?>
            </h1>
          </div>

          <?php
          show_image($images);
          ?>

        </div>



        <!-- <div class = 'search'>

        </div> -->
        <div class = "side">
          <?php print_tags();?>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php');?>
</body>
</html>
