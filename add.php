<?php

include("includes/init.php");
include("includes/image.php");
$image_src = NULL;

// add the image into the db
if (isset($_POST["submit_upload"])) {
  $upload_info = $_FILES["box_file"];
  // if the upload info is valid
  if ($upload_info['error'] == UPLOAD_ERR_OK) {
    $upload_name = basename($upload_info["name"]);
    $upload_ext = strtolower(pathinfo($upload_name, PATHINFO_EXTENSION) );

    // check if the file is an image
    if (in_array($upload_ext, $image_ext)) {
      $sql = "SELECT id FROM users WHERE account_name = :name";
      $params = array(
        ':name' => $current_user,
      );
      $userID = exec_sql_query($db, $sql, $params) ->fetchAll();

      $sql = "INSERT INTO photos (file_name, file_ext, uploader) VALUES (:filename, :extension, :uploader)";
      $params = array(
        ':extension' => $upload_ext,
        ':filename' => $upload_name,
        ':uploader' => $userID[0]["id"],
      );
      $result = exec_sql_query($db, $sql, $params);


      if ($result) {
        $file_id = $db->lastInsertId("id");
        $temp_file = BOX_UPLOADS_PATH . "$file_id.$upload_ext";

        // if the user put in a tag for this image, add it to the db
        if (isset($_POST["tag"])) {
          $tag_name = filter_input(INPUT_POST, 'tag', FILTER_SANITIZE_STRING);
          $tag_name = trim($tag_name);

          // make sure the tag is valid
          if (isset($tag_name) && isset($file_id)) {
            $sql = 'INSERT INTO tags (tag) SELECT :tag WHERE NOT EXISTS (SELECT * FROM tags WHERE tag = :tag)';
            $params = array(':tag' => $tag_name);
            $insert = exec_sql_query($db, $sql, $params);

            $sql = 'SELECT id FROM tags WHERE tag = :tag';
            $tag_id = exec_sql_query($db, $sql, $params)->fetchAll();

            $sql = 'INSERT INTO matches (tag_id, photo_id) SELECT :tag, :photo WHERE NOT EXISTS (SELECT * FROM matches WHERE tag_id = :tag AND photo_id = :photo)';
            $params = array(':tag' => (int)$tag_id[0]['id'], ':photo' => (int)$file_id);

            $result = exec_sql_query($db, $sql, $params);
          }
          else {
            array_push($messages, "Failed to add invalid tag.");
          }
        }
        if (move_uploaded_file($upload_info["tmp_name"], $temp_file)){
          array_push($messages, "Your file has been uploaded.");
          $image_src = $temp_file;
        }
      } else {
        array_push($messages, "Failed to upload file.");
      }
    }
    else {
      array_push($messages, "Not an image.");
      array_push($messages, "Extension should be 'jpg', 'jpeg' or 'png'.");
    }
  } else {
    array_push($messages, "Failed to upload file.");
  }
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
    <div class = "super_container" id="edit-super-container">

        <div class = "main" id="edit-container">

          <form id="uploadFile" action="add.php" method="post" enctype="multipart/form-data">
            <?php
            print_messages();
            ?>
            <ul>
              <li>
                <label>Upload an image:</label>
              </li>
              <li>
                <!-- MAX_FILE_SIZE must precede the file input field -->
                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />
                <input type="file" name="box_file" required>
              </li>
              <li>
                <label>Add a tag for it:</label>
              </li>
              <li>
                <input type="text" name="tag">
              </li>
              <li>
                <button name="submit_upload" type="submit">Upload</button>
              </li>
            </ul>
          </form>

        </div>

        <!-- <div class = "search">
        </div> -->
      </div>
  </div>
  <?php include("includes/footer.php");?>
</body>
</html>
