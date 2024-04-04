<?php

// COPYRIGHT (C) HARRY CLARK 2024

// STUDENT NO. 230315257

// CS1_IAD PORTFOLIO 3

// THIS FILE PERTAINS TOWARDS THE LOGIC OF ACCESSING AND COMMUNICATING
// WITH A LOCALLY DISTRIBUTED DATABASE USING PHPMA

class SignUp extends Database
{
    // PROTECTED FUNCTION THAT HAS NO BODY WITHOUT THE DATABASE CLASS
    // TO EXTEND METHODS AND ATTRIBUTES FROM

    // THIS METHOD LOOKS TO DETERMINE IF THERE IS A VALID USER IN THE QUERY
    // FROM THERE, BIND A USER BASED ON THE USERNAME AND EMAIL THEY PROVIDE

    protected function CHECK_USER($username, $email)
    {
        $CONNECT_READY = $this->CONNECT()->prepare('SELECT * FROM users WHERE username = ? OR email = ?');
        $CONNECT_READY->bind_param('ss', $username, $email);
        $CONNECT_READY->execute();
        $RESULT = $CONNECT_READY->get_result();

        // ALLOCATE ROWS FOR THE NEW USER

        return ($RESULT->num_rows > 0) ? true : false;
    }

    // HASHED PASSWORD AS PER THE REQUIREMENTS OF THE BRIEF

    protected function HASHED_PWD($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}

?>
