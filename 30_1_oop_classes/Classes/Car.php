<?php

/**
 * A class is a template/blueprint from which you can create instances
 * Think of a cookie cutter. The shape is fixed. When used on cookie dough it will produce cookies of the same shape.
 * We can use Classes to create Objects. The ability of each Object is limited to what is defined by the Class
 * Classes are the cookie cutter in this example & Objects are the cookies cut from  the cookie dough in the shape of the Class
 */

/** 
 Classes consist of: properties (AKA attributes or fields) & methods (AKA functions or behaviours)
 * Property -> like a variable -> stores info about a particular Object
 * Method -> like a function -> execute behaviour that belongs to a particular Object
 * The all-encompassing terms for properties, methods & fields is "members"
  - where each property / method / field can be considered a "member" of the Class
 
 Visibility/Access Modifiers
 * Determine who has access to information (e.g. property/method) about a Class/Object
 * Allows us to encapsulate private information such that it can't be accessed/modified DIRECTLY outside of the Class
  - info may be modified indirectly through a method (e.g. a setter method)

 * private - a private member is only accessible in the Class where it is defined
 * protected - a protected member (defined in the Base/Parent Class) is also accessible in any Child Class which inherits from/extends the Parent Class
 * public - a public member is accessible both inside the Class definition AND as a property of an Object (i.e. an instance of the Class)
 * static - a static member is accessible on the Class itself (i.e. without instantiating the Class)
 
 * By default, assume everything to be private until it is required outside of the class & it makes sense to make it public
  
 Class Constructor Function
 * Used to assign values to properties inside the Class, when the Class is being instantiated
 */
class Car {
  // Properties (known as Fields in other languages like C#, where "Properties" is the name reserved for getter/setter methods)
  private $brand;
  private $color;

  // This just demos that some properties may have a fixed value
  public $vehicleType = "car";

  // Class Constructor: __construct is a reserved keyword in PHP
  // -- allows us to assign values passed into the Class Constructor to properties without values
  // NOTE: we can use default parameter syntax in Constructors param list 
  public function __construct($brand, $color = "None") {
    // $this refers to the Class instance (i.e. the object being created from the Class) 
    // NOTE: properties being accessed/written to are not prefixed with "$"
    $this->brand = $brand;
    $this->color = $color;
  }

  // Getter & Setter Methods (known as Properties in other languages like C#)
  // -- don't expose properties (via 'public') just so you can access them
  // -- instead create getter functions -> that retrieve and return a property's value
  public function getBrand() {
    return $this->brand;
  }

  // -- and create setter functions -> that update a property's value
  public function setBrand($brand) {
    $this->brand = $brand;
  }

  //! You must create getter/setters for all properties you want to access/update
  public function getColor() {
    return $this->color;
  }
  public function setColor($color) {
    // Setters allow us to impose constraints
    // e.g. here we can restrict which colors can be assigned to a car
    $allowedColors = [
      "Red",
      "Blue",
      "Green",
      "Yellow",
    ];

    // in_array() -> built-in PHP function -> checks if value exists in an array
    if (in_array($color, $allowedColors)) {
      $this->color = $color;
    } else {
      echo "Cannot set this car to color of $color";
    }
  }

  // Method
  public function getCarInfo() {
    // Access private properties WITHIN the class using $this
    return "Brand: $this->brand, Color: $this->color";
  }
}
