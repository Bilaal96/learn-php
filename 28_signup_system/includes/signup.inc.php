<?php

// Validate script access method
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: ../index.php");
  die();
}

$username = $_POST["username"];
$email = $_POST["email"];
$pwd = $_POST["password"];

try {
  // The order of the imports is important, especially when working with OOP
  // -- DB connection, Model, View, then Controller
  // NOTE: we don't need access to the View here, so we can leave it out
  require_once './dbh.inc.php'; // Establish DB connection
  require_once './signup_model.inc.php'; // signup model 
  require_once './signup_contr.inc.php'; // signup controller

  // ERROR HANDLERS
  // Allow us to ensure things are running appropriately and gracefully fail (if not)
  // e.g. validate input values, display errors to user if invalid
  // We won't write this code here directly
  // In order to figure out where this code goes ask yourself:
  // -- are we trying to query/mutate data in DB? --> model
  // -- are we trying to show/output something to the user in the website? --> view
  // -- are we trying to take user data and do something with it? --> controller
  // Here we want to go into the controller

  $errors = [];

  if (isInputEmpty($username, $email, $pwd)) {
    // ERROR: all fields are required
    $errors["empty_input"] = "Fill in all fields!";
  }

  if (isEmailInvalid($email)) {
    // ERROR: email is invalid
    $errors["invalid_email"] = "Invalid email used!";
  }

  if (isUsernameTaken($pdo, $username)) {
    // ERROR: user already exists
    $errors["username_taken"] = "Username already taken!";
  }

  if (isEmailRegistered($pdo, $email)) {
    // ERROR: email already registered to another user
    $errors["email_used"] = "Email already registered!";
  }

  // Assign form input errors to a Session Variable
  // NOTE: we must have an existing session in order to do so
  // Doing this instead of manually calling session_start() will also invalidate 
  // ... the Session ID if necessary and regenerate a new one, which is more secure
  require_once "./config_session.inc.php";

  // NOTE: an empty array is falsy in PHP (and in JS they're truthy)
  if ($errors) {
    $_SESSION["errors_signup"] = $errors;

    // User submitted data, to be returned to client
    // NOTE: We DO NOT send back then password for security reasons 
    $signupFormData = [
      "username" => $username,
      "email" => $email
    ];

    // Send user input back via Session superglobal
    $_SESSION["signup_form_data"] = $signupFormData;

    // Return to homepage
    header("Location: ../index.php");
    die(); // stop script execution here
  }

  // No errors, create user
  createUser($pdo, $username, $email, $pwd);

  // Redirect to home on successful user creation
  // Set signup success indicator via URL query params
  // This can be used to output a signup success message in the UI
  header("Location: ../index.php?signup=success");
} catch (PDOException $e) {
  die("Query failed: " . $e->getMessage());
} finally {
  $stmt = null;
  $pdo = null;
}

die();
