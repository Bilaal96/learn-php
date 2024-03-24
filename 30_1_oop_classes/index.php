<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OOP 📦</title>
</head>

<body>
  <?php
  // Procedural PHP
  $brand = "Volvo";
  $color = "Green";

  function getCarInfo($brand, $color) {
    return "Brand: $brand, Color: $color";
  }

  echo getCarInfo($brand, $color) . "<br>";
  echo "<br>";

  require_once './Classes/Car.php';

  // Instantiate Car class
  // Car 1 
  $car01 = new Car("Volvo", "Green");

  // -- access public property
  echo $car01->vehicleType . "<br>"; // car
  // -- access public method
  echo $car01->getCarInfo(); // Brand: Volvo, Color: Green
  echo "<br>";
  // -- access private property via getter method
  echo $car01->getBrand(); // Volvo
  echo "<br>";
  // -- update private property via setter method
  $car01->setBrand("Lamborghini");
  echo $car01->getBrand(); // Lamborghini
  echo "<br>";
  $car01->setColor("Yellow");
  echo $car01->getColor(); // Yellow
  echo "<br>";
  // -- add constraints to the type of colors allowed
  $car01->setColor("Purple"); // Cannot set this car to color of Purple
  echo "<br>";
  echo $car01->getColor(); // STILL Yellow
  echo "<br>";
  echo "<br>";

  // Car 2 
  $car02 = new Car("BMW");

  echo $car02->vehicleType . "<br>"; // car
  echo $car02->getCarInfo(); // Brand: BMW, Color: None
  echo "<br>";
  echo "<br>";

  // Car 3 
  $car03 = new Car("Toyota", "Yellow");
  echo $car03->vehicleType . "<br>"; // car
  echo $car03->getCarInfo(); // Brand: Toyota, Color: Yellow
  echo "<br>";
  echo "<br>";
  ?>
</body>

</html>