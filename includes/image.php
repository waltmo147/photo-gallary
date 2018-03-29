<?php
function show_image($images) {
  foreach ($images as $image) {
    echo "<div class='img-container'>";
    echo "<img src = 'uploads/images/". htmlspecialchars($image["id"]) . "." . htmlspecialchars($image["file_ext"]) . "'></img>";
    echo "</div>";
  }
}
?>
