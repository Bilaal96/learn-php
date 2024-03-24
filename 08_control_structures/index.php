<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Control Structures</title>
</head>

<body>
  <?php
  /** Examples of Control Structures in PHP
   * If Statements
   * Switch Statements
   * Match Expression (PHP 8)
   * Includes statement (import files/modules)
   * Loops
   
   * NOTE: Here, we'll focus on the first 3
   */

  // If Statements

  $bool = false;
  $a = 1;
  $b = 4;
  if ($a < $b && $bool) {
    echo "TRUE!";
  } else {
    echo "FALSE!";
  }
  echo "<br>";

  // More concisely - useful for short conditional logic
  // NOTE: "elseif" & "else if" are both valid
  if ($a < $b && $bool) echo "TRUE!";
  else if ($a < $b && !$bool) echo "\$bool is FALSE!"; // NOTE: we must escape $ sign
  else echo "FALSE!";
  echo "<br>";

  /** Switch Statement
   * Used to compare a constant - i.e. the value evaluated by switch(constant)
   * ...then compare the constant to multiple possible outcomes (cases)
   * ...and act according to the outcome (logic executed for a specific case) 
   
   * if-statements can check multiple different conditions
   * switch-statements check multiple conditions in relation to a single expression/constant 
   
   * NOTE: the switch-statement checks for loose equality (same as ==)
    - i.e. it does NOT check the type
   */
  $c = 1; // our constant
  switch ($c) {
    case "1": // is $c == 1? 
      echo "The first case is corrected!";
      break; // exit switch
    case 3: // is $c == 3? 
      echo "The second case is correct!";
      break;
    default:
      echo "None of the conditions were true";
  }
  echo "<br>";

  /** Match Expression 
   * DOCS: https://www.php.net/manual/en/control-structures.match.php
   * NOTE: Use when:
    - you want to assign the result to a variable, and use the result later
    - you need strict type comparisons
    - you're matching against scalar values (like int, float, string, boolean etc.)

   * Compares the value passed to match(), to against the match arms 
   * If a match is found, the return expression corresponding to a match-arm is returned
    and then assigned to the variable 
   * NOTE: match-expressions do strict equality (===) checks - i.e. they check both type & value
   
    $return_value = match (subject_expression) {
      single_conditional_expression => return_expression, // THIS IS A SINGLE MATCH-ARM
      conditional_expression1, conditional_expression2 => return_expression,
    };

   * NOTE: A match expression can list multiple values
   */
  $d = 8;
  $result = match ($d) {
    2, 4, 6, 8, 0 => "Variable \$d is even!",
    1 => "Variable \$d is equal to one!",
    3 => "Variable \$d is equal to three!",
    5 => "Variable \$d is equal to five!",
    7 => "Variable \$d is equal to seven!",
    9 => "Variable \$d is equal to nine!",
      // NOTE: it's common practice to include a trailing comma after the last match-case
    default => "No matches found",
  }; // NOTE: end in semi-colon, since we're assigning to a variable
  echo $result;

  ?>
</body>

</html>