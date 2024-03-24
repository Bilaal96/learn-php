<?php

try {
  $dsn = "mysql:host=localhost;dbname=my_first_db";
  $dbUsername = "root";
  $dbPassword = "";

  $pdo = new PDO($dsn, $dbUsername, $dbPassword);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "DB Connection Failed: " . $e->getMessage();
}
