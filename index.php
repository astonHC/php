<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----STYLE SHEET----->

    <link rel="stylesheet" href="css/style.css">

    <!----NOT SURE IF THIS IS THE CORRECT WAY TO IMPORT FONTS----->
    <!----USING ARCH FOR THIS PORTFOLIO----->

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>

    <title>Harry Clark - CS1_IAD Port 3</title>
</head>
<body>

    <!----BASE FUNCTIONALITY FOR THE NAVBAR----->

	<main-header>
        <h1>AProject</h1>
        <nav>
            <ul class="NAVBAR">
                <li><a href="index.php">HOME</a></li>
                <li><a href="about.php">ABOUT US</a></li>
                <li><a href="login.php">LOG IN</a></li>
            </ul>
        </nav>
	</main-header>

    <main>

    <h1>Sign Up!</h1>

    <?php if(isset($_POST['submitted'])): ?>
        <p><?php require_once('sign_con.php'); ?></p>
    <?php endif; ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="off">
    <div class="INPUT-BOX">
        <input type="text" name="username" placeholder="Username" required> 
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="submitted">Sign Up</button>
    </div>
</form>

</main>

</body>
</html>
