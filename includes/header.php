<header>
  <nav id="menu">
    <ul class = "left">
      <a class = "icons" href = "index.php">
        <i class="fa fa-home icons"></i>
      </a>

      <?php
      if (isset($current_user)) {
      ?>
        <?php
        echo "<li><a href = 'edit.php'>Add Image</a></li>";
      }
      ?>
    </ul>
    <ul class = "right">
      <form method="post" action="login.php">
      <?php
      if (isset($current_user)) {
        echo "<li><a>Hi, ".$current_user."</a></li>";
        echo "<li><input name='logout' type='submit' value='Logout'></li>";
      }
      else {
        echo "<li><input name='login-page' type='submit' value='Login'></li>";
      }
      ?>
    </form>
  </ul>
  </nav>
</header>
