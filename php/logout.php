<?php
/*
   LOGOUT FILE
  in this place
   - Ends user session
   - Redirects to homepage
  */

session_start();
session_unset();   // remove all session variables
session_destroy(); // destroy session

header("Location: ../index.html");
exit();
?>