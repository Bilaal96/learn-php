<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Built-in Functions</title>
</head>

<body>
  <?php

  function newline() {
    echo "<br>";
  }

  echo "----- Useful String Functions ----- <br>";

  /** Useful String Functions 
   * strlen() - Get string length
   * strpos() - Find the position of the first occurrence of a substring in a string
   
   Substring functions
   * str_replace() - Replace all occurrences of the search string with the replacement string
   * strtolower() - Make a string lowercase
   * strtoupper() - Make a string uppercase
   * substr() - Return part of a string or false on failure. 
    - NOTE: For PHP8.0+ only string is returned
   * explode() - Split a string by another non-empty string
   */
  $greeting = "Hello World!";

  echo "Length of '$greeting': " .  strlen($greeting) . "<br>";
  newline();

  echo "Substring 'ello' appears at index: " . strpos($greeting, "ello") . "<br>"; // returns index of: 1
  echo "Substring 'or' appears at index: " . strpos($greeting, "or") . "<br>"; // returns index of: 7
  echo "Substring '!' appears at index: " . strpos($greeting, "!") . "<br>"; // returns index of: 11
  newline();

  /** str_replace()
   * 1st arg: The string to search for within the subject
   * 2nd arg: The string to replace the search string with
   * 3rd arg: The subject - i.e. the string to perform the search & replace on
   */
  echo str_replace("Hello", "Goodbye", $greeting) . "<br>"; // Goodbye World!
  newline();

  // strtolower() & strtoupper()
  echo strtolower($greeting) . "<br>";
  echo strtoupper($greeting) . "<br>";
  newline();

  /** substr()
   * 1st arg: the subject (i.e. the string to extract a substring from)
   * 2nd arg: the index position to start extraction of a substring
    - if negative: 
      > counts from end of string
      > -1 starts at last char
      > is inclusive
   * 3rd arg (optional): integer representing the number of characters to extract 
    ...from & including the starting position
    - if included: will stop extraction x chars from the starting index (inclusive)
    - if excluded: will stop extraction at the end of the string
    - if negative: (e.g. -n) omits n chars from the end of the string. So -4 would omit the last 4 chars.
   */
  echo substr($greeting, 5) . "<br>"; // "World!"
  echo substr($greeting, 5, 6) . "<br>"; // "World"
  echo substr("top-secret-password", 4, 6) . "<br>"; // "secret"
  echo substr("top-secret-password", 11, -4) . "<br>"; // "pass"
  echo substr("top-secret-password", -4) . "<br>"; // "word"
  newline();

  /** explode()
   * When you pass 2 args -> works similar to String.split() in JS, with the
    ... EXCEPTION that you cannot pass an empty string
    
   * Splits a string at every occurrence of the specified separator
   * Returns an array of the split strings (excluding the separator string)
   */
  echo 'explode(" ", "$greeting"): ' . print_r(explode(" ", $greeting), true) . "<br>";
  newline();

  /* -------------------------------------------------------------------------- */

  echo "----- Useful Math Functions ----- <br>";

  /** Useful Math Functions
   * abs() - returns the absolute value of a number
    - i.e. the non-negative form of a given number
    - or the unsigned number - disregarding +/-
  
   * round() 
    - rounds a float UP if decimal place is >= 5
    - rounds a float DOWN if decimal place is <= 4

   * pow() - raises a number (1st arg) to an exponent (2nd arg)
   * rand() - returns a random number between 2 numbers (i.e. a given range)
   */

  echo abs(-5.5) . "<br>"; // 5.5
  newline();

  echo round(6.3) . "<br>"; // rounds down to 6
  echo round(6.5) . "<br>"; // rounds up to 7
  newline();

  echo pow(10, 3) . "<br>"; // 10 * 10 * 10 = 1000
  echo pow(5, 3) . "<br>"; // 5 * 5 * 5 = 125
  echo pow(2, 4) . "<br>"; // 2 * 2 * 2 * 2 = 16
  newline();

  echo sqrt(25) . "<br>"; // 5
  echo sqrt(81) . "<br>"; // 9
  echo sqrt(49) . "<br>"; // 7
  newline();


  // Has been used during development to bypass the browser cache 
  // Useful to reload images (e.g. on save) during development of a website 
  echo rand(1, 100) . "<br>";
  newline();

  /* -------------------------------------------------------------------------- */

  echo "----- Useful Array Functions ----- <br>";

  /** Useful Array Functions 
   * count() - return length of array / number of elements in an array
   * is_array() - returns boolean indicating if the value passed is an array or not
   * array_push() - append to an array
   * array_pop() - remove last element from an array
   * array_reverse() - reverse elements of an array
   * array_splice() - remove and/or insert elements at specific indexes of an array
   * array_merge() - concatenates any number of arrays passed as arguments
   */

  $fruits = ["Apple", "Banana", "Cherry"];

  // NOTE: Useful to check if results were returned from a database query 
  echo count($fruits) . "<br>";
  newline();

  // NOTE: you must explicitly convert a boolean value to a string to echo it
  echo var_export(is_array($fruits), true) . "<br>"; // true
  echo var_export(is_array("Not an array"), true) . "<br>"; // false
  newline();

  array_push($fruits, "Kiwi"); // returns new length of array
  echo print_r($fruits, true) . "<br>";
  // Array ( [0] => Apple [1] => Banana [2] => Cherry [3] => Kiwi )
  newline();

  $popped = array_pop($fruits); // returns removed element
  echo $popped . "<br>"; // Kiwi
  echo print_r($fruits, true) . "<br>";
  // Array ( [0] => Apple [1] => Banana [2] => Cherry )
  newline();

  $reversedFruits = array_reverse($fruits);
  echo print_r($reversedFruits, true) . "<br>";
  // Array ( [0] => Cherry [1] => Banana [2] => Apple )
  newline();

  $fruits2 = ["Mango", "Pomegranate", "Watermelon"];
  $fruits3 = ["Orange", "Kiwi", "Pear"];
  $merged = array_merge($fruits, $fruits2, $fruits3);
  echo print_r($merged, true) . "<br>";
  newline();
  /* Array ( 
      [0] => Apple [1] => Banana [2] => Cherry 
      [3] => Mango [4] => Pomegranate [5] => Watermelon 
      [6] => Orange [7] => Kiwi [8] => Pear 
   ) */

  /* -------------------------------------------------------------------------- */

  echo "----- Useful DateTime Functions ----- <br>";


  /** Useful DateTime Functions 
   * NOTE: useful when working with data from DB
    - e.g. calculating date/time at which a resource was created/updated

   * date() - Format a local time/date 
    - i.e. return a date in the format specified by the arguments passed

   * time() - returns unix timestamp in milliseconds
   
   * strtotime() - Parse about any English textual datetime description into a Unix timestamp
   */

  date_default_timezone_set("Europe/London"); // Account for daylight saving

  echo date("Y-m-d H:i:s") . "<br>"; // 2024-02-23 16:05:10
  echo date("d-m-y H:i") . "<br>"; // 23-02-24 16:05
  echo date("d-m-y") . "<br>"; // 23-02-24
  echo time() . "<br>"; // Unix Timestamp of current moment in time - milliseconds passed since 1st Jan 1970 00:00

  // Get a unix timestamp from a date string
  $date = "2024-02-23 16:05:10";
  echo strtoTime($date); // 1708704310 - milliseconds - fixed value in time
  newline();

  ?>
</body>

</html>