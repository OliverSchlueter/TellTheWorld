<?php

    if(isset($_POST["register_submit"])){
        include "../assets/php/database.php";
        include "../assets/php/hash.php";

        $nickname = $_POST["register_nickname"];
        $email = $_POST["register_email"];
        $discord = $_POST["register_discord"];
        $bday = $_POST["register_bday"];
        $aboutMe = $_POST["register_about_me"];
        $password = $_POST["register_password"];

        $emailRes = $users_collection->find(["email" => $email])->toArray();
        if(count($emailRes) > 0){
            echo "email is already taken";
            exit();
        }

        $nicknameRes = $users_collection->find(["nickname" => $nickname])->toArray();

        $tagID = "";
        $foundID = false;
        $timeout = 1000;
        do {
            if($timeout <= 0){
                echo "Please choose a different nickname.";
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

        // move file to /data/profile_pictures/<tag>.jpg
        move_uploaded_file($pp['tmp_name'], "../data/profile_pictures/$tag.jpg");

        $users_collection->insertOne([
            "tag" => $tag,
            "about_me" => $aboutMe,
            "birthdate" => $bday,
            "email" => $email,
            "email" => $discord,
            "flollowers" => [],
            "following" => [],
            "joined" => time(),
            "nickname" => $nickname,
            "profile_picture" => "/data/profile_pictures/$tag.jpg",
            "password" => $password
        ]);

        echo "inserted";
    }

?>