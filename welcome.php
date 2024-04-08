<!DOCTYPE html>
<html>
<head>
    <title>Welcome Page</title>
</head>
<body>
    <?php
    if (isset($_GET['username'])) 
    {
        echo "<h2>Welcome, " . htmlspecialchars($_GET['username']) . "!</h2>";
    }
    ?>
</body>
</html>
