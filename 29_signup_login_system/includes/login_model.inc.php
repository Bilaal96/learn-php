<?php

declare(strict_types=1);

function getUser(PDO $pdo, string $username) {
  $query = "SELECT * FROM users WHERE username = ?;";

  $stmt = $pdo->prepare($query);
  $stmt->execute([$username]);

  // NOTE: fetch() returns an assoc. array, if a user with $username exists
  // HOWEVER, if the user doesn't exist, it returns false 
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result;
}
