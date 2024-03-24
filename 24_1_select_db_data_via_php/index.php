<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Selecting & Displaying Data from DB via PHP</title>
</head>

<body>
  <!-- 
    * NOTE: here, we're not using an includes file
    * We're going to another webpage: search.php
    * Submitting a username will return all comments associated with the given username
  -->
  <form class="search-form" action="search.php" method="POST">
    <label for="search">Search comments by username:</label>
    <input id="search" type="text" name="user-search" placeholder="Search...">
    <button>Search</button>
  </form>
</body>

</html>