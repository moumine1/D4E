<?php 
    include_once 'header.php';
    include_once './helpers/session_helper.php';
    if(!isset($_SESSION['usersId'])){
        redirect('login.php');
    }
?>
    
    <h1 class="header">Upload your video</h1>

    <?php flash('upload') ?>

    <form action="./controllers/Videos.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="type" value="upload">
        <input type="text" name="videosTitle" placeholder="Title...">
        <input type="url" name="videosLink" placeholder="URL of your video...">
        <input type="text" name="videosResume" placeholder="Describe your video or add content...">
        <label for="videosTag">The video is about:</label>
        Video Editing
        <input type="radio" name="videosTag" value="video_editing">
        3D
        <input type="radio" name="videosTag" value="3D">
        Graphic Design
        <input type="radio" name="videosTag" value="graphic_design">
        <input type="file" name="videosThumbnail" accept="image/png, image/jpeg">
        <button type="submit" name="submit">Upload</button>
    </form>
<?php 
    include_once 'footer.php'
?>