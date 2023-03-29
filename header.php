<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Login System</title>
    <link rel="stylesheet" href="./style.css" type="text/css">
</head>
<body>
    <nav>
        <ul>
            <a href="index.php"><li><img src="" alt="D4E's Logo"></li></a>
            <li><input type="search" name=""></li>
            <?php if(!isset($_SESSION['usersId'])) : ?>
                <a href="signup.php"><li>Sign Up</li></a>
                <a href="login.php"><li>Login</li></a>
            <?php else: ?>
                <a href="./controllers/Users.php?q=logout"><li>Logout</li></a>
                <a href="upload.php"><li>Upload</li></a>
            <?php endif; ?>
            <li>
                <select name="language">
                    <option value="fr">Français</option>
                    <option value="en">English</option>
                    <option value="bg">&#1073;&#1098;&#1083;&#1075;&#1072;&#1088;&#1091;&#1089;&#1082;&#1072;</option>
                </select>
            </li>
        </ul>
    </nav>
    <nav class="categories">
        <ul>
            <a href=""><li>Video Editing</li></a>
            <a href=""><li>3D</li></a>
            <a href=""><li>Graphic Design</li></a>
            <a href=""><li>About Us</li></a>
        </ul>
    </nav>