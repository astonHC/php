<!DOCTYPE html>
<html>
<head>
    <title>Welcome Page</title>
    <link rel="stylesheet" href="css/welcome.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
</head>
<body>
    <div class="WELCOME">
        <?php
        if (isset($_GET['username'])) 
        {
            echo "<h2>Welcome, " . htmlspecialchars($_GET['username']) . "!</h2>";
        }
        ?>
    </div>

    <div class="CARD-WRAPPER">
        <div class="CARD-CONTAINER">

            <!--THIS PHP IS REALLY FRAGILE-->
            <!--I TRIED TO ADHERE TO THE CONSISTENCY OF MAKING THIS PROJECT OOP-->
            <!--YET IT BREAKS WHENEVER I MAKE IT SUCH-->

            <?php
            require_once('database.php');
            
            $username = $_GET['username'];
            $database = Database::GET_INSTANCE();
            $db = $database->DB;

            $sql = "SELECT uid FROM users WHERE username = :username";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $user_id = $user['uid'];

            $sql = "SELECT * FROM projects WHERE uid = :uid";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':uid', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($projects as $project) 
            {
                echo '<input type="radio" name="slide" id="c'.$project['pid'].'">';
                echo '<label for="c'.$project['pid'].'" class="CARD" id="CARD_'.$project['pid'].'">';
                echo '<div class="row">';
                echo '<div class="icon">'.$project['pid'].'</div>';
                echo '<div class="description">';
                echo '<h4>'.$project['title'].'</h4>';
                echo '<p>'.$project['description'].'</p>';
                echo '</div>';
                echo '</div>';
                echo '</label>';
            }
            ?>
        </div>
    </div>

    <div class="project-container">
        <a href="project.php" class="add-project-btn">Add Project</a>
        <a href="logout.php" class="sign-out-btn">Sign Out</a>
        <a href="remove.php" class="remove-project-btn">Remove Project</a>
    </div>
</body>
</html>
