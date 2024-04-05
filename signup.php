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
        $SQL = "SELECT * FROM users WHERE username = :username OR email = :email";
        $CONNECT_READY = $this->CONNECT()->prepare($SQL);
        $CONNECT_READY->bind_param('ss', $username, $email);
        $CONNECT_READY->execute();
        $RESULT = $CONNECT_READY->fetch(PDO::FETCH_ASSOC);

        // ALLOCATE ROWS FOR THE NEW USER

        return $RESULT ? true : false;
    }

    // HASHED PASSWORD AS PER THE REQUIREMENTS OF THE BRIEF

    protected function HASHED_PWD($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function CREATE_USER($DATA)
    {
        $username = $DATA["uid"];
        $email = $DATA["email"];
        $hashed_pwd = $this->HASHED_PWD($DATA["password"]);

        $SQL = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $STATE = $this->CONNECT()->prepare($SQL);
        $STATE->bind_param("sss", $username, $email, $hashed_pwd);

        return $STATE->execute() ? true : false;
    }
}

?>
