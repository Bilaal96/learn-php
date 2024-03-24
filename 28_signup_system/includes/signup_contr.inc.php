<?php

// Allow Type Declarations
declare(strict_types=1);

// Check if user entered values for ALL sign-up inputs
function isInputEmpty(string $username, string $email, string $pwd) {
  if (empty($username) || empty($email) || empty($pwd)) {
    return true;
  }

  return false;
}


// Check if email is given in an invalid format
function isEmailInvalid(string $email) {
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return false;
  }

  return true;
}

function isUsernameTaken(PDO $pdo, string $username) {
  if (getUsername($pdo, $username)) {
    return true;
  }

  return false;
}

function isEmailRegistered(PDO $pdo, string $email) {
  if (getEmail($pdo, $email)) {
    return true;
  }

  return false;
}

function createUser(PDO $pdo, string $username, string $email, string $pwd) {
  insertUser($pdo, $username, $email, $pwd);
}
