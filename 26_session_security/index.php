<!-- Import session config -->
<?php require_once 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Session Security</title>
</head>

<body>
  <?php
  /** Ways in which users are vulnerable to Session Hijacking 
   * Session Hijacking involves a (malicious) user stealing your session ID and acting 
    on your behalf
   
   --- Session ID Sniffing ---
   * Where a user can intercept insecure traffic & hijack your Session ID. 
   * Then they can use it to impersonate you from their own computer.
   
   Session ID Security is important to prevent session data from being stolen  
   * It is achieved by ensuring that the Session ID on the server only points to the 
    user to whom the session belongs to and no-one else
   * It's also important to use an HTTPS connection rather than HTTP, as the former 
    is encrypted
   * The use of HTTPS helps protect users' privacy and security by preventing attackers 
    from intercepting or tampering with the data being transmitted

   --- Session ID Prediction ---
   * Where a malicious user tries to guess what your Session ID is
   * If the Session ID generated is weak, it's important to programmatically regenerate
    a more secure one

   --- Session Fixation ---
   * The user forces you to use a Session ID Cookie created by them
   * This can occur if you click on a link they send (e.g. via email)
   * In that link may be a Session ID created by them
   * So you would end up visiting the website link with THEIR Session ID
   * Essentially, you're impersonating THEM without knowing
    
   --- XSS Attacks ---
   * Someone could inject JS code into your site in order to steal your cookies
   */
  ?>

  <?php
  /** Session Security Basics
   
   * Always sanitize user generated data - i.e. data submitted by a user
   * DO NOT store sensitive data inside a Session Variable
    - e.g user address, phone number, email etc.
    - if a hacker gains access to your Session, they'll have all your personal data
   * Delete any Session Data/Variables that are no longer needed
    - this is a preventative measure that minimises risk (of being stolen)
    - if the data is no longer required, simply don't expose it! 

   * NOTE: you may notice as you add more layers of security, the inconvenience for 
    the user increases
   * You have to find the balance between UX and Security (what is more important 
    for your application)
   * For example:
    - For max security, users must sign in every time they visit your site
    - This is ideal for banks

    - However, for a shop or social media site you want to persist the user session
      to remove barriers to entry & increase ease of access
    - In this case, logging in every time becomes an inconvenience and may turn users 
     away from using your site
   */
  ?>

  <?php
  /** php.ini file
   * NOTE: many of the security measures explored here can be enforced in a php.ini file
   * This is a config file that lives on your server with various settings you can configure
   * For example it has an equivalent ways to implement PHP configurations:
    - session.use_only_cookies
      > ensures that any Session ID can ONLY be passed using COOKIES & NOT in the URL
      > prevents Session Fixation 

   * But in this lesson, we'll be focusing on securing the site with PHP code
   * So we will use PHP functions that apply these configuration settings to php.ini 
    programmatically
   */
  ?>
</body>

</html>