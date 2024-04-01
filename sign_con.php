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
    private static $uid;
    private static $email;
    private static $email_retype;

    public function __construct($fields)
    {
        $this->uid = isset($fields['uid']) ? $fields['uid'] : null;
        $this->email = isset($fields['email']) ? $fields['email'] : null;
        $this->email_retype = isset($fields['email_retype']) ? $fields['email_retype'] : null;
    }
}

?>