<?php

// If file was accessed without POST request redirect to home
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: ../index.php");
  exit();
}

$usersId = $_POST["users_id"];
$username = $_POST["username"];
$commentText = $_POST["comment_text"];

try {
  require_once './dbh.inc.php';

  $query = "INSERT INTO comments (users_id, username, comment_text)
            VALUES (:users_id, :username, :comment_text);
  ";

  // Prepared Statement
  $stmt = $pdo->prepare($query);

  $stmt->bindParam(":users_id", $usersId);
  $stmt->bindParam(":username", $username);
  $stmt->bindParam(":comment_text", $commentText);

  $stmt->execute();

  header("Location: ../index.php");
} catch (PDOException $e) {
  die("Query failed: " . $e->getMessage());
} finally {
  $stmt = null;
  $pdo = null;
}

die();