<?php
require_once './libraries/Database.php';

class Rating {

    private $db;
    public $weightedAverage;
    
    public function __construct($video)
    {
        $rating = [];
        $factor =[];
        $totalRatings = 0; 
        $totalFactors = 0;

        $this->db = new Database;
        $this->db->query('SELECT * FROM comments WHERE id_videos=:id');
        $this->db->bind(':id', $video);
        $comments = $this->db->resultSet();

        $this->db->query('SELECT video_tag FROM videos WHERE id_videos=:id');
        $this->db->bind(':id', $video);
        $category = $this->db->single();
        

        foreach($comments as $comment){
            //die(var_dump($category->video_tag));
            $this->db->query('SELECT '.$category->video_tag.' FROM users WHERE id_users=:id_user');
            $this->db->bind(':id_user', $comment->id_users);
            $val = $this->db->single();
            //die(var_dump($val->$category->video_tag));
            array_push($rating, $comment->rating);
            array_push($factor, array_values(json_decode(json_encode($val), true))[0]);
        }
        /*die(var_dump($factor));

        var_dump($rating);
        printf('<br>');
        var_dump($factor);*/
        for ($i=0; $i < count($rating) ; $i++) { 
            $totalRatings += $rating[$i] * $factor[$i];
            $totalFactors += $factor[$i];
        }

        $weightedAverage = $totalRatings / $totalFactors;

        return $weightedAverage;

    }

}