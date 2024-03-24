<?php

class Dbh {
  private $host = "localhost";
  private $dbName = "my_first_db";
  private $dbUsername = "root";
  private $dbPassword = "";

  /**
   * NOTE: here we've created a protected method, NOT public
   * This is because it contains sensitive information (our DB credentials & connection) 
   * A protected method is only accessible by the Class defines it and any Subclasses of that class 
   * It cannot be accessed outside of this class or any of its subclasses
   */
  protected function connect() {
    try {
      $dsn = "mysql:host=$this->host;dbname=$this->dbName;";
      $pdo = new PDO($dsn, $this->dbUsername, $this->dbPassword);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo; // return the instance of the PDO connection
    } catch (PDOException $e) {
      die("Connection failed: " . $e->getMessage());
    }
  }
}
