<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: ../index.php");
  exit();
}

// Get inputs
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

require_once './dbh.inc.php';
require_once './signup_model.inc.php';
require_once './signup_contr.inc.php';

try {
  $errors = [];

  // Validate Inputs
  // -- not all fields have a value
  if (areInputsMissingValues($username, $email, $password)) {
    $errors["empty_input"] = "Please fill in ALL fields!";
  }
  // -- email is invalid
  if (isEmailInvalid($email)) {
    $errors["email_invalid"] = "Invalid email format!";
  }
  // -- username is taken
  if (isUsernameTaken($pdo, $username)) {
    $errors["username_taken"] = "Username is taken!";
  }
  // -- email already taken
  if (isEmailRegistered($pdo, $email)) {
    $errors["email_used"] = "Email is already in use!";
  }

  // Assign errors (if any) to Session Variable 
  if ($errors) {
    require_once './config_session.inc.php';

    $_SESSION["signup_errors"] = $errors;

    $_SESSION["signup_form_data"] = [
      "username" => $username,
      "email" => $email,
    ];

    // Redirect & display errors
    header("Location: ../index.php");
    die();
  }

  // Insert user in DB
  insertUser($pdo, $username, $email, $password);

  // Close connections
  $stmt = null;
  $pdo = null;

  // No error: redirect to index.php?signup=success & output success message to user
  header("Location: ../index.php?signup=success");
  die();
} catch (PDOException $e) {
  die("Query failed: " . $e->getMessage());
}
