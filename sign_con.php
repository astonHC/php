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

    // CONSTRUCT THE CONTROLLER TYPE TO DISCERN BETWEEN THE VARIOUS INPUT METHODS
    // THIS IS JUST TO INSTANTIATE THEM

    public function __construct($fields)
    {
        $this->uid = isset($fields['uid']) ? $fields['uid'] : null;
        $this->email = isset($fields['email']) ? $fields['email'] : null;
        $this->email_retype = isset($fields['email_retype']) ? $fields['email_retype'] : null;
    }
    
    // TENARY OPERTOR THAT RETURNS THE TRUE OR FALSE OUTPUT OF WHETHER
    // THE CORRESPONDENCE FOR THE INPUT FIELD HAVE BEEN MET 

    private function EMPTY_INPUT()
    {
        $RESULT = (empty($this->$uid) || empty($this->$email) || empty($this->$email_retype)) ? true : false;
        return $RESULT;
    }

    private function INVALID_INPUT($INPUT)
    {
        // CREATE A MAP FOR THE VARIABLE DIRECTLY
        // THINK OF IT AS THOUGH WE ARE MAPPING CHARS TO THE VARIABLES
        // TO BE ABLE TO DISCEERN THROUGH DIFFERENT TYPES

        $INPUT_TYPES = 
        [
            'uid' => $this->uid,
            'email' => $this->email,
            'email_retype' => $this->email_retype
        ];

        switch($INPUT)
        {
            case 'uid':
                return !preg_match("/^[a-zA-Z0-9]*$/", $this->uid) ? false : true;
            break;

            case 'email':
                return !preg_match("/^[a-zA-Z0-9]*$/", $this->email) ? false : true;
            break;

            case 'email_retype':
                return !preg_match("/^[a-zA-Z0-9]*$/", $this->email_retype) ? false : true;
            break;

            default:
                throw new Exception("Invalid Variable Type");
        }
    }

    
}

?>
