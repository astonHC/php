<?php


// COPYRIGHT (C) HARRY CLARK 2024

// STUDENT NO. 230315257

// CS1_IAD PORTFOLIO 3

// THIS FILE PERTAINS TOWARDS THE FUNCTIONALITY SURROUNDING THE 
// SECURITY MEASURES THRUSTED UPON THIS WEBSITE

// WITH ADHERANCE TOWARDS THE REQUIREMENTS OF THE BRIEF TO ENSURE THAT
// THE INFRASTRUCTURE IS MAINTAINABLE

class Security
{
    private static $TOKEN;
    private static $HASH_TOKEN;
    private static $HASH_EXEC = 5;

    // GENERATE AN ARBITRAY CSRF TOKEN AND STORE IN WITHIN
    // THE RELEVANT SESSION ID

    // THIS IS GOVERNED BY GENERATING A RANDOM TOKEN FROM A
    // RANDOM ASSORTMENT OF NUMBERS GOVERNED BY A BIT FLAG, MANTISSA AND EXPONENT (IEEE 754)

    public static function GENERATE_CSRF()
    {
        try
        {
            if(!isset($_SESSION['csrf_token']))
            {
                self::$TOKEN = bin2hex(random_bytes(32));
                self::$HASH_TOKEN = self::GENERATE_HASH();
                $_SESSION['csrf_token'] = self::$HASH_TOKEN;
            }

            return $_SESSION['csrf_token'];
        }

        catch(Exception $E)
        {
            error_log("CSRF Token Generation Failed: " . $E->getMessage());
            return null;
        }
    }

    // GENERATE THE PROVIDED HASHED TOKEN WITH AN ARBITRARY CONTEXT

    private function GENERATE_HASH($CONTEXT='')
    {
        try
        {
            return bin2hex(random_bytes(32));
        }

        catch(Exception $E)
        {
            throw new HashException("Could not generate Hash for this given CSRF token" . $E->getMessage());
        }
    }

    // VALIDATE THE PROVIDED CSRF TOKEN AGAINST THE HASHED TOKEN STORED IN THE SESSION
    // IN TURN, THIS WILL OBFUSCATE THE REQUEST

    public static function VALIDATE_CSRF($TOKEN)
    {
        try 
        {
            if (isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token)) 
            {
                unset($_SESSION['csrf_token']);
                return true;
            }

            return false;
        } 
        catch (Exception $E) 
        {
            error_log("CSRF token validation failed: " . $E->getMessage());
            return false;
        }
    }
}

// FOR THE SOLE PURPOSE OF BEING ABLE TO GOVERN MY OWN FUNCTIONALITY
// ESEPCIALLY WHEN IT COMES TO HANDLING SECURITY, I WROTE MY OWN
// HASH HANDLER EXCEPTION TO CONSTITUTE AS THE EXCEPTION METHOD FOR THIS USE CASE

class HashException extends Exception
{
    public function __construct($MESSAGE = "", $ARGS = 0, Throwable $TERM = null)
    {
        parent::__construct($MESSAGE, $ARGS, $TERM);
    }

    public function __toString()
    {
        return __CLASS__ . ": { [{$this->ARGS}]: {$this->MESSAGE}\n";
    }
}

?>