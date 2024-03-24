<?php

// Mandatory security practice
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

// Set session cookie params
session_set_cookie_params([
  "lifetime" => 30 * 60, // 30 mins
  "domain" => "localhost",
  "path" => "/",
  "secure" => true, // HTTPS connection 
  "httponly" => true, // prevent XSS (JS injection)
  "samesite" => "Strict",
]);

// Init session
session_start();

/** Regenerate session id
 * Track the last time the session ID was regenerated 
 * Regenerate the Session ID after the specified interval since the last regeneration has passed
 */
if (!isset ($_SESSION["last_regen"])) {
  setNewSessionId();
} else {
  $interval = 30 * 60; // 30 mins

  if (time() - $_SESSION["last_regen"] >= $interval) {
    setNewSessionId();
  }
}

function setNewSessionId() {
  session_regenerate_id(true); // true = deletes old session data
  $_SESSION["last_regen"] = time();
}

/* -------------------------------------------------------------------------- */

/** FLAWS WITH TUTORIAL SOLUTION
 *! session_id($newValue) must be called before session_start()
 *! As a result, the functions from the tutorial will not work 
 *! They have been replaced with the solution outlined above
 */

// If user is logged in, manually regenerate Session ID, appending the user ID
/* if (isset ($_SESSION["user_id"])) {
  tutorial_regenerateSessionId('setAuthedUserSessionId');
} else {
  // If user is not logged in let PHP regenerate Session ID
  tutorial_regenerateSessionId('setGuestUserSessionId');
} */

/** 
 Session ID Regeneration function:
 * Determine the method used to regenerate the session ID
  - setAuthedUserSessionId
  - or setGuestUserSessionId
 * Track the last time the session ID was regenerated 
 * Regenerate the Session ID after the specified interval since the last regeneration has passed
 */

// Manually create a session ID comprising of an authenticated user's ID
function setAuthedUserSessionId() {
  // Create new Session ID & append user ID
  $newSessionId = session_create_id();
  $sessonId = $newSessionId . "_" . $_SESSION["user_id"];
  // Update the Session ID
  session_id($sessonId);

  // Track when Session ID was last regenerate
  $_SESSION["last_regen"] = time();
}

// Auto-regenerate session ID for guest users 
function setGuestUserSessionId() {
  session_regenerate_id(true);
  $_SESSION["last_regen"] = time();
}

// Regenerate session ID every 30 mins
/** 
 * NOTE: Using callbacks in PHP
 * Define named function -> callback param: pass name of function as string (e.g. $callback = 'myFunc') -> $callback() === myFunc()
 * Pass an anonymous (anon) function as an argument -> invoke callback param -> $callback()
 * You may also assign the anon function to a variable -> then pass the var as argument 
 */
function tutorial_regenerateSessionId($sessionIdRegenCallback) {
  if (!isset ($_SESSION["last_regen"])) {
    $sessionIdRegenCallback();
  } else {
    $interval = 30 * 60; // 30 mins

    if (time() - $_SESSION["last_regen"] >= $interval) {
      $sessionIdRegenCallback();
    }
  }
}