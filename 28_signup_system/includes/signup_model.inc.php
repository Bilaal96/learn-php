<?php
// Handles querying data from / mutating data in DB
// Interacting with the DB is a sensitive operation
// The only thing that should interact with this file is the CONTROLLER file
// The Controller handles input from the user, then uses Models to interact with the DB as appropriate

// Enforce required Type Declarations
declare(strict_types=1);

// NOTE: here that we're not importing dbh.inc.php again
// It's already included in signup.inc.php
// So instead, we pass $pdo into the function as an argument
// This is known as dependency injection 
function getUsername(PDO $pdo, string $username) {
  $query = "SELECT username FROM users WHERE username = ?;";

  $stmt = $pdo->prepare($query);
  $stmt->execute([$username]);

  // NOTE: fetch() will return a single result (as opposed to fetchAll())
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result;
}

function getEmail(PDO $pdo, string $email) {
  $query = "SELECT email FROM users WHERE email = ?";

  $stmt = $pdo->prepare($query);
  $stmt->execute([$email]);

  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result;
}

function insertUser(PDO $pdo, string $username, string $email, string $pwd) {
  $query = "INSERT INTO users (username, email, pwd)
            VALUES (:username, :email, :pwd);
  ";

  $stmt = $pdo->prepare($query);
  $stmt->bindParam(":username", $username);
  $stmt->bindParam(":email", $email);

  // Hash the user password
  $options = ["cost" => 12]; // helps against Brute Force attacks
  $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

  $stmt->bindParam(":pwd", $hashedPwd);

  $stmt->execute();
}
