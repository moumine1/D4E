<?php
require_once '../libraries/Database.php';

class Comment {

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }



    public function findCommentById($id)
    {
        $this->db->query('SELECT * FROM comments WHERE id_comments');
        $this->db->bind(':username', $id);

        $row = $this->db->single();

        //Check row
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function findCommentByChronologicalOrder()
    {
        $this->db->query('SELECT * FROM comments ORDER BY date_time LIMIT 10');

        $rows = $this->db->resultSet();

        if($this->db->rowCount() > 0){
            return $rows;
        }else{
            return false;
        }
    }

    public function comment($data){
        
        $this->db->query('INSERT INTO comments (text, rating, id_users, id_videos) 
        VALUES (:text, :rating, :id_users, :id_videos)');
        //Bind values
        $this->db->bind(':text', $data['commentsText']);
        $this->db->bind(':rating', $data['commentsRating']);
        $this->db->bind(':id_users', $data['commentsAuthor']);
        $this->db->bind(':id_videos', $data['commentsVideo']);

        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

}