<?php

// COPYRIGHT (C) HARRY CLARK 2024

// STUDENT NO. 230315257

// CS1_IAD PORTFOLIO 3

// THIS FILE PERTAINS TOWARDS THE MAIN FUNCTIONALITY SURROUNDING THE ENCOMPASSING
// LOGIC OF THE SIGN UP PAGE

// FOCUSSING ON THE GETTERS AND SETTERS OF THE ATTRIBUTES IN THE INDEX FILE
// TO DISCERN WHICH FIELDS HAVE BEEN FILLED IN

// NESTED INCLUDES

include '../sign_con.php';

class SignUpPage 
{
    private $FIELD;

    public function __construct($FID, $POST_DATA)
    {
        $this->FIELD = [];

        // USE A TENARY OPERATOR INSIDE OF THIS LOOP
        // TO DISCERN IF ANY AND ALL ID'S ARE BEING USED

        foreach ($FID as $var)
        {
            $this->FIELD[$var] = isset($POST_DATA[$var]) ? $POST_DATA[$var] : null;
        }
    }

    public function GET_FORM_ID()
    {
        return $this->FIELD;
    }
}

$FIELD_IDS = ["uid", "email", "email_retype"];
$FORM_FIELDS = new SignUpPage($FIELD_IDS, $_POST);
$FIELD = $FORM_FIELDS->GET_FORM_ID();
$SIGNUP = new SignUpController($FIELD);

?>
