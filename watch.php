<?php
    include_once 'header.php';
    include_once './libraries/Database.php';
    include_once './models/Rating.php';

    if(isset($_GET['v'])){
    $id = $_GET['v'];
    $db = new Database;

    $db->query('SELECT * FROM videos WHERE id_videos=:id');
    $db->bind(':id', $id);
    $video = $db->single();
    //var_dump($video);
    printf('<h1>'.$video->title.'</h1>');
    printf('<iframe src="https://www.youtube.com/embed/'.$video->link.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>');
    $rating = new Rating($id);
    //die(var_dump($rating));
    printf('<h1>'.$rating->__construct($id).'/5</h1>');
    //flash('comment');
    printf('<form action="./controllers/Comments.php" method="post">');
    printf('    <input type="hidden" name="type" value="comment">');
    printf('    <input type="hidden" name="commentsVideo" value="'.$_GET["v"].'">');
    printf('    <input type="text" name="commentsText" placeholder="Add a comment...">');
    printf('    <label for="commentsRating">Rating</label>');
    printf('    <input type="range" name="commentsRating" min="-1" max="5">');
    printf('    <button type="submit">Add a comment</button>');
    printf('</form>');
    include_once 'show_comments.php';
    }
    else{
        redirect('index.php');
    }
    include_once 'footer.php';
?>