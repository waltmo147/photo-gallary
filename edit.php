<?php

include("includes/init.php");
include("includes/image.php");
$image_src = NULL;
$uploader = NULL;

if (isset($_GET["tag"]) && isset($_GET["name"])) {
  $tag_name = filter_input(INPUT_GET, 'tag', FILTER_SANITIZE_STRING);
  $photo_name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
  if (isset($tag_name) && isset($photo_name)) {
    $sql = 'INSERT INTO tags (tag) SELECT :tag WHERE NOT EXISTS (SELECT * FROM tags WHERE tag = :tag)';
    $params = array(':tag' => $tag_name);
    $insert = exec_sql_query($db, $sql, $params);

    $sql = 'SELECT id FROM tags WHERE tag = :tag';
    $tag_id = exec_sql_query($db, $sql, $params)->fetchAll();

    $sql = 'INSERT INTO matches (tag_id, photo_id) SELECT :tag, :photo WHERE NOT EXISTS (SELECT * FROM matches WHERE tag_id = :tag AND photo_id = :photo)';
    $params = array(':tag' => (int)$tag_id[0]['id'], ':photo' => (int)$photo_name);

    $result = exec_sql_query($db, $sql, $params);
  }
  else {
    array_push($messages, "Failed to add, invalid tag.");
  }
}

if (isset($_GET["delete"])) {
  $delete = filter_input(INPUT_GET, 'delete', FILTER_SANITIZE_STRING);
  $sql = "SELECT id FROM tags WHERE tag = :tag";
  $params = array(':tag' => $delete);
  $delete_id = exec_sql_query($db, $sql, $params)->fetchAll();
  if ($delete_id) {
    $sql = "DELETE FROM matches WHERE tag_id = :id";
    $params = array(':id' => $delete_id[0]['id']);
    $delete_res = exec_sql_query($db, $sql, $params);
  }
  else {
    array_push($messages, "Failed to delete.");
  }
}

if (isset($_GET["name"])) {
  $photo_name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
  $sql = 'SELECT * FROM photos LEFT OUTER JOIN matches ON photos.id = matches.photo_id
  LEFT OUTER JOIN tags ON tags.id = matches.tag_id
  LEFT OUTER JOIN users ON users.id = photos.uploader WHERE photos.id = :id';
  $params = array(':id' => $photo_name);
  $images = exec_sql_query($db, $sql, $params)->fetchAll();
  $image_src = $photo_name.".".$images[0]["file_ext"];
  $uploader = $images[0]["account_name"];
}
?>

<!DOCTYPE html>
<html lang = "en">


<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <!-- <link href='http://fonts.googleapis.com/css?family=Oleo+Script' rel='stylesheet' type='text/css'> -->

  <title>Home</title>
</head>

<body>
  <?php

  include("includes/header.php");
  ?>

  <div id="content">
    <div class = "super_container" id="edit1-super-container">

        <div class = "main" id="edit1-container">

          <?php echo "<img alt = ".htmlspecialchars($image_src)." src = 'uploads/images/". htmlspecialchars($image_src). "'>";?>

          <ul>
            <li>
              <?php echo htmlspecialchars($images[0]["file_name"]); ?>
            </li>
            <li>
              uploaded by <?php echo htmlspecialchars($uploader); ?>
            </li>
            <li>
              <?php
              foreach($images as $image) {
                echo "<a>";
                echo htmlspecialchars($image["tag"]);
                echo "</a>";
              }
              ?>
            </li>

            <li>
              <form action="edit.php" method="get">
                <label>Add a tag </label>
                <input type="text" name="tag" required/>
                <button name="name" type="submit" value=<?php echo htmlspecialchars($_GET["name"]); ?>>input</button>
              </form>
              <?php
              print_messages();
              ?>
            </li>
            <?php
            delete_tag($images, $photo_name);
            ?>
          </ul>

        </div>
      </div>
  </div>
  <?php include("includes/footer.php");?>
</body>
</html>
