<?php
// ? HOW TO ENABLE STRICT TYPING
declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User-defined Functions</title>
</head>

<body>
  <?php
  // function names can either be camelCased or snake_cased
  function newline() {
    echo "<br>";
  }

  // $name has a default value which is used when no arg is passed
  function sayDefaultHello($name = "World") {
    return "Hello $name!";
  }

  // NOTE: because sayHello returns a string, we have to echo to output it
  echo sayDefaultHello();
  newline();

  /* -------------------------------------------------------------------------- */

  // NOTE: GO TO TOP OF FILE TO SEE HOW TO ENABLE STRICT TYPING

  function sayTypedHello(string $name) {
    return "Hello $name";
  }

  // ? THIS WILL NOT WORK
  // echo sayTypedHello(123); 
  // ! Passing an int where a string was expected
  // ! Expected type 'string'. Found 'int'. (from PHP Intelephense extension)

  // Since PHP 7.1, type hinting can be used for a nullable parameter 
  function sayNullableHello(?string $name = null) {
    return $name ? "Hello $name!" : "Hello World!";
  }

  $greeting = sayNullableHello("Daniel");
  echo $greeting;
  newline();
  newline();

  /* -------------------------------------------------------------------------- */

  // Calculator example
  function calculator(int|float $num1, int|float $num2, string $operator = "+"): int|float {
    $result = match ($operator) {
      "+" => $num1 + $num2,
      "-" => $num1 - $num2,
      "*" => $num1 * $num2,
      "/" => $num1 / $num2,
    };

    return $result;
  }

  echo calculator(5, 10) . "<br>"; // 5 + 10 = 15
  echo calculator(5, 10, "-") . "<br>"; // 5 - 10 = -5
  echo calculator(5, 10, "*") . "<br>"; // 5 * 10 = 50
  echo calculator(5, 10, "/") . "<br>"; // 5 / 10 = 0.5
  newline();

  echo calculator(-2.5, 1.25, "+") . "<br>"; // -1.25
  echo calculator(2.5, 1.25, "-") . "<br>"; // 1.25
  echo calculator(2.5, 1.25, "*") . "<br>"; // 3.125
  echo calculator(2.5, 1.25, "/") . "<br>"; // 2

  ?>
</body>

</html>