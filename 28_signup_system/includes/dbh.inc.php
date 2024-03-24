<?php

$host = "localhost";
$dbname = "my_first_db";
$dsn = "mysql:host=$host;dbname=$dbname;";
$dbUsername = "root";
$dbPassword = "";

try {
  $pdo = new PDO($dsn, $dbUsername, $dbPassword);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  // die() will terminate this script if something goes wrong
  die("Connection failed: " . $e->getMessage());
}
