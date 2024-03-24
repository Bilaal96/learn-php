<?php
// Resume the current session
session_start();

// Unset session vars 
session_unset();

// End session, deleting the Session ID Cookie, thus logging the user out
session_destroy();

header("Location: ../index.php");

die();
