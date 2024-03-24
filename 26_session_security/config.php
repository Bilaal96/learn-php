<?php
// Import (require_once) this file at the top of any pages using Sessions


/** ini_set(string $option, string $optionValue)
 * Sets the value of a configuration option
 * NOTE: passing an int will be coerced to type string (via PHP type juggling)
 
 * Value of 1 represents true
 * Value of 0 represents false
 
 session.use_only_cookies
 * NOTE: this setting can be configured in php.ini file
 * Ensures Session IDs can only be passed around via Cookies
 * Prevents Session IDs from being passed in the URL - as this is susceptible to 
  Session Fixation

 session.use_strict_mode - MANDATORY TO INCLUDE WHEN USING SESSIONS
 * Makes sure that the website only uses a Session ID that was created by our server
 * Also generates a more complex Session ID which helps against Session ID Prediction
 */
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1); // ! MUST INCLUDE

/** session_set_cookie_params()
 * Allows you to set session cookie parameters - i.e. configures cookie settings 
 * You can use it to make your cookies more secure
 * The effect of this function only lasts for the duration of the script
 * Thus, you need to call session_set_cookie_params() for every request and before 
  session_start() is called
 
 * DOCS: https://www.php.net/manual/en/function.session-set-cookie-params.php
 */
session_set_cookie_params([
  // session.cookie_lifetime: https://www.php.net/manual/en/session.configuration.php#ini.session.cookie-lifetime
  // Lifetime of the cookie in seconds - it expires after lifetime has passed
  "lifetime" => 1800, // 30 mins in seconds (30 * 60 = 1800)

  // session.cookie_domain: https://www.php.net/manual/en/session.configuration.php#ini.session.cookie-domain
  // Website domain that this cookie is visible on (e.g. www.example.com)
  "domain" => "localhost",

  // session.cookie_path: https://www.php.net/manual/en/session.configuration.php#ini.session.cookie-path
  // Path on the domain where the cookie will work
  "path" => "/", // '/' means all paths on the specified domain

  // session.cookie_secure: https://www.php.net/manual/en/session.configuration.php#ini.session.cookie-secure
  // True if cookie will only be sent over a secure HTTPS connection
  // Default value is false - meaning cookies are sent over both: HTTP & HTTPS
  "secure" => true,

  // session.cookie_httponly: https://www.php.net/manual/en/session.configuration.php#ini.session.cookie-httponly
  // Marks the cookie as accessible ONLY through the HTTP protocol
  // This means that the cookie won't be accessible by scripting languages, such as JavaScript
  // This setting can effectively help to reduce identity theft through XSS attacks (although it is not supported by all browsers)
  "httponly" => true,

  // session.cookie_samesite: https://www.php.net/manual/en/session.configuration.php#ini.session.cookie-samesite
  // Allows servers to assert that a cookie ought not to be sent along with cross-site requests
  // This assertion allows user agents to mitigate the risk of cross-origin information 
  // ...leakage, and provides some protection against cross-site request forgery attacks
  // An empty value means that no SameSite cookie attribute will be set.
  // Lax and Strict mean that the cookie will not be sent cross-domain for POST requests
  // Lax will send the cookie for cross-domain GET requests, while Strict will not
  "samesite" => "Strict",
]);

// NOTE: it is important to configure session cookie settings BEFORE starting the session
session_start();

/** session_regenerate_id()
 * NOTE: The default Session IDs are not very secure
 * This function allows us to regenerate a more secure Session ID for the current session 
 
 * It's also a good practice to periodically call this function, so that the ID for the
  current session is regenerated 
 * The idea here is that, the longer a session exists, the greater the likelihood that 
  it can be hijacked
 * By regenerating the ID every so often, we invalidate the previous Session ID
 * So even if it was intercepted, it can no longer be used to impersonate this Session
  as its ID has been regenerated

 * NOTE: an alternative is session_create_id()
 * You could use this to combine a userID (obtained after login) with a generated Session ID
 */

// session_regenerate_id(true);

// Regenerate Session ID every 30 mins
if (!isset($_SESSION["last_regeneration"])) {
  // First time visiting website - create session
  // Generate a new (and stronger) Session ID
  session_regenerate_id(true);
  // Store Unix Timestamp of when ID was last regenerated as a session variable
  $_SESSION["last_regeneration"] = time();
} else {
  // If the specified time interval has passed since our last Session ID regeneration
  // Regenerate the Session ID again
  // Otherwise, the current Session is valid
  $interval = 60 * 30; // 1800 seconds = 30 mins

  if (time() - $_SESSION["last_regeneration"] >= $interval) {
    session_regenerate_id(true);
    $_SESSION["last_regeneration"] = time();
  }
}
