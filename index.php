<?php
include('includes/init.php');
include('includes/image.php');
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
            <form id='searchForm' action='gallery.php' method='get'>
              <input class='search' type='text' placeholder='Search..' name='search'>
              <button type='submit'><i class='fa fa-search'></i></button>
            </form>
          </div>

          <?php
          $images = exec_sql_query($db, 'SELECT * FROM photos', NULL)->fetchAll();
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
