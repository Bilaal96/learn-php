<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  // User did not submit data via POST request
  header("Location: ./index.php");
  exit();
}

// User made POST request
$userSearch = $_POST["user-search"];

require_once 'includes/dbh.inc.php';

try {
  $query = "SELECT * FROM comments WHERE username = ?;";

  $stmt = $pdo->prepare($query);
  // $stmt->bindParam(":username", $userSearch);

  $stmt->execute([$userSearch]);

  /** Grab the data and store it in an array
   * $stmt->fetchAll() - Returns an array containing all of the result set rows
   * We use this in order manipulate and/or display the data in the browser
   * It takes an argument that controls the contents of the returned array
   * i.e. how it is formatted. Is it an associative array/object.
  
   * $stmt->fetchAll(PDO::FETCH_ASSOC) -> return results as associative array
   * $stmt->fetchAll(PDO::FETCH_OBJ) -> return results as an object
   
   * NOTE: there is also a fetch() method for getting a single piece of data 
   
   * NOTE: this variable is available within this file
   * So creating another script within our HTML body will allow us to access & output 
    the results
   */
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Query failed: " . $e->getMessage());
} finally {
  // echo "stmt: " . var_export($stmt, true) . "<br>";
  // echo "pdo: " . var_export($pdo, true) . "<br>";
  $stmt = null;
  $pdo = null;
  // echo "stmt: " . var_export($stmt, true) . "<br>";
  // echo "pdo: " . var_export($pdo, true) . "<br>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Search Comments By Username</title>
</head>

<body>
  <h3>Search Results</h3>

  <?php
  // Fetch failed
  /* if (!$results) {
    // Do something...
    // echo "Something went wrong";
  } */

  if (empty($results)) { // same as: count($results) === 0
    // No results found - $results = [] (empty array)
    echo "
      <div>
        <h4>Comments by $userSearch:</h4>
        <p>No comments found</p>
      </div>
    ";
  } else {
    // Results found
    echo "<div>";
    echo "<h4>Comments by $userSearch:</h4>";

    print('<pre> Results: ' . htmlspecialchars(var_export($results, true)) . '</pre><br>');

    /** Displaying fetched results
      
     $results format
     * NOTE: $results is a multidimensional array
     * Each element represents a record/row (in the 'comments' table) from the DB 
     * A record is an associative array (as we set PDO::FETCH_ASSOC), where:
      - we have key-value pairs
      - key = column_name in the DB
      - key (column_name) can be used to access the associated value

     Preventing XSS Attacks with htmlspecialchars()
     * Remember, because we're displaying fetched/user-generated data into our browser, 
      we need to:
        - sanitize the data that we output 
        - in order to prevent the injection of code into our script
     * htmlspecialchars() does this by:
      1. escaping special characters -i.e. converting special characters into 
       HTML entities
      2. ensuring that these special characters are displayed as text on the webpage 
       rather than being interpreted as HTML code
        - This prevents malicious users from injecting JavaScript or other harmful code into your webpage

     * Example of escaping special chars:
      - & becomes &amp;
      - < becomes &lt;
      - > becomes &gt;
      - " becomes &quot;
      - ' becomes &#039;

     * To demonstrate XSS attack I have posted a comment by username "John" containing JS code
     * If you output $record["comment_text"] without passing it to htmlspecialchars() you
      can observe how the JS code WILL execute - this is an XSS attack

     * Conversely, observe how htmlspecialchars($record["comment_text"]) outputs
      the JS code as a string in the browser -> as a result the code is not executable
     */
    echo "<ul>";
    foreach ($results as $record) {
      // Extract date from date-time string
      $createdAt = new DateTime(htmlspecialchars($record["created_at"]));
      $createdAtDate = $createdAt->format("Y-m-d");
      $commentText = strip_tags(htmlspecialchars($record["comment_text"]));

      echo "<li>" . $commentText . " | <em>" . $createdAtDate . "</em></li>";
    }
    echo "</ul>";
    echo "<div>";
  }

  /** NOTE: 
   * You can also close the php tag -> then output raw HTML
   * Then re-open the php tag
   * This is useful when you have a lot of HTML to output & you don't want to use echo
   */

  ?>
</body>

</html>