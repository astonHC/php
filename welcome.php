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
                <input type="radio" name="slide" id="c1">
                <label for="c1" class="CARD" id="CARD_1">
                    <div class="row">
                        <div class="icon">1</div>
                        <div class="description">
                            <h4>Project 1</h4>
                            <p>This is a description of Project 1
                            </p>
                        </div>
                    </div>
                </label>
        
                <input type="radio" name="slide" id="c2">
                <label for="c2" class="CARD" id="CARD_2">
                    <div class="row">
                        <div class="icon">2</div>
                        <div class="description">
                            <h4>Project 2</h4>
                            <p>This is a description of Project 2
                            </p>
                        </div>
                    </div>
                </label>
                <input type="radio" name="slide" id="c3">
                <label for="c3" class="CARD" id="CARD_3">
                    <div class="row">
                        <div class="icon">3</div>
                        <div class="description">
                            <h4>Project 3</h4>
                            <p>This is a description of Project 3
                            </p>
                        </div>
                    </div>
                </label>
            </div>
        </div>
        </div>

    <a href="project.php" class="add-project-btn">Add Project</a>
</body>
</html>
