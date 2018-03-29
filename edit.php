<?php

include("includes/init.php");
include("includes/image.php");
$image_src = NULL;
echo $current_user;

if (isset($_POST["submit_upload"])) {
  var_dump($_FILES);
  $upload_info = $_FILES["box_file"];
  $upload_desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

  if ($upload_info['error'] == UPLOAD_ERR_OK) {
    $upload_name = basename($upload_info["name"]);
    $upload_ext = strtolower(pathinfo($upload_name, PATHINFO_EXTENSION) );

    $sql = "SELECT id FROM users WHERE account_name = :name";
    $params = array(
      ':name' => $current_user,
    );
    $userID = exec_sql_query($db, $sql, $params) ->fetchAll();
    var_dump($userID);

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
      if (move_uploaded_file($upload_info["tmp_name"], $temp_file)){
        array_push($messages, "Your file has been uploaded.");
        $image_src = $temp_file;
      }
    } else {
      array_push($messages, "Failed to upload file.");
    }
  } else {
    array_push($messages, "Failed to upload file.");
  }
}
?>

<!DOCTYPE html>
<html>


<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <!-- <link href='http://fonts.googleapis.com/css?family=Oleo+Script' rel='stylesheet' type='text/css'> -->

  <title>Home</title>
</head>

<body id="index">
  <?php

  include("includes/header.php");
  ?>

  <div id="content">
    <div class = "super_container">

        <div class = "main">
          <?php
          var_dump($image_src);
           echo  "<img src = '".$image_src . "'></img>";
          ?>

        </div>

        <!-- <div class = "search">
        </div> -->

  </div>
  <?php include("includes/footer.php");?>
</body>
</html>
