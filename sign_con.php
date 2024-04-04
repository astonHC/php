<?php

// COPYRIGHT (C) HARRY CLARK 2024

// STUDENT NO. 230315257

// CS1_IAD PORTFOLIO 3

// THIS FILE PERTAINS TOWARDS THE MAIN FUNCTIONALITY SURROUNDING THE ENCOMPASSING
// LOGIC OF THE SIGN UP PAGE

// FOCUSSING ON THE CONTROLLER ASPECT WHICH WILL ACT AS THE MASTER LOGIC 
// FOR THE REST OF THE SIGNUP PAGE

class SignUpController extends SignUpPage
{
    private static $uid;
    private static $email;
    private static $email_retype;

    public function __construct($fields)
    {
        $this->uid = isset($fields['uid']) ? $fields['uid'] : null;
        $this->email = isset($fields['email']) ? $fields['email'] : null;
        $this->email_retype = isset($fields['email_retype']) ? $fields['email_retype'] : null;
    }

    private function EMPTY_INPUT()
    {
        return empty($this->uid) || empty($this->email) || empty($this->email_retype);
    }

    private function INVALID_INPUT($INPUT)
    {
        $INPUT_TYPES = [
            'uid' => $this->uid,
            'email' => $this->email,
            'email_retype' => $this->email_retype
        ];

        switch ($INPUT) {
            case 'uid':
                return !preg_match("/^[a-zA-Z0-9]*$/", $this->uid);
            case 'email':
                return !filter_var($this->email, FILTER_VALIDATE_EMAIL);
            case 'email_retype':
                return !filter_var($this->email_retype, FILTER_VALIDATE_EMAIL);
            default:
                throw new Exception("Invalid Variable Type");
        }
    }

    public function SIGNUP_USER()
    {
        if ($this->EMPTY_INPUT()) 
        {
            header("location: ../index.php?error=emptyinput");
            exit();
        }

        if ($this->INVALID_INPUT('email')) 
        {
            header("location: ../index.php?error=invalid_email");
            exit();
        }

        if ($this->email !== $this->email_retype) 
        {
            header("location: ../index.php?error=emails_dont_match");
            exit();
        }

        if ($this->CHECK_USER($this->uid, $this->email)) 
        {
            header("location: ../index.php?error=user_exists");
            exit();
        }

        $hashed_password = $this->HASHED_PWD($this->password);

        if (!$this->CREATE_USER(["uid" => $this->uid, "email" => $this->email, "password" => $hashed_password])) 
        {
            header("location: ../index.php?error=signup_failed");
            exit();
        }

        header("location: ../sign.php?success=signup");
        exit();
    }
}

?>
