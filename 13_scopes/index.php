<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scopes</title>
</head>

<body>
  <?php
  function newline() {
    echo "<br>";
  }

  // Scope --> where a variable/function is accessible within a PHP script

  /* ------------------------------ GLOBAL SCOPE ------------------------------ */
  // --> accessible anywhere in the script AFTER its declaration
  // --> by usual reference within the global scope
  // --> by passing global variable as argument to a function
  // --> by declaring it as a global variable within a nested scope
  echo $name; // ! WARNING: Undefined variable $name
  $name = "Daniel";
  echo "$name <br>"; // Daniel

  // PASSING GLOBAL VAR AS ARGUMENT
  function passInGlobalVar($name = "Default") {
    echo "Accessing variable via parameters: $name <br>";
  }

  passInGlobalVar(); // Default
  passInGlobalVar($name); // Daniel
  newline();

  /** USING 'global' KEYWORD
   *! DO NOT MAKE A HABIT OF DOING THIS
   *! ONLY DO THIS IF YOU HAVE A GOOD REASON TO 
   
   * A function accepts arguments to operate on external data
   * If we use the "global" keyword, the function becomes DEPENDENT on the definition 
    ...of the variable defined in the global scope
   * If the function is called in a place where the "global" var is not defined, then an 
    ...error/warning will occur, therefore the reusability of the function is reduced
   */
  function demoGlobalScope() {
    // ? Declare $name as a global variable to make it accessible
    global $name;

    // NOTE: Without declaring the variable as a global we get a warning:
    // ! Warning: Undefined variable $name
    echo "Accessing a global variable: $name <br>";
  }

  demoGlobalScope();
  newline();

  /** Using $GLOBALS to access a global variable 
   *! DO NOT MAKE A HABIT OF DOING THIS
   *! ONLY DO THIS IF YOU HAVE A GOOD REASON TO 
   */
  function demoGLOBALS() {
    echo 'Accessing a global variable via $GLOBALS: ' . $GLOBALS["name"] . "<br>";
  }

  demoGLOBALS();
  newline();

  /* ------------------------------- LOCAL SCOPE ------------------------------ */

  // LOCAL SCOPE --> accessible within a function
  function demoLocalScope() {
    // Declare variable scoped to this function
    $localVar = "I'm locally scoped! <br>";
    // Use the local variable
    echo $localVar;
  }

  // echo $localVar; // ! IS NOT ACCESSIBLE OUTSIDE THE FUNCTION: demoLocalScope 
  demoLocalScope();
  newline();

  /* ------------------------------ STATIC SCOPE ------------------------------ */

  /**
   * Notice: when we call this function below, the variable is scoped to the function
   * So on every invocation, a new locally scoped variable is created and then incremented 
   * After a function call finishes executing, the $localVar defined in that function
    ...is garbage collected 
   */
  function demoLocalVsStaticScope() {
    // A local variable is declared on each invocation of this function
    $localVar = 0;

    // Increment the local variable
    $localVar++;

    // Print the value of local variable
    echo $localVar . "<br>";
  }

  // NOTE: the value of $localVar RESETS to 0 for each call
  demoLocalVsStaticScope(); // 1
  demoLocalVsStaticScope(); // 1
  demoLocalVsStaticScope(); // 1
  newline();

  /**
   * A Static Scope is created whenever you create a static variable within a 
    ...function or class
   * The static variable will retain its state between function calls 
   * i.e. the static variable isn't garbage collected 
   */
  function demoStaticScope() {
    // Declare a static variable
    static $staticVar = 0;

    // Increment the static variable
    $staticVar++;

    // Use the static variable
    echo $staticVar . "<br>";
  }

  // NOTE: the value of $staticVar does not reset to 0 for each call
  demoStaticScope(); // 1
  demoStaticScope(); // 2
  demoStaticScope(); // 3
  newline();

  /* -------------------------------- CLOSURES -------------------------------- */

  /** CREATING A CLOSURE IN PHP 
   * Anonymous functions & the 'use' keyword can be used in conjunction to capture
    ...a variable from the outer/parent scope
   */
  function demoClosure() {
    // Parent scope
    $greeting = "Hello";

    /** Create a closure by:
     * Using an anonymous (unnamed) function
     * Capturing $greeting via 'use' keyword 
     */
    $greet = function ($name = "World") use ($greeting) {
      // $greeting is now accessible from the parent scope

      /* 
        You can also modify the value of the parent variable from within the nested 
        function, but keep in mind that changes made to the variable inside the 
        nested function will not affect the variable in the parent scope UNLESS
        you're dealing with objects or references. 
      */
      return "$greeting $name!";
    };

    return $greet;
  }

  $greet = demoClosure();
  echo $greet() . "<br>";
  echo $greet("Bilaal") . "<br>";
  newline();

  /** MODIFYING VARIABLE IN PARENT SCOPE VIA CLOSURE
   * In this example, we use the '&' symbol to pass the $counter variable by reference
   * This allows us to modify its value within the nested function.
   */

  $counter = 0;

  $incrementCounter = function () use (&$counter) {
    $counter++;
    echo $counter . "<br>";
    return $counter;
  };

  $incrementCounter(); // 1
  $two = $incrementCounter(); // 2
  $incrementCounter(); // 3
  newline();
  echo $two . "<br>"; // 2
  newline();

  /* ------------------------------- CLASS SCOPE ------------------------------ */
  class MyClass {
    // Define a class variable
    public $classVar = "Hello World!";

    // Define a class method
    public function myMethod() {
      // Use the class variable
      echo $this->classVar . "<br>"; // Output: "Hello World!"
    }
  }

  $instance = new MyClass();

  echo "Access '\$classVar' directly: " . $instance->classVar . "<br>";
  echo "Print '\$classVar' by calling myMethod(): ";
  $instance->myMethod();
  newline();
  ?>
</body>

</html>