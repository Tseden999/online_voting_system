<?php    
session_start();

// Remove the session variable
unset($_SESSION['loginDetails']);
echo "Logout successfully !";
?> 