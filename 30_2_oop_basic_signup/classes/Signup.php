<?php

// In order to query the DB, this class needs information from another class (Dbh)
// Specifically, Signup needs access to a PDO instance
// Signup can get access to this by extending the Dbh class
// This makes Signup a subclass of Dbh
class Signup extends Dbh {
  private $username;
  private $pwd;

  public function __construct($username, $pwd) {
    $this->username = $username;
    $this->pwd = $pwd;
  }

  /**
   * Issues may arise when you define a method on a subclass that shares the same name as a method in the parent class.
   * This is because PHP supports overriding methods 
   * A subclass may override the method of a parent class, if the function signatures match
   * A function signature (the identity of a function) is defined by => the parameters & return type
   
   * For example, Dbh has the connect() method
   * So let's say we define a connect() method in Signup (the subclass of Dbh)
   
   Signup::connect() INTENTIONALLY overrides Dbh::connect()
   * In Signup, if I want to override Dbh::connect, Signup::connect() must share the same function signature as Dbh::connect
    - i.e the same parameters & return type
   * Otherwise a Fatal Error occurs:
    - Method 'Signup::connect()' is not compatible with method 'Dbh::connect()'.intelephense(P1038)
   
   Signup::connect() SHOULD NOT override Dbh::connect()
   * If Signup::connect() is purposely distinct and separate from Dbh::connect, then when we call Dbh::connect we can do it like so:
    - Call subclass method (Signup::connect) - $this->connect() - where $this points to an instance of Signup
    - Call parent class method (Dbh::connect) inside the subclass - parent::connect() - where parent points to an instance of Dbh 
   */
  // private function connect() { } //! Causes a Fatal Error - as function signature does not match Dbh::connect


  // NOTE: Class behaviours are implemented as methods 
  // -- input validation -> check input values & accumulate errors (if any)
  // -- error handling -> return a view with error messages (if any)
  // -- on failed Signup, preserve user input -> return a view with valid user input
  // -- password hashing -> no errors & before storing user in DB 
  // -- insert user into DB
  // -- on Success, set URL query param to indicate success -> used to notify user

  // This function MUST be private due it's sensitive nature -> has access to DB
  private function insertUser() {
    $query = "INSERT INTO users (username, pwd)
              VALUES (:username, :pwd);
    ";

    try {
      // $pdo = $this->connect(); // accessible like so if Signup::connect() is not defined 
      $pdo = parent::connect(); // Safer way to access Dbh::connect(), in case Signup::connect() is defined later

      $stmt = $pdo->prepare($query);
      $stmt->bindParam(":username", $this->username);

      $hashedPwd = password_hash($this->pwd, PASSWORD_BCRYPT, ["cost" => 12]);

      $stmt->bindParam(":pwd", $hashedPwd);

      $stmt->execute();
    } catch (PDOException $e) {
      die("Query failed: " . $e->getMessage());
    }
  }

  // Validate inputs: not empty
  private function isEmptySubmit() {
    if (empty($this->username) || empty($this->pwd)) {
      return true;
    }
    return false;
  }

  // Handle signup error/success actions
  // NOTE: this method is public because we need to call it from an instance of Signup
  // This call is made in '../includes/signup.inc.php'
  public function signupUser() {
    // Error handlers
    // -- if input values are empty, do not proceed with signup
    if ($this->isEmptySubmit()) {
      header("Location: " . $_SERVER["DOCUMENT_ROOT"] . "/index.php");
      die();
    }

    // No errors, signup user
    $this->insertUser();
  }
}
