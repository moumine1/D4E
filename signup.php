<?php 
    include_once 'header.php';
    include_once './helpers/session_helper.php';
?>

    <h1 class="header">Please Signup</h1>

    <?php flash('register') ?>

    <form method="post" action="./controllers/Users.php">
        <input type="hidden" name="type" value="register">
        <input type="text" name="usersUsername" placeholder="Username...">
        <input type="text" name="usersName" placeholder="Name...">      
        <input type="text" name="usersLastName" placeholder="Last Name...">
        <input type="text" name="usersEmail" placeholder="Email...">  
        <input type="password" name="usersPwd" placeholder="Password...">
        <input type="password" name="pwdRepeat" placeholder="Repeat password">
        <label for="userRatVid">Your level in Video Editing:</label>
        <input type="radio" name="usersRatVid" value="0" checked>
        <input type="radio" name="usersRatVid" value="1">
        <input type="radio" name="usersRatVid" value="2">
        <input type="radio" name="usersRatVid" value="3">
        <input type="radio" name="usersRatVid" value="4">
        <input type="radio" name="usersRatVid" value="5">
        <label for="userRat3D">Your level in 3D modeling:</label>
        <input type="radio" name="usersRat3D" value="0" checked>
        <input type="radio" name="usersRat3D" value="1">
        <input type="radio" name="usersRat3D" value="2">
        <input type="radio" name="usersRat3D" value="3">
        <input type="radio" name="usersRat3D" value="4">
        <input type="radio" name="usersRat3D" value="5">
        <label for="userRat3D">Your level in Graphic Design:</label>
        <input type="radio" name="usersRatDesign" value="0" checked>
        <input type="radio" name="usersRatDesign" value="1">
        <input type="radio" name="usersRatDesign" value="2">
        <input type="radio" name="usersRatDesign" value="3">
        <input type="radio" name="usersRatDesign" value="4">
        <input type="radio" name="usersRatDesign" value="5">
        <button type="submit" name="submit">Sign Up</button>
    </form>
    
<?php 
    include_once 'footer.php'
?>