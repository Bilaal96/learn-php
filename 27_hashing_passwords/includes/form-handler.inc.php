<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $pwd = $_POST["password"];

  try {
    require_once './dbh.inc.php';

    $query = "INSERT INTO users (username, email, pwd)
              VALUES (:username, :email, :pwd)
    ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":pwd", $pwd);

    // NOTE: bindParam() will still allow you to modify $pwd after bound
    // This would not work with bindValue()
    $hashOptions = ["cost" => 12];
    $pwd = password_hash($pwd, PASSWORD_BCRYPT, $hashOptions);

    $stmt->execute();

    /** NOTE: you can also do this without using binding functions
     * Simply pass an array to execute()
      -- regular array if using positional parameters
      -- associative array if using named parameters 
     */
    /* $stmt = $pdo->prepare($query);

    $hashOptions = ["cost" => 12];
    $pwd = password_hash($pwd, PASSWORD_BCRYPT, $hashOptions);

    $stmt->execute([
      ":username" => $username,
      ":email" => $email,
      ":pwd" => $pwd,
    ]); */

    header("Location: ../index.php");
  } catch (PDOException $e) {
    die("Query failed: " .  $e->getMessage());
  } finally {
    $stmt = null;
    $pdo = null;
  }

  die();
} else {
  header("Location: ../index.php");
}
