<?php

// Enforce required Type Declarations
declare(strict_types=1);

function checkSignupErrors() {
  if (isset($_SESSION["errors_signup"])) {
    // Assign errors array to a variable
    // This is important as eventually we want to unset any session variables that 
    // ... aren't being used
    $errors = $_SESSION["errors_signup"];

    echo "<br>";

    foreach ($errors as $error) {
      echo "<p class='form-error'>" . $error . "</p>";
    }

    unset($_SESSION["errors_signup"]);
  } else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
    // No errors, display signup success message
    echo "<br>";
    echo "<p class='form-success'>Signup Success!</p>";
  }
}

/** Return inputs with user-submitted username and/or email, if they're not already in use
 * if username entered & username is not taken -> return the input WITH username 
 * if username is taken -> then user should enter something else -> return the input with NO value 
 * has username? & DOES NOT have username_taken error?
 * 
 * 
 */
function renderSignupInputs() {
  // Username
  if (isset($_SESSION["signup_form_data"]["username"]) && !isset($_SESSION["errors_signup"]["username_taken"])) {
    $username = $_SESSION["signup_form_data"]["username"];
    echo "<input type='text' name='username' placeholder='Username...' value='$username'>";
  } else {
    echo "<input type='text' name='username' placeholder='Username...'>";
  }

  // Email
  if (isset($_SESSION["signup_form_data"]["email"]) && !isset($_SESSION["errors_signup"]["email_used"]) && !isset($_SESSION["errors_signup"]["invalid_email"])) {
    $email = $_SESSION["signup_form_data"]["email"];
    echo "<input type='text' name='email' placeholder='E-mail...' value='$email'>";
  } else {
    echo "<input type='text' name='email' placeholder='E-mail...'>";
  }

  // Password
  echo "<input type='password' name='password' placeholder='Password...'>";

  // Clear input values stored in Session Variable 
  // NOTE: if you don't include this, logging in successfully AFTER a failed attempt
  // ... will return the inputs with the values from the failed attempt
  // The request would still be successful either way
  unset($_SESSION["signup_form_data"]);
}
