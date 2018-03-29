<?php
// Use this file to hash passwords for your database.
// You should not use it for your live site.
$password = $_GET["password"];
$hash = password_hash($password, PASSWORD_DEFAULT);
echo $hash;
?>
