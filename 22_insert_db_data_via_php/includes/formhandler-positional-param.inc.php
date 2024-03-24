<?php

// (A) Check to see user made form submission to access the script
// NOTE: without this check, a user could run this script by typing the 
// ...path to the script file in the URL
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  /**
   *  NOTE: we're not sanitising the input with htmlspecialchars() 
   * This is used to prevent XSS attacks, reserved for:
    - outputting data from user input IN THE BROWSER
    - outputting dynamic content from any source (e.g. a DB) IN THE BROWSER
   * For example:
    - data from a form submission
    - DB Queries
    - any source where user-generated content can be injected into your
      HTML OUTPUT

   * Ultimately, when storing data we don't necessarily want it to be HTML encoded
   
   * Instead, to prevent SQL injection, we can use prepared statements & bound/named 
    parameters
   */
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  try {
    /** include / include_once VS require / require_once Statements
     * For each of these statements we must specify a path to a file 
      - The path may be relative or absolute
      - The file may contain text/code/markup
     * When a file is included (or required), its contents is copied into the file 
      using the include statement
      
     * include - gives a WARNING if the specified file cannot be found
     * include_once - same as above, but gives a WARNING if the same file was 
      included earlier in the script

     * require - throws an ERROR (instead of giving a WARNING) if the specified 
      file cannot be found
     * require_once - same as above, but throws an ERROR if the same file was 
      required earlier in the script
     
     * All reference an external php file and include the script
     * The key difference is that 'include' will give a WARNING
     * Whereas 'require' will throw an ERROR
     * And *_once variations will ensure that the external script was not 
      referenced earlier     * 
    
     * NOTE: TL;DR
     * Below, require_once is used to include the script that
      - instantiates PDO, and gives us access to the instance
      - establishes a DB connection 
     * Think of it as copying & pasting the code from the specified file into this
      script
     * If the script was included in preceding code, require_once will throw an 
      error which is handled in the catch-block
     */
    require_once "dbh.inc.php"; // NOTE: this string path is relative to where you are currently

    /** Create a SQL Query String to insert a USER into the DB via the 'users' table
     
     * NOTE: it's possible to embed the user input variables directly in the query:
     
      $query = "INSERT INTO users (username, email, pwd)
                VALUES ($username, $email, $password);
      ";

     * However this is a terrible practice as it creates code vulnerable 
      to SQL Injection
     * Since the input is not sanitised, a user could execute SQL queries
      of their own in our DB with malicious intent
     * e.g. they could DROP TABLE or DROP DATABASE which would be a catastrophe for
      our users / application / business / company

     1. Prepare the SQL statement with placeholders
     * The alternative and more secure methods include:
      - bound parameters (? --> placeholder) method
        + prepared statement
        + $stmt->execute([$username, $email, $password, ...]);
      - named parameters (:paramName - e.g. :username, :email, etc.) method 
        + prepared statement
        + $stmt->bindParam(":nameParameter", $postedData);
        + $stmt->execute();
     */
    $query = "INSERT INTO users (username, email, pwd)
              VALUES (?, ?, ?);
    ";

    /** Submit SQL query with a Prepared Statement
     
     2. Initialise a Prepared Statement
     * $pdo->prepare() method - Prepares a SQL statement for execution and returns a statement object
     * NOTE: we can directly access $pdo thanks to our require_once statement (see above) 
     
     * A prepared statement is a precompiled SQL statement that can be executed 
      repeatedly with different parameters; they help prevent SQL injection attacks 
      and improves performance
     * This separation of the SQL query structure from the data being supplied to it 
      helps prevent SQL injection attacks, as the database engine treats the parameter
      values as data rather than executable SQL code

     How this prevents SQL Injection:
     * the values are automatically escaped and quoted by PDO when you use prepared 
     statements and bound/named parameters.
     */
    $stmt = $pdo->prepare($query); // $stmt is a common abbr. for a prepared statement 

    /** 3. Bind parameters to the Prepared Statement & execute the query/statement
     * Passes data into the the placeholders within the Prepared Statement
     * NOTE: the order of the values should match the order in which the column names
      are specified in the query
     */
    $stmt->execute([$username, $email, $password]);

    /** 4. Manually close the statement and the connection to the DB
     * Is not required as this will happen automatically
     * However, it is considered a best practice to free up resources ASAP 
     */
    $stmt = null;
    $pdo = null;

    // 5. Redirect user to homepage
    header("Location: ../index.php");

    /** 6. Semantics / Rule of Thumb for when to use exit() vs die()
     * If closing off a script WITHOUT any connections running use --> exit()
     * If closing off a script WITH a connection running use --> die() 
     */
    die();
  } catch (PDOException $e) {
    // 7. Handle exception 
    // die() is equivalent to exit() -> Output a message and terminate the current script
    die("Query failed: " . $e->getMessage());
  }
} else {
  // (B) Script accessed in unintended way, redirect user back to homepage
  header("Location: ../index.php");
}
