<?php
include("includes/init.php");
include("includes/image.php");
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
          <form action="login.php" method="post">
            <h1>Log in</h1>

            <?php
            print_messages();
            ?>
            <div class = "login">
              <ul>
                <li>
                  <label class="login-left">Username:</label>
                  <input class="login-right" type="text" name="username" required/>
                </li>
                <li>
                  <label class="login-left">Password:</label>
                  <input class="login-right" type="password" name="password" required/>
                </li>
                <li>
                  <input class = "insert" name="login" type="submit" value="Login">
                </li>
              </ul>
            </div>
          </form>
        </div>

        <!-- <div class = "search">
        </div> -->

  </div>
  <?php include("includes/footer.php");?>
</body>
</html>
