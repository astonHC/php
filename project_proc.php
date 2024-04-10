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

        // CHECK IF THE USER HAS ALREADY CREATED 5 PROJECTS

        if($this->COUNT_USER_PROJECTS($this->UID) >= 5)
        {
            $this->REDIRECT();
            return "Project creation limit reached: A user can only create a maximum of 5 projects";
        }

        // INJECT THE SQL QUERY FROM THE WEBSITE INTO THE DATABASE AND
        // EXECUTE THE QUERY TO ADD THE CORRESPONDENCE

        $SQL = "INSERT INTO projects (title, description, uid, start_date, end_date, phase) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->DB->prepare($SQL);
        $stmt->execute([$this->TITLE, $this->DESC, $this->UID, $this->START, $this->END, $this->PROJECT_TYPE]);

        if($stmt->rowCount() > 0)
        {
            $this->REDIRECT();
            return "Project added successfully";
        } 

        else 
        {
            return "Failed to add project: An error occurred while inserting data";
        }
    }

    // THESE FOLLOWING FUNCTIONS, WHILE LOOKING SIMILAR FROM THE OFFSET
    // HOUSEE VERY DIFFERENT FUNCTIONALITY

    // ONE DETERMINE IF THE USER EXISTS IN RELATION TO THEIR RESPECTIVE ID
    // SUCH IS THE CASE WITH LOGGING IN

    // WHEREAS ONE IS JUST A SIMPLE QUERY TO DISCERN WHO IS LOGGED IN
    // SUCH THAT THE USER GETS REDIRECTED TO THEIR PAGE

    private function GET_USERNAME() 
    {
        $SQL = "SELECT username FROM users WHERE uid = ?";
        $stmt = $this->DB->prepare($SQL);
        $stmt->execute([$this->UID]);
        $RESULT = $stmt->fetch(PDO::FETCH_ASSOC);
        return $RESULT['username'] ?? '';
    }

    private function USER_EXISTS($UID)
    {
        $SQL = "SELECT * FROM users WHERE uid = ?";
        $stmt = $this->DB->prepare($SQL);
        $stmt->execute([$UID]);
        $RESULT = $stmt->fetch(PDO::FETCH_ASSOC);
        return $RESULT ? true : false;
    }

    private function COUNT_USER_PROJECTS($UID)
    {
        $SQL = "SELECT COUNT(*) as count FROM projects WHERE uid = ?";
        $stmt = $this->DB->prepare($SQL);
        $stmt->execute([$UID]);
        $RESULT = $stmt->fetch(PDO::FETCH_ASSOC);
        return $RESULT['count'] ?? 0;
    }

    // ENCAPSULATE THAT SCUFFED CHECKER INSIDE OF IT'S OWN FUNCTION FOR THE 
    // SAKE OF BEING NEAT AND TIDY (MUCH TO THE CONTARY OF THIS FUNCTION)

    public function REDIRECT()
    {
        echo '<script>
            setTimeout(function() 
            {
                window.location.href = "welcome.php?username=' . urlencode($this->GET_USERNAME()) . '";
            }, 2000);
        </script>';
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
