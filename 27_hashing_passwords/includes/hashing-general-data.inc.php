<?php

/* -------------------------- Hashing General Data -------------------------- */

/**
 * This is useful for sensitive data that is not a password
 * e.g. name, email, financial info
 */
// NOTE: view output by visiting: http://localhost/php-dani-krossing/27_hashing_passwords/includes/hash-password.inc.php
// Hashing non-password data
// You provide "salt" & "pepper"
$sensitiveData = "Krossing";

// Generate random salt
// -- generate a random string of 16 bytes & convert it to a hexadecimal string
$salt = bin2hex(random_bytes(16));
echo "<br>Salt: " . $salt . "<br>";

// Create pepper - a KNOWN keyword/secret (i.e. it is NOT random)
$pepper = "aSecretPepperString";

// Combine the data with the salt & pepper
$dataToHash = $sensitiveData . $salt . $pepper;

// Hash the data using the built-in hash() function
// -- string name of hashing algorithm
// -- data to hash
$hash = hash('sha256', $dataToHash);

echo "<br>Hash: " . $hash . "<br>";

// At this point it's safe to store the data securely (e.g. in a DB or file storage system)
// Including bot the salt & the hash

// Then you may want to send new data to the server & ensure that it matches the hashed data stored
// To do this, you'd have to retrieve the stored information (e.g. via DB query)

$submittedData = "Krossing"; // submitted by user via form

// We'll imagine we did that and stored the fetched salt & data in variables
// -- From DB
$storedSalt = $salt;
$storedHash = $hash;
// -- Secret known by server
$pepper = "aSecretPepperString";

// Combine the data with the salt & pepper
$dataToHash = $submittedData . $salt . $pepper;
// Hash the submitted data
$verificationHash = hash("sha256", $dataToHash);

// Compare the submitted data to the stored data
// NOTE: to run else-block, edit $submittedData so that it doesn't match $sensitiveData
if ($verificationHash === $storedHash) {
  echo "<br>Your data passed the vibe check! You a real G homie 😎 <br>";

  // NOTE: how the hashes match!
  echo "<br>Stored Hash : $hash<br>";
  echo "<br>Verified Hash : $verificationHash <br>";
} else {
  echo "<br>IT'S AN IMPAAASTAAAAAHH<br>";
}
