<?php

// COPYRIGHT (C) HARRY CLARK 2024

// STUDENT NO. 230315257

// CS1_IAD PORTFOLIO 3

// THIS FILE PERTAINS TOWARDS THE LOGIC OF ACCESSING AND COMMUNICATING
// WITH A LOCALLY DISTRIBUTED DATABASE USING PHPMA

require_once '../config.php';


class Database
{
    private $HOST = DB_HOST;
    private $DB_NAME = DB_NAME;
    private $USERNAME = DB_USER;
    private $PASSWORD = DB_PASSWORD;

    private static $_INSTANCE = null;

    private $_PDO, $_QUERY, $_ERROR = false, $_RESULTS, $_COUNT = 0;

    public function __construct()
    {
        try
        {
            $this->_PDO = new PDO("mysql:host=$this->HOST;dbname=$this->DB_NAME;charset=utf8", $this->USERNAME, $this->PASSWORD);

        }

        catch(PDOException $E)
        {
            die($E->getMessage());
        }
    }

    public static function GET_INSTANCE()
    {
        if(!isset(self::$_INSTANCE))
        {
            self::$_INSTANCE = new Database();
        }

        return self::$_INSTANCE;
    }

    public function GET_QUERY($SQL, $PARAM = array())
    {
        if($this->$_QUERY = $this->_PDO->prepare($SQL))
        {
            $INSTANTIATE = 1;

            if(COUNT($PARAM))
            {
                foreach($PARAM as $P)
                {
                    $this->_QUERY->bindValue($INSTANTIATE, $P);
                    $INSTANTIATE++;
                }
            }

            if($this->_QUERY->execute())
            {
                $this->_RESULTS = $this->_QUERY->fetchAll(PDO::FETCH_OBJ);
                $this->_COUNT = $this->_QUERY->rowCount();
            }

            else
            {
                $this->_ERROR = true;
            }
        }

        return $this;
    }

    
}


?>