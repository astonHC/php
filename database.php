<?php

// COPYRIGHT (C) HARRY CLARK 2024

// STUDENT NO. 230315257

// CS1_IAD PORTFOLIO 3

// THIS FILE PERTAINS TOWARDS THE LOGIC OF ACCESSING AND COMMUNICATING
// WITH A LOCALLY DISTRIBUTED DATABASE USING PHPMA

require_once('config.php');

class Database 
{
    private static $_INSTANCE = null;
    public $DB;

    private function __construct() 
    {
        try 
        {
            $this->DB = new PDO("mysql:dbname=" . Config::DB_NAME . ";host=" . Config::DB_HOST, Config::DB_USER, Config::DB_PASSWORD);
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        catch (PDOException $E) 
        {
            echo("An error occurred while connecting to the database.<br>");
            echo($E->getMessage());
            exit;
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
        $QUERY = $this->DB->prepare($SQL);
        $INSTANTIATE = 1;

        if(COUNT($PARAM))
        {
            foreach($PARAM as $P)
            {
                $QUERY->bindValue($INSTANTIATE, $P);
                $INSTANTIATE++;
            }
        }

        if($QUERY->execute())
        {
            $RESULTS = $QUERY->fetchAll(PDO::FETCH_OBJ);
            $COUNT = $QUERY->rowCount();
        }

        else
        {
            $ERROR = true;
        }

        return $this;
    }
}

$database = Database::GET_INSTANCE();
$DB = $database->DB;

?>
