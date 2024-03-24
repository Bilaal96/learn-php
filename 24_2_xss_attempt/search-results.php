<?php
// Fetch comments related to a single user via their username
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: ./index.php");
  exit();
}

$username = $_POST["username"];

try {
  require_once './includes/dbh.inc.php';

  $query = "SELECT * FROM comments WHERE username = ?;";

  $stmt = $pdo->prepare($query);
  $stmt->execute([$username]);

  $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Query failed: " . $e->getMessage());
} finally {
  $stmt = null;
  $pdo = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Results: Comments by Username</title>
</head>

<body>
  <h2>Comments by <?php echo htmlspecialchars($username) ?>:</h2>

  <?php
  // NOTE: this is vulnerable to XSS attack - will execute code inserted as a text value in the DB
  // print("<pre>" . print_r($comments, true) . "</pre><br>");

  // Wrap the return value from print_r() in htmlspecialchars() to escape special chars
  // NOTE: this will not cause error
  // print("<pre>" . htmlspecialchars(print_r($comments, true)) . "</pre><br>");

  // * Be sure to sanitize any user-generated content before outputting it to the browser


  echo "<ul>";
  foreach ($comments as $comment) {
    // Extract date from date-time string
    $createdAt = new DateTime(htmlspecialchars($comment["created_at"]));
    $createdAtDate = $createdAt->format("Y-m-d");

    echo "<li>" . htmlspecialchars($comment["comment_text"]) . " | $createdAtDate </li>";
  }
  echo "</ul>";

  ?>

  <a href="index.php">Back to Home</a>
</body>

</html>