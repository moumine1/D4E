<?php
    include_once './libraries/Database.php';

        $db = new Database;
        if (isset($_GET['v'])) {
            $video = $_GET['v'];
        }

        $db->query('SELECT * FROM comments WHERE id_videos=:id');
        $db->bind(':id', $video);
        $row = $db->resultSet();
        //var_dump($row);
        printf('<h2>Comments</h2>');
        printf('<ul class="allcomments">');
        foreach ($row as $comment) {
            $db->query('SELECT * FROM users WHERE id_users=:id');
            $db->bind(':id', $comment->id_users);
            $author = $db->single();
            printf('    <li>');
            printf("        <h3>$author->username</h3>");
            printf("        <h3>$comment->rating /5</h3><br/>");
            printf("        <p>");
            printf("            $comment->text");
            printf("        </p>");
            printf('    </li>');
        }
        printf('</ul>');
?>