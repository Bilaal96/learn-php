<?php

/** First thing to do:
 * Check if the user accessed this particular file in the proper way
 * Because it's possible for the user to simply type the URL that points to this file,
   rather than actually submitting the form
 * NOTE: the fact that the above is possible is one of the reasons why we have 
   public/private folders - i.e. private files are inaccessible via the URL
 
 
 * Regardless if it's a private file, we should ALWAYS think about security and 
   validate the way the file was accessed
 * We can do this with a conditional like so:
 
  if ($_SERVER["REQUEST_METHOD"] == "POST") { // do stuff } 
 */

// Alternative method: not considered the best way though
// Set a name attribute on the submit button --> <button type="submit" name="submit">
// Then check if the $_POST superglobal contains a key of "submit"
// if(isset($_POST["submit"])) { // do stuff ... }

// echo $_SERVER["REQUEST_METHOD"]; // GET / POST etc.
// var_dump($_SERVER["REQUEST_METHOD"]); // GET / POST etc. & string length
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  /** NEVER TRUST USER-SUBMITTED DATA, ALWAYS SANITIZE IT
   * Pass the submitted data to the built-in function: htmlspecialchars()
   * This will convert the submitted data into HTML entities
   * e.g. following char conversions: "&" => "&amp;", "<" => "&lt;", ">" => "&gt;"
   * This prevents the user from injecting malicious code via the inputs
   * NOTE: there is also htmlentities(), but in most cases we use htmlspecialchars()
    
   * NOTE: 
   * <input> values are accessible via the "name" attribute
   * <select> values are accessible via the <option> "value" attribute
   */
  // Grabs the value submitted via <input name="firstName" ... >
  $firstName = htmlspecialchars($_POST["firstName"]);
  $lastName = htmlspecialchars($_POST["lastName"]);
  $fullName = $firstName . " " . $lastName;

  // Grabs the value submitted via <option value="favouritePet" ... >
  $favouritePet = htmlspecialchars($_POST["favouritePet"]);

  // NOTE: MANUALLY PREVENTING FORM SUBMISSION DUE TO INVALID DATA SUBMISSION
  // Validate the data in a conditional before accepting & proceeding with the submitted data
  // empty() function ensures that the variable it's passed holds a value
  if (empty($firstName) && empty($lastName) && empty($favouritePet)) {
    header("Location: ../index.php"); // Send user back to homepage
    exit(); // End script execution here
  }

  // Data has been validated, proceed.
  echo "This is the data that the user submitted: <br>";
  echo $fullName;
  echo "<br>";
  echo $favouritePet;

  // This page/file should not be visible/accessible to the user
  // It would be used to process the data in some way
  // e.g. pass it to a function, or store it in our DB
  // NOTE: So we should send the user back to the homepage using the header() function
  header("Location: ../index.php"); // "../" out 1 dir, then into "index.php"
} else {
  // User did not submit the data via a POST request
  // Send them back to the home page
  header("Location: ../index.php");
}

// NOTE: this file is a pure PHP file
// It is best practice NOT to include a closing PHP tag