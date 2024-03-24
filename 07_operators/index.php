<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Operators</title>
</head>

<body>
  <?php
  // String operators
  // Concatenation (.)
  // Concatenation Assignment (.=)
  $a = "Hello";
  $b = "World!";
  $c = $a . " " . $b;
  echo $c;
  echo "<br>";

  // Arithmetic operators
  echo 1 + 2; // 3
  echo "<br>";

  echo 1 % 2; // 1
  echo "<br>";
  echo 10 % 3; // 1
  echo "<br>";
  echo 10 ** 3; // 1000
  echo "<br>";

  // Operator Precedence
  // BODMAS / BIDMAS
  echo 1 + 2 * 4; // 1 + 8 = 9 
  echo "<br>";
  echo (1 + 2) * 4; // 3 * 4 = 12 
  echo "<br>";
  echo (1 + 2) * (4 - 2); // 3 * 2 = 6 
  echo "<br>";

  // Assignment operator (=)
  $a = 2; // assign 2 to the address at which $a points to
  // This
  $a = $a + 4; // 6
  echo $a . "<br>";

  $a = 2; // reset $a to 2

  // is equivalent to
  $a += 4; // 6
  echo $a . "<br>";

  // Combined operators (+=, -=, *=, /=)
  $b = 4;
  $b *= 2;
  echo $b . "<br>"; // 8

  $c = 4;
  $c /= 2;
  echo $c . "<br>"; // 8

  // Comparison operators
  /** Equality operator (==)
   * == checks to see if 2 variables/values have the same value
   
   * If types differ, == will attempt type conversion for one of the operands
   * In PHP this is known as Type Juggling
   * The conversions in PHP are less aggressive than in JS Type Coercion  
   
   * Use the same rule of thumb as JS, prefer Strict Equality checks (===) 
   * ...when checking if 2 values are the same 
   */
  $d = 2;
  $e = "2";
  // This is still true for 2 == "2"
  // Because of Type Juggling, before comparing the values the 
  // ...string will be converted to an int
  if ($d == $e) {
    echo "This statement is true!";
  } else {
    echo "This statement is false!";
  }
  echo "<br>";

  // Strict Equality (===)
  // Checks if the operands have both the same type & value
  if ($d === $e) {
    echo "This statement is true!";
  } else {
    echo "This statement is false!";
  }
  echo "<br>";

  // Not Equal (!=) -> checks values (applies Type Juggling)
  // NOTE: != can also be written as <> --> they're functionally the same
  // Not Strictly Equal (!==) -> checks type & value
  $d = 2;
  $e = "2";

  if ($d !== $e) {
    echo "This statement is true!";
  } else {
    echo "This statement is false!";
  }
  echo "<br>";


  // Other common comparison operators
  // < 
  // <=
  // >
  // >=

  /** Logical operators 
   * AND (&&) or just type "and"
   
   * OR (||) or just type "or" --> in condition with multiple checks, || will determine precedence
    This: $a == $b || $c == $d && $e == $f
    Is the same as: ($a == $b) || ($c == $d && $e == $f)
   * NOTE: we evaluate the expression from left to right
    - If the value left of || is true, the condition is resolved
    - However, if it's false, then the check will proceed to the condition to the right of ||
   
   * NOT (!)
   */
  $f = 2;
  $g = 6;
  if ($d == $e and $f == $g) { // false
    // if ($d == $e && $f != $g) { // true
    // if ($d == $e or $f == $g) { // true
    echo "This statement is true!";
  } else {
    echo "This statement is false!";
  }
  echo "<br>";

  /** Incrementing / Decrementing Operators 
   * Pre-increment (++$var) --> increments $var, then returns it
   * Post-increment ($var++) --> returns $var, then increments & stores value of $var
   
   * Pre-decrement (--$var) --> decrements $var, then returns it
   * Post-decrement ($var--) --> returns $var, then decrements & stores value of $var
   */
  $h = 1;
  echo ++$h . "<br>"; // 2
  echo --$h . "<br>"; // 1

  echo $h++ . "<br>"; // 1 --> echoes $h (1), then increments (2)
  echo $h . "<br>"; // 2
  echo $h-- . "<br>"; // 2 --> echoes $h (2), then decrements(1)
  echo $h . "<br>"; // 1

  ?>
</body>

</html>