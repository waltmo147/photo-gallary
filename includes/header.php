<header>
  <nav id="menu">
    <ul class = "left">
      <li>
        <a class = "icons" href = "index.php">
          <i class="fa fa-home icons"></i>
        </a>
      </li>
      <?php
      if (isset($current_user)) {
      ?>
        <?php
        echo "<li><a href = 'add.php'>Add Image</a></li>";
      }
      ?>

    </ul>
    <div class = "center">
      FOTO
    </div>
    <form method="post" action="login.php">
    <ul class = "right">

      <?php
      if (isset($current_user)) {
        echo "<li><a>Hi, ".htmlspecialchars($current_user)."</a></li>";
        echo "<li><input name='logout' type='submit' value='Logout'></li>";
      }
      else {
        echo "<li><input name='login-page' type='submit' value='Login'></li>";
      }
      ?>
    </ul>
    </form>
  </nav>
</header>
