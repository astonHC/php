<?php

// COPYRIGHT (C) HARRY CLARK 2024

// STUDENT NO. 230315257

// CS1_IAD PORTFOLIO 3

// THIS FILE PERTAINS TOWARDS THE MAIN FUNCTIONALITY SURROUNDING THE ENCOMPASSING
// LOGIC OF THE LOGIN PAGE

// THIS WILL TAKE INTO ACCOUNT OF WHICH USERS ARE CURRENTLY WITHIN THE DATABASE
// IN ASSOCIATION WITH THEIR DESIGNATED TAG

require_once('config.php');

class Login
{
    private $USER;
    private $EMAIL;
    private $PWD;
    private $DB;

    public function __construct($USER, $EMAIL, $PWD, $DB) 
    {
        $this->USER = $USER;
        $this->EMAIL = $EMAIL;
        $this->PWD = $PWD;
        $this->DB = $DB;
    }

    protected function CHECK_USER() 
    {
        $SQL = "SELECT * FROM users WHERE (username = ? OR email = ?)";
        $CONNECT_READY = $this->DB->prepare($SQL);
        $CONNECT_READY->execute([$this->USER, $this->EMAIL]);
        $RESULT = $CONNECT_READY->fetch(PDO::FETCH_ASSOC);

        return $RESULT ? $RESULT : false;
    }

    public function LOGIN() 
    {
        if (!$this->USER || !$this->PWD) 
        {
            return "Invalid input";
        }

        $user = $this->CHECK_USER();

        if ($user && password_verify($this->PWD, $user['password'])) 
        {
            header("Location: welcome.php?username=" . urlencode($user['username'])); 
            exit();
        } 
        else 
        {
            echo "<script>document.querySelector('form').classList.add('wrong-credentials');</script>";
            return "No user with those credentials exist\n";
        }
    }
}

if (isset($_POST['submitted'])) 
{
    require_once('database.php');

    $USERNAME = isset($_POST['username']) ? $_POST['username'] : false;
    $EMAIL = isset($_POST['email']) ? $_POST['email'] : false;
    $PASSWORD = isset($_POST['password']) ? $_POST['password'] : false;

    $LOG = new Login($USERNAME, $EMAIL, $PASSWORD, $DB);
    echo $LOG->LOGIN();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="post" class="wrong-credentials">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" placeholder="Username" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" placeholder="Email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" placeholder="Password" required><br>
        <input type="hidden" name="submitted" value="1">
        <input type="submit" value="Login">
    </form>
</body>
</html>

