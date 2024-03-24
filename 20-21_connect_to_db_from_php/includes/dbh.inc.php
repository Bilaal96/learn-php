<?php

/** DB connection methods
 *! (1) MySQL connection - bad, don't use it, has been made obsolete
 ** (2) MySQLi - good, improved, added SQL Injection prevention (MySQL only)
 ** (3) PDO (PHP Data Objects) - more flexible, compatibility with other DBs (e.g. SQLite)
 * NOTE: we're using method 3 - PDO

 Create a DSN (Data Source Name)
 * This tells our server:
  - what type of DB driver we're trying to use
  - what the name of the DB is
  - what is the host we're trying to connect to (i.e. localhost in our case)
 * NOTE: it's like a mongodb connection string
 */
$dsn = "mysql:host=localhost;dbname=my_first_db";

// This username/password combo is the XAMPP default 
$dbUsername = "root";
$dbPassword = "";
// On mac you may need to set the password to "root"
// Alternatively, lookup how to change the DB password

/** Attempt to make PDO connection 
 * PDO - built-in Class - used to create a PHP DB Object 
 * It represents a connection between PHP and a database server
 * Essentially, we use it to establish a connection to the DB
 */
try {
  $pdo = new PDO($dsn, $dbUsername, $dbPassword);

  // Configure how PDO should handle errors
  // Below, we specifically instruct it to throw an Exception
  // PDO::ATTR_ERRMODE & PDO::ERRMODE_EXCEPTION are constants of the PDO instance
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  // PDOException is the type/class of the error object thrown by the PDO instance
  // $e is the var name holding the PDOException object that was thrown

  // Print an error message to indicate failure to connect to DB
  echo "Connection failed: " . $e->getMessage();
}