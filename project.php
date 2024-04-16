<!DOCTYPE html>
<html>
<head>
    <title>Add Project</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
    <link rel="stylesheet" href="css/project.css">
</head>
<body>
    <h2>Add New Project</h2>
    <form action="project_proc.php" method="POST">
        <label for="project_name">Project Name:</label>
        <input type="text" id="project_name" name="project_name" required><br><br>
        
        <label for="project_description">Project Description:</label><br>
        <textarea id="project_description" name="project_description" rows="4" cols="50" required></textarea><br><br>

        <label for="uid">User ID:</label>
        <input type="number" id="uid" name="uid" required><br><br>
        
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required><br><br>
        
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required><br><br>
        
        <label for="phase">Phase:</label>
        <select id="phase" name="phase" required>
            <option value="design">Design</option>
            <option value="development">Development</option>
            <option value="testing">Testing</option>
            <option value="deployment">Deployment</option>
            <option value="complete">Complete</option>
        </select><br><br>
        <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>"><br><br>
        
        <input type="submit" value="Add Project">
    </form>
</body>
</html>
