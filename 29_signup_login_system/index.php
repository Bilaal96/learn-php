<?php
require_once "./includes/config_session.inc.php";
require_once "./includes/signup_view.inc.php";
require_once "./includes/login_view.inc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Homepage</title>
</head>

<body>

  <h3><?php outputUsername(); ?></h3>
  <br>
  <p><?= "User ID: " . ($_SESSION["user_id"] ?? "NULL"); ?></p>
  <p><?= "Session ID: " . (session_id() ? session_id() : "NONE"); ?></p>

  <?php if (!isset ($_SESSION["user_id"])): ?>
    <form action="includes/login.inc.php" method="POST">
      <h2>Login</h2>
      <input type="text" name="username" placeholder="Username...">
      <input type="password" name="password" placeholder="Password...">
      <button>Login</button>
    </form>

    <?php checkLoginErrors(); ?>

    <form action="includes/signup.inc.php" method="POST">
      <h2>Signup</h2>
      <?php renderSignupInputs(); ?>
      <button>Signup</button>
    </form>

    <?php checkSignupErrors(); ?>
  <?php else: ?>
    <form action="includes/logout.inc.php">
      <button type="submit">Logout</button>
    </form>
  <?php endif; ?>
</body>

</html>