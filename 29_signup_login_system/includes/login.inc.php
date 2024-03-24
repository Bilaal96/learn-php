<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: ../index.php");
  exit();
}

$username = $_POST["username"];
$password = $_POST["password"];

try {
  require_once './dbh.inc.php';
  require_once './login_model.inc.php';
  require_once './login_contr.inc.php';

  // Input validation
  $errors = [];

  // -- inputs are empty
  if (areInputsMissingValues($username, $password)) {
    $errors["empty_inputs"] = "Please fill in ALL fields!";
  }

  // -- fetch user from DB
  $user = getUser($pdo, $username);

  // -- user with username given does not exist
  if (!userExists($user)) {
    // A user with the given username could not be found
    // NOTE: the error is intentionally vague, so as to not reveal which input was wrong
    $errors["login_incorrect"] = "Incorrect username/password!";
  }

  // -- user found, password does not match
  if (userExists($user) && isPasswordIncorrect($password, $user["pwd"])) {
    $errors["login_incorrect"] = "Incorrect username/password!";
  }

  require_once "./config_session.inc.php"; // calls session_start()

  // Handle validation errors
  // NOTE: here we don't necessarily have to preserve the value of the username input
  if ($errors) {

    // Set login errors in session var
    $_SESSION["login_errors"] = $errors;

    // Redirect to home, where errors will be displayed
    header("Location: ../index.php");
    die();
  }

  /** Log user in
   * Whenever something relating to users or something that could affect user 
    permissions/access changes, it is a good security practice to update the Session 
    ID Cookie again, by regenerating the Session ID
   * This invalidates the previous Session ID (in case it was somehow intercepted)

   * Additionally on login, when we regenerate the Session ID, we can combine it with
    the user ID for a more complex ID - this will be less easy to predict
   * This combination also allows you to associate a user with a session via the user ID
   
   session_create_id()
   * Creates a new session id
   * To which we can append our logged in user's ID - as assigned to $sessionID (below)
   * NOTE: if you pass a string as an argument, the string is prefixed to the Session ID

   session_id()
   * Used to either get/set the Session ID
   * To set the Session ID, you must pass it as an argument 
   * To get the Session ID, call it without passing an argument 
   */
  print("<pre>" . var_export($user, true) . "</pre>");
  print("<pre>" . var_export($_SESSION, true) . "</pre>");

  /* 
  //! ----- session_id($newId) - MUST BE CALLED BEFORE session_start() -----
  $sessionId = session_create_id();
  $sessionIdWithUserId = $sessionId . "_" . $user["id"];
  echo "Expected: " . $sessionIdWithUserId . "<br>"; // ? What we wanted: '<session_id>_<user_id>'

  // Update the ID of the current session to use our newly generated $sessionID
  // ! outputs warning instead of updating session_id:
  // ! Warning: session_id(): Session ID cannot be changed when a session is active
  session_id($sessionIdWithUserId);
  echo "<br>Actual: " . session_id() . "<br>"; // ! Does not include the appended user_id

  // Update Session Variable that tracks when session was last regenerated
  $_SESSION["last_regen"] = time();
  //! ---------------------------------------------------------------------- 
  */

  /** 
   ** Ignore the commented out code above, it was part of the tutorial but doesn't work as intended
   ** We can associate a user_id with the current session by simply storing the user_id as a session variable
   */

  // Set user data as Session Variable (using user fetched from DB)
  // NOTE: if a variable is going to be output in the browser, we need to escape the 
  // ... string/value to prevent XSS attacks - use htmlspecialchars() to do this
  $_SESSION["user_id"] = $user["id"];
  $_SESSION["user_username"] = htmlspecialchars($user["username"]); // may be rendered in browser

  // Redirect user to home with success message
  header("Location: ../index.php?login=success");

  // Close connections
  $stmt = null;
  $pdo = null;

  // Terminate script
  die();
} catch (PDOException $e) {
  die("Query failed: " . $e->getMessage());
}
