<?php

    if(isset($_POST["register_submit"])){
        include "../assets/php/database.php";
        include "../assets/php/hash.php";
        include "../assets/php/user.php";

        $nickname = str_replace("'", "\'", $_POST["register_nickname"]);
        $email = $_POST["register_email"];
        $bday = $_POST["register_bday"];
        $password = str_replace("'", "\'", $_POST["register_password"]);
        $joined = time();
        $discord = "";
        $aboutMe = "";
        $hasProfilePicture = false;

        $errorMsg = "";

        if(isset($_POST["register_discord"])){
            $discord = $_POST["register_discord"];
        }

        if(isset($_POST["register_about_me"])){
            $aboutMe = str_replace("'", "\'", $_POST["register_about_me"]);
        }

        if(isset($_FILES["register_profile_picture"]) && $_FILES["register_profile_picture"]["size"] > 0){
            $hasProfilePicture = true;
        }

        $queryResult = $db->query("SELECT * FROM users WHERE email='$email'")->fetch_assoc();
        if($queryResult){
            echo "<script>var errorMsg = 'This E-Mail is already registered';</script>";
            include "fail.html";
            exit();
        }

        $nicknameResult = $db->query("SELECT * FROM users WHERE email='$email'");

        $tagID = "";
        $foundID = false;
        $timeout = 1000;
        do {
            if($timeout <= 0){
                echo "<script>var errorMsg = 'Please choose a different nickname';</script>";
                include "fail.html";
                exit();
                break;
            }

            $tagID = "".random_int(0, 9).random_int(0, 9).random_int(0, 9).random_int(0, 9).random_int(0, 9);
            
            foreach($nicknameResult as $n){
                $id = explode("#", $n["tag"], 2)[0];
                if($id == $tagID){
                    $timeout--;
                    break;
                }
            }

            $foundID = true;

        } while (!$foundID);

        $tag = $nickname."#".$tagID;

        $password = hashPasswordv1($password, $email);
        

        // pp = profile picture
        $pp = $_FILES["register_profile_picture"];
        $ppSizeMB = $pp["size"]/1024/1024;
        $ppType = $pp["type"]; 

        // TODO: check if correct type and size

        $profilePicturePath = ($hasProfilePicture ? "/data/profile_pictures/$tag.jpg" : "");

        // move file to /data/profile_pictures/<tag>.jpg
        move_uploaded_file($pp['tmp_name'], "../data/profile_pictures/$tag.jpg");
        
        $insertNewUser = $db->query("INSERT INTO users(tag, password, joined, nickname, email, birthdate, about_me, profile_picture) VALUES('$tag', '$password', $joined, '$nickname', '$email', '$bday', '$aboutMe', '$profilePicturePath')");
        
        if(!$insertNewUser){
            echo "<script>var errorMsg = 'Could not perform register process, please try again';</script>";
            include "fail.html";
            die();
        }

        echo "<script>
            var nickname = '$nickname';
            var tag = '$tag';
        </script>";

        include "success.html";

        session_start();
        $user = new User($tag, $email, $nickname, $bday, $aboutMe, $profilePicturePath, $joined, $password, $db);
        $_SESSION['logged_in'] = true;
        $_SESSION['user'] = $user;

    } else {
        //echo "<script>window.open('index.html');</script>";

        echo "<script>var errorMsg = 'Please go back to register page';</script>";
        include "fail.html";
    }

?>