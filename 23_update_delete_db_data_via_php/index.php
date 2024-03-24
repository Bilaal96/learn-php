<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update & Delete data from DB via PHP</title>
</head>

<body>
  <?php ?>

  <h3>Change Account</h3>
  <form action="includes/user-update.inc.php" method="POST">
    <input type="text" name="username" placeholder="Username">
    <input type="text" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Update</button>
  </form>

  <h3>Delete Account</h3>
  <form action="includes/user-delete.inc.php" method="POST">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Delete</button>
  </form>
</body>

</html>