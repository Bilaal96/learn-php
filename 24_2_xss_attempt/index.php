<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>XSS Attempt</title>
</head>

<body>
  <!-- 
    Attempt to submit a comment for the given users (only if they exist) 
    - submit the comment with JS code - e.g. an alert()
    - then observe:
      - do prepared statements sanitize the JS code before inserting it into the DB
      - reading & displaying fetched results from the DB WITHOUT htmlspecialchars() 
      - reading & displaying fetched results from the DB WITH htmlspecialchars()
  -->

  <!-- Insert user comment into DB -->
  <h2>Upload user comment:</h2>
  <form action="includes/insert-comment.inc.php" method="POST">
    <label for="userId">User ID</label>
    <input id="userId" type="number" name="users_id" placeholder="User ID...">

    <label for="username">Username</label>
    <input id="username" type="text" name="username" placeholder="Username...">

    <label for="comment">Comment</label>
    <input id="comment" type="text" name="comment_text" placeholder="Comment...">

    <button>Post Comment</button>
  </form>

  <!-- Search for comments by username -->
  <h2>Get user comments:</h2>
  <form action="search-results.php" method="POST">
    <label for="username">Username</label>
    <input id="username" type="text" name="username" placeholder="Username...">

    <button>Fetch Comments</button>
  </form>
</body>

</html>