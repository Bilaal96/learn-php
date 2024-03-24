<?php
// This script demos insertion to the DB using Named Parameters
// Named parameters offer improved readability, especially when passing multiple params
// DB libraries may offer additional features built on top of named parameters

/**
 * Recreate the script in formhandler.inc.php using Named Parameters
 * 
 * [Recall & pseudo code steps here] 
 * 1) Check if the script was accessed through form submission via POST request
 * 2) For INVALID requests: send user back to homepage
 * 3) For VALID requests:
    - access submitted data via $_POST superglobal & store in variables
    - in try block:
      > include the PDO connection code via require_once
      > create a SQL query string to query the DB with - using named parameters
      > write a prepared statement - i.e. use $pdo to instantiate a Statement object
      > bind the named parameters to the Prepared Statement (i.e. statement object) 
      > execute the query
      > Success: (cleanup) close the statement & DB connection by setting the
        corresponding objects to null -> frees up resources ASAP
    - in catch block:
      > FAILED: handle the error thrown by PDO object -> by printing the error message
  
 * Questions:
  - what part of the DB interaction & data binding code will throw an error?
  - how is the query sent before binding data?
  - how does this prevent SQL injection? 
 */

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  try {
    // Include PDO connection code
    require_once "./dbh.inc.php";

    // SQL query to insert user into DB
    $query = "INSERT INTO users (username, email, pwd)
            VALUES (:username, :email, :pwd);
    ";

    /** Instantiate prepared statement
     * Returns a reusable SQL query into which different parameters can be bound
     * A prepared statement is a precompiled SQL query, in which PDO automatically 
      handles escaping & quoting of params/values to prevent SQL injection
     * NOTE: The idea here is to separate your SQL logic from the the data being 
      passed into the query
     */
    $stmt = $pdo->prepare($query);

    // Bind user input to named parameters - i.e. pass submitted data into the query
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":pwd", $password);

    // Execute the query
    $stmt->execute();

    // Redirect to home
    header("Location: ../index.php");

    // Close connections to DB 
    $stmt = null;
    $pdo = null;

    // End script execution with running connection(s)
    die();
  } catch (PDOException $e) {
    /** Places that could error 
     * 1. require_once & the PDO connection code
      - if the file specified to require_once could not be found 
      - if the connection could not be established
     * 2. Instantiation of PDO Prepared Statement - $pdo->prepare($query)
      - syntax errors/issues with the SQL query string passed to it
      - would throw a PDOException
     * 3. Errors in executing the prepared statement - $stmt->execute()
      - e.g. database constraints violation, insufficient permissions, etc.
     */
    // End script execution
    die("Query failed: " . $e->getMessage());
  }
} else {
  // Script accessed without POST request, redirect to home
  header("Location: ../index.php");
}
