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
            <?php
            require_once('database.php');
            
            $database = Database::GET_INSTANCE();
            $db = $database->DB;
            $sql = "SELECT * FROM projects";
            $stmt = $db->prepare($sql);
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
    </div>

</body>
</html>
