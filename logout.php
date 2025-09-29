<?php
session_start();       // Always start the session first
session_unset();       // Remove all session variables
session_destroy();     // Destroy the session completely

// Redirect to login page
header("Location: login.php");
exit;
?>
