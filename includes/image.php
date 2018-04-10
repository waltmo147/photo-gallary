<?php

// function for showing the images
function show_image($images) {
  echo "<form action='edit.php' method='get'>";
  foreach ($images as $image) {
    echo "<button class='img-container' type='submit' name='name' value=".htmlspecialchars($image["id"]).">";
    echo "<img alt = ".htmlspecialchars($image["id"])." src = 'uploads/images/". htmlspecialchars($image["id"]) . "." . htmlspecialchars($image["file_ext"]) . "'>";
    echo "</button>";
  }
  echo "</form>";
}

// if there is a user logged in, show the delete bar
function delete_tag($tags, $photo) {
  global $current_user;
  global $uploader;
  if (isset($current_user) && $uploader == $current_user) {

    echo "<li><form action='edit.php' method='get'>";
    echo "<label>Choose a tag to delete:</label>
      <select name='delete' required>
      <option value='' selected disabled>choose one</option>";
    foreach($tags as $tag) {
      echo "<option value=\"" . htmlspecialchars($tag["tag"]) . "\">" . htmlspecialchars($tag["tag"]) . "</option>";
    }
    echo "</select>";
    echo "<button name='name' type='submit' value=".htmlspecialchars($photo).">delete</button>";
    echo "</form></li>";
  }
}

// print out the tags
function print_tags() {
  global $db;
  $sql = 'SELECT tag FROM tags';
  $tags = exec_sql_query($db, $sql, NULL) -> fetchAll();
  foreach ($tags as $tag) {
    echo "<a>";
    echo htmlspecialchars($tag["tag"]);
    echo "</a>";
  }

}

$image_ext = array("jpg", "jpeg", "png", "gif");
?>
