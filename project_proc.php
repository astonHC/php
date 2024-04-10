<?php

// COPYRIGHT (C) HARRY CLARK 2024

// STUDENT NO. 230315257

// CS1_IAD PORTFOLIO 3

// THIS FILE PERTAINS TOWARDS THE PROCESSING OF PROJECTS AND THEIR DETAILS
// AND INSERTING THEM INTO THE DATABASE

require_once('database.php');

class ProjectController
{
    private $TITLE;
    private $DESC;
    private $UID;
    private $START;
    private $END;
    private $PROJECT_TYPE;
    private $DB;

    public function __construct($TITLE, $DESC, $UID, $START, $END, $PROJECT_TYPE, $DB)
    {
        $this->TITLE = $TITLE;
        $this->DESC = $DESC; 
        $this->UID = $UID;
        $this->START = $START;
        $this->END = $END;
        $this->PROJECT_TYPE = $PROJECT_TYPE;
        $this->DB = $DB;
    }

    // ASSERT WHETHER OR NOT THERE IS A LEGIBLE SQL CLAUSE IN THE SQL QUERY
    // THAT CAN ATTRIBUTE TO THE INSERTION OF PROJECTS

    // FROM THERE, EXECUTE THE FOLLOWING QUERY TO ADD THE CORRESPONDENCE IN

    public function ADD_PROJECT()
    {
        if (!$this->TITLE || !$this->DESC || !$this->UID || !$this->START || !$this->END || !$this->PROJECT_TYPE) 
        {
            return "Invalid input: Please provide all required fields";
        }

        // CHECK IF THE CORRESPONDING USER ID EXISTS IN RELATION TO WHO
        // IS CREATING THE PROJECT

        if(!$this->USER_EXISTS($this->UID))
        {
            return "User does not exist: Please provide a valid user ID";
        }

        // INJECT THE SQL QUERY FROM THE WEBSITE INTO THE DATABASE AND
        // EXECUTE THE QUERY TO ADD THE CORRESPONDENCE

        $SQL = "INSERT INTO projects (title, description, uid, start_date, end_date, phase) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->DB->prepare($SQL);
        $stmt->execute([$this->TITLE, $this->DESC, $this->UID, $this->START, $this->END, $this->PROJECT_TYPE]);

        if($stmt->rowCount() > 0)
        {
            $username = isset($_POST['username']) ? urlencode($_POST['username']) : '';
            header("Location: welcome.php?username=$username&project_added=true");
            exit;
        } 
        else 
        {
            return "Failed to add project: An error occurred while inserting data";
        }
    }

    private function USER_EXISTS($UID)
    {
        $SQL = "SELECT * FROM users WHERE uid = ?";
        $stmt = $this->DB->prepare($SQL);
        $stmt->execute([$UID]);
        $RESULT = $stmt->fetch(PDO::FETCH_ASSOC);
        return $RESULT ? true : false;
    }
}

// NOW, ACCESS ALL OF THE REQUIRED METHODS FROM THE SSH CONNECTION

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $TITLE = $_POST['project_name'];
    $DESC = $_POST['project_description'];
    $UID = $_POST['uid'];
    $START = $_POST['start_date'];
    $END = $_POST['end_date'];
    $PROJECT_TYPE = $_POST['phase'];
    
    $DATABASE = Database::GET_INSTANCE();
    $DB_BASE = $DATABASE->DB;

    $PC = new ProjectController($TITLE, $DESC, $UID, $START, $END, $PROJECT_TYPE, $DB);
    echo $PC->ADD_PROJECT();
}

?>
?>
