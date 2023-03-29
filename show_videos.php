<?php
    //require_once '../models/Video.php';
    //require_once '../helpers/session_helper.php';
    include_once './libraries/Database.php';
    //include_once './controllers/Videos.php';

        $db = new Database;

        $db->query('SELECT * FROM videos');
        $row = $db->resultSet();
        //var_dump($row);
        printf('<h2>Videos</h2>');
        printf('<ul class="allvideo">');
        foreach ($row as $video) {
            printf('    <li>');
            $imageBase64 = base64_encode($video->thumbnail);
            printf("        <a href='watch.php?v=$video->id_videos'>");
            printf("            <img src='data:image/jpg;base64,".$imageBase64."' alt='$video->title'/>");
            printf("        <h3>$video->title</h3>");
            printf("        </a>");
            printf('    </li>');
        }
        printf('</ul>');
?>
            