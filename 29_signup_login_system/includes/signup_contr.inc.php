<?php

declare(strict_types=1);

function areInputsMissingValues(string ...$inputs) {
  // Return true as soon as an empty input is found
  foreach ($inputs as $input) {
    if (empty($input)) {
      return true;
    }
  }

  return false;
}


function isEmailInvalid(string $email) {
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return false; // valid email
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

function insertUser(PDO $pdo, string $username, string $email, string $pwd) {
  createUser($pdo, $username, $email, $pwd);
}
