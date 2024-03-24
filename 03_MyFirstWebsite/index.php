<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>Test</h1>
  <?php
    // Anything between opening & closing tags is read by PHP parser
    // Semi-colons are required and terminate the current line
    echo "Hello world!";
    
    // The closing PHP tag auto-implies a semi-colon
    // echo "Hello world!" // This one wouldn't work
    echo "Hello world!" // but this will still work
    // Either way, it's recommended (and a good habit) to include the semi-colon after each statement    

    // NOTE: for files that ONLY contain PHP, we omit the closing PHP tag
    // This is a preventative measure, since including it and entering stuff (e.g. a space) 
    // after the closing PHP tag can cause issues
  ?>

  <!-- PREFER THIS: (retains syntax checking & highlighting) -->
  <?php if(true) { ?>
  <p>Some HTML text.</p>
  <?php } ?>

  <!-- OVER THIS: -->
  <?php
    /**
     * Multiline
     * comment 
     */
    if(true) {
      echo "<p>Some HTML text.</p>";
    }
  ?>
</body>

</html>