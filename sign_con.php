<?php

// COPYRIGHT (C) HARRY CLARK 2024

// STUDENT NO. 230315257

// CS1_IAD PORTFOLIO 3

// THIS FILE PERTAINS TOWARDS THE MAIN FUNCTIONALITY SURROUNDING THE ENCOMPASSING
// LOGIC OF THE SIGN UP PAGE

// FOCUSSING ON THE CONTROLLER ASPECT WHICH WILL ACT AS THE MASTER LOGIC 
// FOR THE REST OF THE SIGNUP PAGE

class SignUpController
{
    private $USER;
    private $PWD;
    private $EMAIL;
    private $DB;

    public function __construct($USER, $PWD, $EMAIL, $DB) 
    {
        $this->USER = $USER;
        $this->PWD = $PWD;
        $this->EMAIL = $EMAIL;
        $this->DB = $DB;
    }

    protected function CHECK_USER($USER, $EMAIL)
    {
        $SQL = "SELECT * FROM users WHERE username = ? OR email = ?";
        $CONNECT_READY = $this->DB->prepare($SQL);
        $CONNECT_READY->execute([$USER, $EMAIL]);
        $RESULT = $CONNECT_READY->fetch(PDO::FETCH_ASSOC);

        return $RESULT ? true : false;
    }

    protected function HASHED_PWD($PWD)
    {
        return password_hash($PWD, PASSWORD_DEFAULT);
    }

    public function CREATE_USER($USER, $EMAIL, $PWD)
    {
        $HASH_PWD = $this->HASHED_PWD($PWD);

        $SQL = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $STATE = $this->DB->prepare($SQL);
        $STATE->execute([$USER, $EMAIL, $HASH_PWD]);

        return $STATE->rowCount() > 0 ? true : false;
    }

    public function register() 
    {
        if (!$this->USER || !$this->PWD || !$this->EMAIL) 
        {
            return "Invalid input";
        }
 
        if ($this->CREATE_USER($this->USER, $this->EMAIL, $this->PWD)) 
        {
            return "User added to the database";
        } 
        else 
        {
            return "An error occurred during registration";
        }
    }
}

if (isset($_POST['submitted'])) 
{
    require_once('database.php');

    $username = isset($_POST['username']) ? $_POST['username'] : false;
    $password = isset($_POST['password']) ? $_POST['password'] : false;
    $email = isset($_POST['email']) ? $_POST['email'] : false;

    $user = new SignUpController($username, $password, $email, $DB);
    echo $user->register();
}

?>
