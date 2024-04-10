<?php

// COPYRIGHT (C) HARRY CLARK 2024

// STUDENT NO. 230315257

// CS1_IAD PORTFOLIO 3

// THIS FILE PERTAINS TOWARDS THE FUNCTIONALITY OF LOGGING THE USER OUT

class UserLogout 
{
    public function LOGOUT() 
    {
        $_SESSION = array();
        session_destroy();
        header("Location: index.php");
        exit;
    }
}

$USER_BYE_BYE = new UserLogout();
$USER_BYE_BYE->LOGOUT();
?>
