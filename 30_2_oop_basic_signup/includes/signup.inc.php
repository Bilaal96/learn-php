<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header('Location: ../index.php');
  exit();
}

$username = $_POST["username"];
$pwd = $_POST["pwd"];

// IMPORT OUR CLASSES -> THE ORDER OF IMPORTS MATTERS
// -- because Signup extends (is a subclass of) Dbh
// -- so the Parent class goes first, then the child class goes after
require_once '../classes/Dbh.php';
require_once '../classes/Signup.php';

$signup = new Signup($username, $pwd);

$signup->signupUser();
