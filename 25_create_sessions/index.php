<?php

/** What is a session?
 * A session is form of persistent storage that lives on the server (or stored in a DB)
 * For as long as a session exists, it will remember info (stored inside it) across 
  all pages of a website
 * When we create a session, a Session ID Cookie is created and stored in the browser
  - in Chrome you can view this in the DevTools > Application > Cookies

 * The session data/variables (stored on the server) is accessible granted that you 
  present the corresponding Session ID Cookie
 * The Session ID Cookie tells the server who you are (via your ID) and which session 
  variables you need to have assigned to you
 * This data can be stored in various locations depending on the server configuration. 
 * Common storage mechanisms include files, a database, or an in-memory cache like 
  Redis or Memcached

 In summary:
 * sessions exist on the server, where session data is stored and managed. 
 * The session ID, which is typically stored on the client-side, serves as a reference 
  to the session data stored on the server and allows the server to associate 
  subsequent requests from the same user with the correct session data.
 */

/**
 Start/resume a session in the CURRENT page (i.e. index.php)
 * When session_start() is called, the server sets a "Session ID Cookie" in the browser
 * This is commonly called: PHPSESSID
 * Many sessions exist on the server, so the ID stored in this cookie is used by the 
  server to track/pin-point which user is making requests

 * If you delete the PHPSESSID cookie from the browser, the server will no longer know
  who you are on subsequent requests
 * When you close the browser, it may automatically purge PHPSESSID (depending on how 
  it is configured) - this is the default behaviour for PHPSESSID
 * PHPSESSID's - When no value is set on the Expire property, it is configured so that
  the session expires when the browser closes. 
 * By setting an Expiry value, you can extend its lifetime so it lasts longer.
 * Session security is discussed later
  - e.g. preventing other users from hijacking a session
 
 * NOTE: You only need to call session_start() once per page load 
 * Subsequent calls to session_start() will resume the existing session if one exists
 
 * Ensure that there is no output (HTML, whitespace, or even error messages) before 
  calling session_start()
 * If there is any output before session_start(), PHP will emit a warning, and the 
  session may not start correctly
 */
session_start();


// Creating session data is as simple as assigning key-values to the $_SESSION superglobal
// NOTE: This data is available on any page after creating/resuming a session via session_start()
// All keys assigned to $_SESSION are known as Session Variables
$_SESSION["username"] = "Krossing";
$_SESSION["firstName"] = "Dani";
$_SESSION["hobbies"] = ["football", "gaming", "weight training"];
$_SESSION["dob"] = "29-07-1996";

/** NOTE: SEE example.php FOR EXAMPLES OF USING:

 * --- unset($_SESSION["varName"]) & session_unset() ---
 * Clear a specific session variable (i.e. remove its value)
 
 * ---  session_unset() ---
 * Clear values for ALL session variables (i.e. remove all of their values)
 
 * NOTE: if an undeclared / uninitialised / undefined / unset variable is used in an 
  expression, it will resolve to NULL
  
 * --- session_destroy() --- 
 * Clears the session from the server by removing its ID & all the associated session variables
 * To be clear this deletes the session completely on the server-side
 * The client-side Session Cookie is untouched, but since the Session is invalidated
  on the server, the ID in the Session Cookie will no longer be recognised

 * NOTE: You can't see the effect of session_destroy() until you access another page
 * i.e. after calling session_destroy() the session variables won't be reset in the 
  current page; you have to navigate to another page to observe its effect

 * session_destroy(); --> use to completely end a session 
 */
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Creating Sessions in PHP</title>
</head>

<body>
  <h1>Homepage</h1>

  <?php
  // Output values of Session Variables (defined in script above)
  echo "This session belongs to: <strong>" . $_SESSION["username"] . "</strong><br>";
  echo "Born on: " . $_SESSION["dob"];

  echo "<ul>";
  foreach ($_SESSION["hobbies"] as $hobby) {
    echo "<li>$hobby</li>";
  }
  echo "</ul>";

  ?>

  <a href="example.php">Example Page</a>
</body>

</html>