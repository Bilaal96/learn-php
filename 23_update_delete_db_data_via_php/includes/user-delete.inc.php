<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  try {
    require_once "./dbh.inc.php";

    /**
     * NOTE: usually, when a user is logged into your app, they're data is retrieved
      from the DB & stored in a session - commonly the data stored is their ID
     * So we wouldn't manually type an ID into the query like we have done below
     * Instead we'd use the ID from the user session
     * But this will work for demo purposes
     */
    $query = "DELETE FROM users
              WHERE username = :username AND pwd = :pwd;
    ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
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
