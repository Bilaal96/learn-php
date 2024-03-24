<?php

// Define DSN (Data Source Name)
$dsn = "mysql:host=localhost;dbname=my_first_db";
$dbUsername = "root";
$dbPassword = "";

try {
  echo "Attempting to connect to DB <br>";
  // Attempt to connect to DB
  $pdo = new PDO($dsn, $dbUsername, $dbPassword);
  // If an error occurs, throw an exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connection to DB established <br>";
} catch (PDOException $e) {
  // Print error message
  echo "Connection failed: " . $e->getMessage();
}
