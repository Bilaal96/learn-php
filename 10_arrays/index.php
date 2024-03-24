<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arrays & Associative Arrays</title>
</head>

<body>
  <?php
  // Arrays store multiple values in one variable
  $fruit01 = "apple";
  $fruit02 = "pear";

  // Define an array
  // -- via function
  $fruits = array("Apple", "Banana", "Cherry",); // PHP 8 allows a trailing comma 
  // -- via square brackets - more concise
  $fruits = [
    // NOTE: you can set each element on a new line for formatting
    // this is done by personal preference
    "Apple",
    "Banana",
    "Cherry",
  ];

  // $arr[i] - Access an array via numeric index (starting at 0)
  echo $fruits[0] . '<br>';
  echo $fruits[1] . '<br>';
  echo $fruits[2] . '<br>';
  echo "<br>";

  // $arr[] - Append to an array
  // -- single string
  echo "Append to array via \$arr[]:" . "<br>";
  $fruits[] = "Orange";
  echo $fruits[3] . '<br>';

  // -- nest an array
  $fruits[] = ["Tomato", "Pomegranate"];
  echo print_r($fruits[4], true) . '<br>';
  echo "<br>";

  // array_push()
  echo "Append to array via array_push():" . "<br>";
  array_push($fruits, "Honeydew Melon", "Watermelon");
  $fruitsLength = count($fruits); // 7
  echo "Length of \$fruits array: " . $fruitsLength . "<br>";

  echo $fruits[$fruitsLength - 1] . '<br>'; // $fruits[6] = "Watermelon"
  echo $fruits[$fruitsLength - 2] . '<br>'; // $fruits[5] = "Honeydew Melon"
  echo "<br>";

  // NOTE: you can spread an array of args
  array_push($fruits, ...["Satsuma", "Blueberry"]);
  $fruitsLength = count($fruits); // 9
  echo "Length of \$fruits array: " . $fruitsLength . "<br>";

  echo $fruits[$fruitsLength - 1] . '<br>'; // $fruits[8] = "Blueberry"
  echo $fruits[$fruitsLength - 2] . '<br>'; // $fruits[7] = "Satsuma"
  echo "<br>";

  // array_unshift($arr, ...$values) - Prepend to an array
  echo "Prepend to array via array_unshift():" . "<br>";
  array_unshift($fruits, "Kiwi", "Strawberry");
  echo $fruits[0] . '<br>'; // "Kiwi"
  echo $fruits[1] . '<br>'; // "Strawberry"
  echo "<br>";

  // NOTE: you can spread an array of args
  array_unshift($fruits, ...["Mango", "Pear"]);
  echo $fruits[0] . '<br>'; // "Mango"
  echo $fruits[1] . '<br>'; // "Pear"
  echo "<br>";

  // unset($arr[i]) - Remove value associated with the given index of an array
  // NOTE: this does NOT remove the array element
  echo "Remove value without removing element via unset(\$arr[i]): <br>";
  unset($fruits[1]);
  echo $fruits[1] . '<br>'; // ! Warning: Undefined array key 1
  echo "Element is accessible but key is Undefined! <br>";
  echo "<br>";

  /** array_splice(array &$arr, int $offset, ?int $length, mixed $replacement = [])
   * Remove a portion of the array and replace it with something else
   * Returns array of extracted elements
   * If replacement is not provided, the elements are simply removed 
   
   * If length is omitted, removes everything from offset to the end of the array. 
   * If length is specified and is positive, then that many elements will be removed. 
   * If length is specified and is negative then the end of the removed portion will 
    ...be that many elements from the end of the array. 
   * Tip: to remove everything from offset to the end of the array when replacement 
    ...is also specified, use count($input) for length.
   */

  /** var_export($var, $return = false) 
    - Outputs or returns a parsable string representation of a variable
   
   * $var - The variable you want to export
   * $return - If used and set to true, var_export will return the variable representation instead of printing/outputting it
   */

  /** count($arr) 
   * Used to return length of array
   */
  echo "Remove elements from an array via array_splice(): <br>";
  echo "\$fruits array before updates: " . var_export($fruits, true) . "<br>";
  echo "\$fruits array length:" . count($fruits) . "<br>";
  echo "<br>";
  echo "Removed first 2 elements: " . var_export(array_splice($fruits, 0, 2), true) . "<br>";
  echo "Updated \$fruits array: " . var_export($fruits, true) . "<br>";
  echo "Updated \$fruits array length:" . count($fruits) . "<br>";
  echo "<br>";


  /** Associative Arrays
   * Has strings as keys instead of numbers
   * Allow you to assign a named key associated with a specific element 
   */
  $tasks = [
    "Laundry" => "Daniel",
    "Trash" => "Frida",
    "Vacuum" => "Jane",
    "Dishes" => "Bella",
  ];

  echo "Associative Arrays: <br>";
  echo $tasks["Laundry"] . " is on Laundry duty" . "<br>";
  echo $tasks["Trash"] . " is on Trash duty" . "<br>";
  echo $tasks["Vacuum"] . " is on Vacuum duty" . "<br>";
  echo $tasks["Dishes"] . " has to do the Dishes" . "<br>";
  echo "<br>";

  /** 
   * var_dump($var) - Dumps info about a variable
    - when this $var is an array, it will print the array length & its elements 
   * NOTE: Small issue: var_dump will immediately print the info on $var
   * This means you can't concatenate it to another string
   
   * print_r($var, $return = false) - prints human readable info for the given variable
   * Passing $return = true -> will allow you to concat the output to another string
   * This behaviour is similar to var_export($var, $return = false)
    
   * USEFUL SO POST: Difference between var_dump,var_export & print_r
   * https://stackoverflow.com/questions/5039431/difference-between-var-dump-var-export-print-r
   */
  echo "Using var_dump(): <br>";
  echo var_dump($tasks);
  echo "<br>";
  echo "\$tasks array: " . var_dump($tasks);
  echo "<br>";
  echo "<br>";

  echo "Using print_r(): <br>";
  echo print_r($tasks);
  echo "<br>";
  echo "\$tasks array: " . print_r($tasks);
  echo "<br>";
  echo "\$tasks array: " . print_r($tasks, true);
  echo "<br>";

  /** Sorting arrays
   * DOCS: https://www.php.net/manual/en/array.sorting.php 
   
   Maintains key association 
   * asort($arr) - Sorts the array by values -> in ASC order 
   * arsort($arr) - Sorts the array by values -> in DESC order 
   * ksort($arr) - Sorts the array by keys -> in ASC order 
   * krsort($arr) - Sorts the array by values -> in DESC order 
   
   Doesn't maintain key association - Keys of Associative Array will become indices
   * sort($arr) - Sorts the array by values -> in ASC order 
   * rsort($arr) - Sorts the array by values -> in DESC order 
   * shuffle($arr) - Sorts the array -> in random order
   */
  asort($tasks);
  echo "Sorted \$tasks: " . print_r($tasks, true) . "<br>";
  echo "<br>";


  // Append to associative array
  echo "Append to associative array via \$arr[\"key\"]: <br>";
  $tasks["Dusting"] = "Tara";
  print_r($tasks); // NOTE: "Dusting" => "Tara" was added to the array
  echo "<br>";

  echo "Remove an element from an array via array_splice(): <br>";
  $tasksComplete = array_splice($tasks, 0, 1);
  echo "Updated \$task list: " . print_r($tasks, true) . "<br>";
  echo "\$tasksComplete: " . print_r($tasksComplete, true) . "<br>";
  echo "<br>";

  // Insert element at specific index of an array via array_splice()
  echo "Insert element at specific index of an array via array_splice(): <br>";
  $veggies = [
    "Cucumber",
    "Lettuce",
    "Pickle",
    "Peas",
    "Sweetcorn",
  ];
  echo "\$veggies array: " . print_r($veggies, true) .  "<br>";
  $result = array_splice($veggies, 1, 0, "Carrot");
  echo "Insert 'Carrot' at index 1: " . print_r($veggies, true) . "<br>";
  echo "Return value of array_splice() when nothing is removed:" . print_r($result, true) . "<br>"; // empty array
  echo "<br>";

  // Insert elements of an array into another array at a specific index
  echo "Insert elements of an array into another array at a specific index via array_splice(): <br>";
  echo "\$veggies array: " . print_r($veggies, true) .  "<br>";

  $newVeggies = ["Onion", "Radish"];
  array_splice($veggies, 3, 0, $newVeggies);
  echo 'Insert ["Onion", "Radish"] at index 3: ' . print_r($veggies, true) . "<br>";
  echo '<br>';

  /** Multi-dimensional Arrays - arrays containing arrays
   * You can access each nested level of an array by:
    - appending another set of square brackets 
    - passing an index to specify the element you want to access
  
   * $arr[0][2][1] - access an array nested 2-levels deep within $arr
   */

  // Nesting regular arrays
  $food = [
    array("wings", "lamb chops"),
    array("noodles", "lasagne"),
    array("cake", "ice cream"),
  ];
  echo "Multi-dimensional \$food array: <br>";

  // NOTE: print a nested array in readable format
  print('<pre>' . print_r($food, true) . "</pre>");

  $starters = $food[0];
  $mains = $food[1];
  $desserts = $food[2];

  echo "starters: " .  print_r($starters, true) . "<br>";
  echo "mains: " . print_r($mains, true) . "<br>";
  echo "desserts: " . print_r($desserts, true) . "<br>";

  // Accessing nested array
  $order = [
    $food[0][1], // lamb chops
    $food[1][1], // lasagne
    $food[2][0], // cake
  ];

  echo "order: " . print_r($order, true) . "<br>";
  echo "<br>";


  // Nesting associative arrays
  $groceries = [
    "fruits" => array("Apple", "Banana", "Cherry"),
    "veg" => array("Cucumber", "Lettuce", "Onion"),
    "meat" => array("Chicken", "Fish", "Lamb"),
    "toiletries" => array("Shampoo", "Conditioner", "Toilet roll"),
  ];
  // NOTE: print a nested array in readable format

  echo "Grocery list: <br>";
  print('<pre>' . print_r($groceries, true) . "</pre>");
  echo "<br>";

  echo "fruits: " . print_r($groceries["fruits"], true) . "<br>";
  echo "veg: " . print_r($groceries["veg"], true) . "<br>";
  echo "meat: " . print_r($groceries["meat"], true) . "<br>";
  echo "toiletries: " . print_r($groceries["toiletries"], true) . "<br>";
  echo "<br>";

  echo "Favourite groceries: <br>";
  echo $groceries["fruits"][0] . "<br>"; // Apple
  echo $groceries["veg"][0] . "<br>"; // Cucumber
  echo $groceries["meat"][0] . "<br>"; // Chicken
  echo $groceries["toiletries"][1] . "<br>"; // Conditioner


  ?>
</body>

</html>