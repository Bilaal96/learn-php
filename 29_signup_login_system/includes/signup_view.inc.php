<?php

declare(strict_types=1);

function checkSignupErrors() {
  if (isset($_SESSION["signup_errors"])) {
    $errors = $_SESSION["signup_errors"];

    echo "<br>";

    foreach ($errors as $error) {
      echo "<p class='form-error'>$error</p>";
    }

    unset($_SESSION["signup_errors"]);
  } else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
    // Display success message
    echo "<br>";
    echo "<p class='form-success'>Registration successful</p>";
  }
}

/* <input type="text" name="username" placeholder="Username...">
    <input type="email" name="email" placeholder="E-mail...">
    <input type="password" name="password" placeholder="Password..."> */

function renderSignupInputs() {
  // Username
  if (isset($_SESSION["signup_form_data"]["username"]) && !isset($_SESSION["signup_errors"]["username_taken"])) {
    $username = $_SESSION["signup_form_data"]["username"];
    echo "<input type='text' name='username' placeholder='Username...' value='$username'> ";
  } else {
    echo "<input type='text' name='username' placeholder='Username...'>";
  }

  // Email
  if (isset($_SESSION["signup_form_data"]["email"]) && !isset($_SESSION["signup_errors"]["email_invalid"]) && !isset($_SESSION["signup_errors"]["email_used"])) {
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
