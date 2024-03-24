<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Handling</title>
  <link rel="stylesheet" href="css/main.css">
</head>

<body>
  <main>
    <!-- NOTE: 
      * The action specifies where the submitted data is sent to
      * In this case it's POSTed to another .php file
      * Within "includes/formhandler.php", we can access the data using the $_POST 
        superglobal
      * Whenever you're allowing the user to submit data, use POST method 
    -->
    <!-- NOTE: if you want to POST the data to the same page on which it is submitted,
      set the action to:
        * action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST"
        * ALTHOUGH this is prone to XSS attacks
    -->
    <!-- NOTE: 
      * In most cases you'll be submitting the data to another page 
      * Whenever we submit to another page/php file, for security reasons those pages
        should be kept in a private directory/folder
      * However, everything is currently public, and that is okay for practising purposes
    -->
    <form action="includes/formhandler.php" method="POST">
      <label for="firstName">First Name?</label>
      <input id="firstName" type="text" name="firstName" placeholder="First Name...">

      <label for="lastname">Last Name?</label>
      <input id="lastName" type="text" name="lastName" placeholder="Last Name...">

      <label for="favouritePet">Favourite Pet?</label>
      <select id="favouritePet" name="favouritePet">
        <option value="none">None</option>
        <option value="dog">Dog</option>
        <option value="cat">Cat</option>
        <option value="bird">Bird</option>

      </select>

      <button type="submit">Submit</button>
    </form>
  </main>
</body>

</html>