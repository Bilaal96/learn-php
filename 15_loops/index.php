<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loops</title>
</head>

<body>
  <?php
  function newline($newlineCount = 1) {
    for ($i = 0; $i < $newlineCount; $i++) {
      echo "<br>";
    }
  }

  /* -------------------------------- For Loop -------------------------------- */

  // Execute the loop as long as $i is less than 10
  for ($i = 0; $i < 10; $i++) {
    echo $i . "<br>";
  }
  newline();

  // Decrementing loop
  for ($i = 9; $i >= 0; $i--) {
    echo $i . "<br>";
  }
  newline();

  // Function that prints stairs made of ASCII characters
  function printStairs($surface = "*", $maxSteps = 7, $initStepLength = 1) {
    for ($step = 0; $step < $maxSteps; $step++) {

      for ($i = 0; $i < $initStepLength; $i++) {
        echo $surface;
      }

      $initStepLength++;
      echo "<br>";
    }
  }

  printStairs("*");
  newline();
  printStairs("_", 5);
  newline(2);

  /* ------------------------------- While Loop ------------------------------- */

  $n = 0;

  while ($n < 10) {
    echo $n;
    $n++;
  }
  newline();

  /* ------------------------------ Do-While Loop ----------------------------- */

  // ? A Do-While Loop will always execute AT LEAST once
  $m = 10;

  do {
    // * This is guaranteed to execute AT LEAST once
    echo $n;
    $n++;
  } while ($n < 10);
  // NOTE: The while-condition is checked AFTER the do-block executes
  newline(2);

  /* ------------------------------ For Each Loop ----------------------------- */

  $fruits = ["Apple", "Banana", "Orange"];

  // Iterate values of an array
  foreach ($fruits as $fruit) {
    echo "$fruit <br>";
  }
  newline();

  // Iterate keys & values of a regular array 
  foreach ($fruits as $index => $fruit) {
    echo "$index: $fruit <br>";
  }
  newline();

  // Iterate keys & values of an associative array 
  // -- Example 1
  $person = [
    "name" => "Ben",
    "age" => 28,
    "job" => "Designer",
  ];

  foreach ($person as $key => $value) {
    echo "$key: $value <br>";
  }
  newline();

  // -- Example 2
  $veggies = ["Cucumber" => "Green", "Onion" => "White", "Pepper" => "Red", "Sweetcorn" => "Yellow"];

  foreach ($veggies as $veggie => $color) {
    echo "$veggie has a color of: $color <br>";
  }
  ?>
</body>

</html>