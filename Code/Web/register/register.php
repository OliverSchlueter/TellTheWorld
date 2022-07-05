<?php

    if(isset($_POST["register_submit"])){
        include "../assets/php/database.php";
        include "../assets/php/hash.php";
        include "../assets/php/user.php";

        $nickname = $_POST["register_nickname"];
        $email = $_POST["register_email"];
        $bday = $_POST["register_bday"];
        $password = $_POST["register_password"];
        $joined = time();
        $discord = "";
        $aboutMe = "";
        $hasProfilePicture = false;

        $errorMsg = "";

        if(isset($_POST["register_discord"])){
            $discord = $_POST["register_discord"];
        }

        if(isset($_POST["register_about_me"])){
            $aboutMe = $_POST["register_about_me"];
        }

        if(isset($_FILES["register_profile_picture"])){
            $hasProfilePicture = true;
        }

        $emailRes = $users_collection->find(["email" => $email])->toArray();
        if(count($emailRes) > 0){
            echo "<script>var errorMsg = 'This E-Mail is already registered';</script>";
            include "fail.html";
            exit();
        }

        $nicknameRes = $users_collection->find(["nickname" => $nickname])->toArray();

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
            
            foreach($nicknameRes as $n){
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
        
        $users_collection->insertOne([
            "tag" => $tag,
            "about_me" => $aboutMe,
            "birthdate" => $bday,
            "email" => $email,
            "followers" => [],
            "following" => [],
            "joined" => $joined,
            "nickname" => $nickname,
            "profile_picture" => $profilePicturePath,
            "password" => $password
        ]);
        
        echo "<script>
            var nickname = '$nickname';
            var tag = '$tag';
        </script>";

        include "success.html";

        session_start();
        $user = new User($tag, $email, $nickname, $bday, $aboutMe, $profilePicturePath, $joined, $password, [], []);
        $_SESSION['logged_in'] = true;
        $_SESSION['user'] = $user;

    } else {
        //echo "<script>window.open('index.html');</script>";

        echo "<script>var errorMsg = 'Please go back to register page';</script>";
        include "fail.html";
    }

?>