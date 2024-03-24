<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/main.css">

  <title>Calculator</title>
</head>

<body>
  <!-- Functionality
    * Basic arithmetic
    * Combine different operators in a calculation
    * Clear calculation
  -->
  <main>
    <!-- 
      * The specified action keeps us on the same page 
      * It also prevents code injection by sanitising input via htmlspecialchars()
    -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <input type="number" name="num01" placeholder="Operand 1">
      <select name="operator" id="operator">
        <option value="add">+</option>
        <option value="subtract">-</option>
        <option value="multiply">*</option>
        <option value="divide">/</option>
      </select>
      <input type="number" name="num02" placeholder="Operand 2">
      <button type="submit">Calculate</button>
    </form>


    <?php
    // Check if form was submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // Grab data from inputs
      // Sanitise the input (submitted via the POST method) with the given name attribute 
      // by preventing floats
      $num01 = filter_input(INPUT_POST, "num01", FILTER_SANITIZE_NUMBER_FLOAT);
      $num02 = filter_input(INPUT_POST, "num02", FILTER_SANITIZE_NUMBER_FLOAT);

      // In PHP FILTER_SANITIZE_STRING is deprecated
      // It is recommended to use htmlspecialchars() instead of filter_input
      $operator = htmlspecialchars($_POST["operator"]);
      $operatorsMap = [
        "add" => '+',
        "subtract" => '-',
        "multiply" => '*',
        "divide" => '/',
      ];

      // Error handlers -- prevent users from doing impermissible actions
      // e.g. submitting the form without entering the required inputs
      $hasErrors = false;

      // Check that inputs have a value
      if (empty($num01) || empty($num02) || empty($operator)) {
        echo '<p class="calc-error">Fill in all fields!</p>';
        $hasErrors = true;
      }

      // Check that numeric inputs only contain numbers
      if (!is_numeric($num01) || !is_numeric($num02)) {
        echo '<p class="calc-error">Only type in numbers!</p>';
        $hasErrors = true;
      }

      // Calculate the numbers if no errors
      if (!$hasErrors) {
        $value = 0;

        switch ($operator) {
          case "add":
            $value = $num01 + $num02;
            break;
          case "subtract":
            $value = $num01 - $num02;
            break;
          case "multiply":
            $value = $num01 * $num02;
            break;
          case "divide":
            $value = $num01 / $num02;
            break;
          default:
            // INVALID OPERATOR
            echo '<p class="calc-error">Something went horribly wrong!</p>';
        }

        echo '<p class="calc-result">' . $num01 . ' ' . $operatorsMap[$operator] . ' ' . $num02 . ' = ' . $value . "</p>";
      }
    }
    ?>
  </main>
</body>

</html>