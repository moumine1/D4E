<?php

    require_once '../models/Video.php';
    require_once '../helpers/session_helper.php';

    class Videos {

        private $videoModel;
        
        public function __construct(){
            $this->videoModel = new Video;
        }

        public function upload(){
            //Process form
            
            //Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $link = explode("=",trim($_POST['videosLink']));
            //Init data
            $data = [
                'videosTitle' => trim($_POST['videosTitle']),
                'videosLink' => $link[1],
                'videosResume' => trim($_POST['videosResume']),
                'videosTag' => trim($_POST['videosTag']),
                'videosThumbnail' => file_get_contents($_FILES['videosThumbnail']['tmp_name']),
                'videosUploader' => $_SESSION['usersId'],
            ];
            /* right code
            $imageContent = file_get_contents($_FILES['videosThumbnail']['tmp_name']);
            $imageBase64 = base64_encode($imageContent);
            echo '<img src="data:image/png;base64,'.$imageBase64.'">';
            die();*/
            //die(var_dump($link));
            if(empty($data['videosTitle']) || empty($data['videosLink'])
             || empty($data['videosResume']) || empty($data['videosTag'])
              || empty($data['videosThumbnail'])){
                flash("upload", "Please fill out all inputs");
                redirect("../upload.php");
            }
            if($this->videoModel->upload($data)){
                redirect("../index.php");
            }else{
                die("Something went wrong");
            }
    }
}
    $init = new Videos;

    //Ensure that user is sending a post request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        switch($_POST['type']){
            case 'upload':
                $init->upload();
                break;
            /*case 'login':
                $init->login();
                break;*/
            default:
            redirect("../index.php");
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
