<?php
require_once '../libraries/Database.php';

class Video {

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }



    public function findVideoById($id)
    {
        $this->db->query('SELECT * FROM videos WHERE videosVId');
        $this->db->bind(':username', $id);

        $row = $this->db->single();

        //Check row
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function findVideoByChronologicalOrder()
    {
        $this->db->query('SELECT * FROM videos ORDER BY videosDate LIMIT 10');

        $rows = $this->db->resultSet();

        if($this->db->rowCount() > 0){
            return $rows;
        }else{
            return false;
        }
    }

    public function findVideoByTitle($request)
    {
        $part = explode(" ", $request);
        for($i=0; $i<count($part); $i++){
            $this->db->query('SELECT * FROM videos WHERE videosTitle="'.$part[$i].'"');
            $rows = $this->db->resultSet();
        }

        if($this->db->rowCount() > 0){
            return $rows;
        }else{
            return false;
        }
    }

    public function upload($data){
        
        $this->db->query('INSERT INTO videos (title, link, resume, video_tag, thumbnail, id_users) 
        VALUES (:title, :link, :resume, :video_tag, :thumbnail, :id_users)');
        //Bind values
        $this->db->bind(':title', $data['videosTitle']);
        $this->db->bind(':link', $data['videosLink']);
        $this->db->bind(':resume', $data['videosResume']);
        $this->db->bind(':video_tag', $data['videosTag']);
        $this->db->bind(':thumbnail', $data['videosThumbnail']);
        $this->db->bind(':id_users', $data['videosUploader']);

        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

}