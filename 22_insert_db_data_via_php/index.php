<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="reset.css">
  <link rel="stylesheet" href="main.css">

  <title>Insert Data into DB via PHP</title>
</head>

<body>
  <?php
  /** Objective: use Prepared Statements to securely insert data into DB
   *
   What are Prepared Statements?
   * They prevent SQL Injection (e.g. through form inputs)
   * We create a prepared statement which escapes/quotes characters in the query string
    & use placeholders where we want insert data - this is known as parameterization.
   * Then we bind the data (submitted by the user) to the sql query string in place of
    the placeholders

   How do they prevent SQL Injection?
   * This separates the SQL logic from the user-submitted data
   * Thus allowing the data to be passed in as a value and not a part of the query language
   * As a result, attempts of injecting SQL will not impact the SQL written in our PHP code 
   */
  ?>

  <h3>Signup</h3>
  <form action="includes/formhandler-named-param.inc.php" method="POST">
    <input type="text" name="username" placeholder="Username">
    <input type="text" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <button>Sign Up</button>
  </form>
</body>

</html>