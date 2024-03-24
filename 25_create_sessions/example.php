<?php

// Start/resume a session in the CURRENT page (i.e. example.php)
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Creating Sessions in PHP</title>
</head>

<body>
  <h1>Example Page</h1>
  <p>This page simply demonstrates that the session retains data stored inside it across pages.</p>

  <!-- NOTE: our session data created on the homepage is still accessible here -->
  <!-- UNCOMMENT EXAMPLES TO OBSERVE EFFECTS -->

  <!-- ------------ Access Session Variables that were set elsewhere ------------ -->
  <!-- NOTE: '@' prefixed to an expression/statement will suppress errors/warning -->
  <p>This session belongs to: <?php echo "<strong>" . @var_export($_SESSION["username"], true) . "</strong><br>"; ?></p>
  <br>

  <?php

  /* ------ unset($_SESSION["varName"]) - Clear a single Session Variable ----- */
  // unset($_SESSION["username"]);
  // echo "username: " . @var_export($_SESSION["username"], true) . "<br>"; // no value assigned, so it resolves to NULL

  /* -------------- session_unset() - clear ALL session variables ------------- */
  /* After being unset, each Session Variable has no value assigned, so they resolves to NULL */
  /* This is like calling unset() on all the Session Variables */
  // session_unset();

  /* ------------------ End a session with session_destroy() ------------------ */
  /* This removes session on server-side and all associated Session Variables */
  // session_destroy();

  /* NOTE: comment out the above function calls & observe the output */
  /* After being unset / destroyed, each Session Variable has no value assigned, so they resolves to NULL */
  echo "username: " . @var_export($_SESSION["username"], true) . "<br>"; // NULL
  echo "<br>";

  echo "firstName: " . @var_export($_SESSION["firstName"], true) . "<br>"; // NULL
  echo "<br>";

  echo "dob: " . @var_export($_SESSION["dob"], true) . "<br>"; // NULL
  echo "<br>";

  echo "hobbies: " . @var_export($_SESSION["hobbies"], true) . "<br>"; // NULL
  echo "<br>";
  ?>

  <a href="index.php">Back to Homepage</a>
</body>

</html>