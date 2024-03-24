<?php

declare(strict_types=1);

function checkLoginErrors() {
  if (isset ($_SESSION["login_errors"])) {
    $errors = $_SESSION["login_errors"];

    echo "<br>";

    foreach ($_SESSION["login_errors"] as $error) {
      echo "<p class='form-error'>$error</p>";
    }

    // Errors have been output to user & are no longer needed
    // Clear them from $_SESSION
    unset($_SESSION["login_errors"]);
  } else if (isset ($_GET["login"]) && $_GET["login"] === "success") {
    echo "<p class='form-success'>Login successful!</p>";
  }
}

function outputUsername() {
  if (isset ($_SESSION["user_id"])) {
    echo "Logged in as: " . $_SESSION["user_username"];
  } else {
    echo "Visiting as: Guest User";
  }
}
