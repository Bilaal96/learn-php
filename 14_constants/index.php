<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Constants</title>
</head>

<body>
  <?php
  function newline() {
    echo "<br>";
  }

  // We can reassign values to regular variables 
  $name = "Daniel";
  echo $name;
  newline();
  $name = "Bob";
  echo $name;
  newline();
  newline();

  /** Constants - define("varName", <value>)
   * Variables whose value cannot be modified / reassigned
   * Prevents accidental changes to a variable that should not be changed
   * Attempts to change the value of a constant will result in an error message
   
   * It is conventional to define constants: in all caps
   * It is a good practice to define constants: at the top of your script
   * This makes them easily recognisable
   */
  define("PI", 3.14);
  // define("PI", 4.14); // * Uncomment to observe errors
  // Intelephense warns: 
  // ! Duplicate symbol declaration 'PI'
  // Warning in Browser:
  // ! Warning: Constant PI already defined

  // Access a constant by referencing the name
  // NOTE: there is no $ prefix for constants
  echo PI . "<br>";

  define("NAME", "Fred");
  echo NAME . "<br>";

  define("IS_ADMIN", true);
  echo var_export(IS_ADMIN) . "<br>";
  newline();

  /**      
   * Constants defined in the global scope are accessible within child-scopes
   * e.g. you can access a constant in a function without having to declare them as
    ...global variables
   * This makes sense because we don't have to worry about accidentally changing 
    ...their value
   */
  function test() {
    echo "Print from a function: <br>";
    echo "Constants are accessible inside a function without having to declare them as a global var<br>";
    echo PI . "<br>";
    echo NAME . "<br>";
    echo var_export(IS_ADMIN) . "<br>";
    echo "Exit function <br>";
  }
  test();
  newline();

  ?>
</body>

</html>