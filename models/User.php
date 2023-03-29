<?php
require_once '../libraries/Database.php';

class User {

    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    //Find user by email or username
    public function findUserByEmailOrUsername($email, $username){
        $this->db->query('SELECT * FROM users WHERE username = :username OR mail = :email');
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        //Check row
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    //Register User
    public function register($data){
        
        $this->db->query('INSERT INTO users (username, name, last_name, password, mail, users_rating_vid, users_rating_3D, users_rating_design) 
        VALUES (:username, :name, :last_name, :password, :email, :userRate1, :userRate2, :userRate3)');
        //Bind values
        $this->db->bind(':username', $data['usersUsername']);
        $this->db->bind(':name', $data['usersName']);
        $this->db->bind(':last_name', $data['usersLastName']);
        $this->db->bind(':password', $data['usersPwd']);
        $this->db->bind(':email', $data['usersEmail']);
        $this->db->bind(':userRate1', $data['usersRatVid']);
        $this->db->bind(':userRate2', $data['usersRat3D']);
        $this->db->bind(':userRate3', $data['usersRatDesign']);

        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //Login user
    public function login($nameOrEmail, $password){
        $row = $this->findUserByEmailOrUsername($nameOrEmail, $nameOrEmail);

        if($row == false) return false;

        $hashedPassword = $row->password;
        if(password_verify($password, $hashedPassword)){
            return $row;
        }else{
            return false;
        }
    }

    //Reset Password
    public function resetPassword($newPwdHash, $tokenEmail){
        $this->db->query('UPDATE users SET usersPwd=:pwd WHERE usersEmail=:email');
        $this->db->bind(':pwd', $newPwdHash);
        $this->db->bind(':email', $tokenEmail);

        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}