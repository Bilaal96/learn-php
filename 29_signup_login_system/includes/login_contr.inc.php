<?php

declare(strict_types=1);

// ? This is what's provided in the tutorial
// - it is more specific to login compared to the above function
function areInputsEmpty(string $username, string $pwd) {
  if (empty($username) || empty($pwd)) {
    return true;
  }

  return false;
}

// ? This is a more generic/reusable function I wrote
function areInputsMissingValues(string ...$inputs) {
  // Return true as soon as an empty input is found
  foreach ($inputs as $input) {
    if (empty($input)) {
      return true;
    }
  }

  return false;
}


function userExists(array|false $queryResult) {
  if ($queryResult) {
    return true;
  }

  // No user with username found
  return false;
}

function isPasswordIncorrect(string $pwd, string $hashedPwd) {
  if (!password_verify($pwd, $hashedPwd)) {
    // Passwords don't match
    return true;
  }

  return false;
}