<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Superglobals</title>
</head>

<body>
  <?php

  /** Overview of superglobals discussed
   1. $_SERVER
   2. $_GET
   3. $_POST
   4. $_REQUEST
   5. $_FILES
   6. $_COOKIE
   7. $_SESSION
   8. $_ENV
   9. $_GLOBAL - briefly mentioned, used to access global variables created by the dev
   */

  /** Superglobals: Predefined Variables
   * Vars built into the language & are available in the global scope
   * i.e. they're accessible from anywhere in our code, regardless of the current scope
  
   $_SERVER
   * NOTE: superglobals / global variables are prefixed with underscore
   
   $_SERVER["DOCUMENT_ROOT"]
   * Gives info on root path where the project is stored
   
   $_SERVER["PHP_SELF"]
   * Gives path to the current filename, relative to DOCUMENT_ROOT
    
   $_SERVER["SERVER_NAME"]
   * Gives the name of the server from which the webpage is hosted/served
   
   $_SERVER["REQUEST_METHOD"]
   * Gives you the HTTP Method by which the current webpage was accessed/served
   * One of: GET / POST / PUT / PATCH / DELETE etc. 
   */

  function lineBreak()
  {
    echo "<br>";
  }

  // NOTE: string concatenation is done with period
  echo $_SERVER["DOCUMENT_ROOT"] . "<br>"; // C:/xampp/htdocs
  echo $_SERVER["PHP_SELF"]; // /php-dani-krossing/03_superglobals/index.php
  lineBreak();
  echo $_SERVER["SERVER_NAME"]; // localhost - live site would give name of live server
  lineBreak();
  echo $_SERVER["REQUEST_METHOD"]; // one of: GET / POST / PUT / PATCH / DELETE etc.
  lineBreak();

  /** $_GET
   * Allows you to access values passed via query strings
   * Is an associative array - where each element is a key-value pair
   
   $_GET["name"]
   * If the query string was ?name=bilaal
   * echo $_GET["name"]; // returns the value of name: bilaal
   * NOTE: query strings are represented via an associative array
   * [ [ "name", "bilaal" ], [ "age", "27" ] ]
   */

  // NOTE: print_r: logs human readable info on a variable
  print_r($_GET); // (Associative) Array ( [name] => bilaal [age] => 27 )

  // Append ?name=bilaal&age=27 to URL & observe the output of the lines below
  lineBreak();
  echo $_GET["name"]; // bilaal
  lineBreak();
  echo $_GET["age"]; // bilaal
  lineBreak();

  /** $_POST
   * Allows you to access data submitted (or sent to the server) via the POST method/request
   * NOTE: remember, sensitive data is best accessed via POST, rather than via GET & query strings
   */

  /** $_REQUEST 
   * Looks for the given key within GET / POST / COOKIE & retrieves the value
   * It's better to be more specific & use $_GET, $_POST etc.
   * Then you know exactly what you're getting & where it came from
   */
  echo $_REQUEST["name"]; // bilaal -> when query string contains: ?name=bilaal
  lineBreak();

  /** $_FILES
   * Allows you to retrieve data on a file that was uploaded to your server via an HTML Form
   * When a user does this, we need to validate the file by checking it's data/metadata
   * This can be done using the $_FILES Super-global
    - e.g. check that the file is not too large
    - e.g. check the file type via its extension
    - e.g. check the name of the file
   */

  /** $_COOKIE
   * Allows us to store data in or retrieve data from a cookie  
   * NOTE: A cookie is a small file that the server embeds on the computer, used to store data locally
   */

  /** $_SESSION
   * Allows us to store data in or retrieve data from a session
   * NOTE: A session stores the temporary state for the current users active session
   * If a session is closed/ended, the browser will forget about the values stored in it
   * ...unless the values are set again under the same session name
   */
  // CREATE session variable called "username"  
  $_SESSION["username"] = "Kroos";
  // ACCESS session variable called "username"  
  echo $_SESSION["username"];
  lineBreak();

  /** $_ENV
   * Stores environment variables, which contain very sensitive data that is only accessible
   * in the env in which they're defined/scoped to
   */
  ?>

</body>

</html>