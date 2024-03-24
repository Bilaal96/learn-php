<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Variables & Data Types</title>
</head>

<body>
  <!-- NOTE: we can nest php tags within html to output values dynamically -->
  <p>This is a <?php echo "awesome"; ?> paragraph</p>

  <?php echo "<p>This is also a paragraph</p>"; ?>

  <?php
  /** Variable Naming conventions 
   * Vars are prefixed with "?"
   * Var names in PHP are commonly: camelCased or snake_cased
   * They must start with a lowercase letter or underscore (the latter is reserved for specific cases)
   * After which, they may contain numbers
   */
  $name = "Dani Krossing";
  echo $name;

  /** Basic Data types 
   * PHP is a dynamically types language - meaning we don't have to explicitly specify the type of a variable.
   * The var data type is implied/inferred from the value assigned to it.
   
   Classification of data types
   * Scalar types: contains one value
    - string - chain of text characters
    - int
    - float
    - bool (boolean) - true or false
   */
  $msg = "Hello world"; // string
  $count = 1; // int
  $money = 0.01; // float
  $on = true; // true
  $off =  false; // false
  $toggle = true || false; // bool

  /** Type Coercion
   * DOCS: https://www.php.net/manual/en/language.types.type-juggling.php
   
   In context of a conditional 
   * 1 is coerced to true 
   * 0 is coerced to false 
   */

  /** Arrays & Objects
   Array Type: contains multiple values
   
   Ways to create an array
   * $strNums = array("one", "two", "three");
   * $strNums2 = [ "one", "two", "three" ]; // doesn't work from PHP v5.4 & lower
   
   Object Type: a template from which we can create instances
   * $obj = new Car();
   */

  // unset variable - one that is declared but not initialised (i.e. it has no value)
  $names;
  // echo $names; // returns Undefined by default --> will display warning

  /** Default values based on var type
   * As a good practice we should always initialise variables
   * Default values provide context on what the var will be used for
   * Also, without initialising vars, we risk getting warning/error messages in our code 
   */
  $str = "";
  $int = 0;
  $float = 0;
  $bool = false;
  $array = []; // empty list
  $object = null; // null denotes absence of a value - i.e. nothing
  ?>

  <!-- Quick Example -->
  <?php
  $name = "Bilaal";
  $test = $name;
  ?>
  <!-- NOTE: you must echo the variable to output its value -->
  <p>Hi my name is <?php echo $test ?>, and I'm learning PHP</p>
</body>

</html>