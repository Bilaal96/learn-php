<?php

/** 
 --- What is Hashing? ---
 * Hashing is the conversion of plain text to a non-readable fixed length string
 * It's "non-readable" in the sense that it looks like a random combination of characters
 * Hashing is done by passing the plain text through a hashing algorithm
 * There are many different types of hashing algorithms
 
 * Hashing is a pure one-way conversion 
  - pure - it will return the same output when given the same input
  - we cannot practically decrypt the hash (i.e. reverse the hashing process) 
   due to the computational power required to do so

 * Using a password as example, once the password is hashed, we store the hashed data
 * So how can I ensure that when the user logs in again with their plain text password
  that they have entered the correct password?
 * It's simple! Hash the password they're trying to login with and compare it to the hash 
  stored in the DB
 * Since the Hashing function is pure, if the password is correct, it will produce a
  hash matching the one stored in the DB
 * If they match, we can be sure that the user entered the correct password 
  
 --- How to Hash a value ---
 * A hashing function requires the value you want to hash and a "salt"
 * The salt is a one-time generated random string of text that you provide to the 
  hashing function (along with the value you want to hash)
 * Its purpose is to make it even harder to decrypt a hashed password 
 */

/* ---------------------------- Hashing Passwords --------------------------- */
/**
 * As hashing passwords is a common use-case we have a much simpler method to do so:

 password_hash(string $password, string|int|null $algo, array $options)
 * Hashes the given password using the specified algorithm 
 * NOTE: we don't have to generate a salt/pepper, this is all done for us by the function
 
 * For the $algo param, we generally use 2 types that can be specified using PHP constants:
  - PASSWORD_DEFAULT - auto-updates when something new comes out in PHP
  - PASSWORD_BCRYPT - currently used as default at this moment in time
    ^^^ this is the recommended one to use

 * In the 3rd $options param, we can specify a "cost factor" which helps against Brute Force attacks
 * Essentially, it slows the attack down by adding time between each attempt of hashing the password
 */

// Imagine this is some user submitted password on Sign Up (i.e. registration)
$pwdOnSignUp = "Krossing";
$options = [
  "cost" => 12, // recommended between 10-12 (12 is stronger)
];

// This is what we would store in our DB
$hashedPwd = password_hash($pwdOnSignUp, PASSWORD_BCRYPT, $options);

// ! You would never want to reveal this info
echo "<br>Hashed User Password: $hashedPwd<br>";


/** Verifying a user submitted password on login
 * Just like with our hashed general data (see hashing-general-data.inc.php), we want to hash the submitted user input
 * Then compare the hashed input to the hashed password stored in the DB
 * If they match, then the password entered is correct
 * Otherwise, the password is incorrect!
 
 password_verify($password, $hash)
 * Allows us to verify that the user submitted password matches the password stored in the DB
 */
$pwdOnLogin = "Krossing";

if (password_verify($pwdOnLogin, $hashedPwd)) {
  echo "<br>You may enter! 😁<br>";
} else {
  echo "<br>YOU SHALL NOT PASS! 🧙🏿‍♂️<br>";
}
