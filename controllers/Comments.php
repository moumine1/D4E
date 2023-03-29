<?php

    require_once '../models/Comment.php';
    require_once '../helpers/session_helper.php';

    class Comments {

        private $commentModel;
        
        public function __construct(){
            $this->commentModel = new Comment;
        }

        public function comment(){
            //Process form
            
            //Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Init data
            $data = [
                'commentsText' => trim($_POST['commentsText']),
                'commentsRating' => trim($_POST['commentsRating']),
                'commentsVideo' => trim($_POST['commentsVideo']),
                'commentsAuthor' => $_SESSION['usersId'],
            ];
            //die(var_dump($data['commentsAuthor']));
            if(empty($data['commentsText'])){
                flash("comment", "Please write a comment.");
                redirect("../watch.php?v=".$data['commentsVideo']);
            }
            if(empty($data['commentsVideo'])){
                flash("comment", "Sorry, we did not find the video you want to comment.");
                redirect("../index.php");
            }
            if(empty($data['commentsAuthor'])){
                flash("comment", "Please log in before post a comment.");
                redirect("../watch.php?v=".$data['commentsVideo']);
            }
            if($this->commentModel->comment($data)){
                redirect("../watch.php?v=".$data['commentsVideo']);
            }else{
                die("Something went wrong");
            }
    }
}
    $init = new Comments;

    //Ensure that user is sending a post request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        switch($_POST['type']){
            case 'comment':
                $init->comment();
                break;
            /*case 'login':
                $init->login();
                break;*/
            default:
            redirect("../watch.php?v=".$data['commentsVideo']);
        }
        
    }/*else{
        switch($_GET['q']){
            case 'logout':
                $init->logout();
                break;
            default:
            redirect("../index.php");
        }
    }*/
