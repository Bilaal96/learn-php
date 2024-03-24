<?php

declare(strict_types=1);

function getUsername(PDO $pdo, string $username) {
  $query = "SELECT username FROM users WHERE username = ?;";

  $stmt = $pdo->prepare($query);
  $stmt->execute([$username]);

  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result;
}

function getEmail(PDO $pdo, string $email) {
  $query = "SELECT email FROM users WHERE email = ?;";

  $stmt = $pdo->prepare($query);
  $stmt->execute([$email]);

  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result;
}

function createUser(PDO $pdo, string $username, string $email, string $pwd) {
  $query = "INSERT INTO users (username, email, pwd)
            VALUES (:username, :email, :pwd);
  ";

  $stmt = $pdo->prepare($query);

  // Hash user password
  $options = ["cost" => 12];
  $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

  $stmt->execute([
    ":username" => $username,
    ":email" => $email,
    ":pwd" => $hashedPwd,
  ]);
}
