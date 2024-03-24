<?php
// This is the code we wrote in lesson 22 
// Here, it's only used for reference

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  try {
    require_once "./dbh.inc.php";

    $query = "INSERT INTO users (username, email, pwd)
              VALUES (:username, :email, :pwd);
    ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":pwd", $password);

    $stmt->execute();

    // Close connections to DB 
    $stmt = null;
    $pdo = null;

    header("Location: ../index.php");
    die();
  } catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
  }
} else {
  header("Location: ../index.php");
}
