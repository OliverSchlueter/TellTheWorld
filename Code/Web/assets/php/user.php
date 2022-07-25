<?php

class User{
    var $tag;
    var $email;
    var $nickname;
    var $birthdate;
    var $aboutMe;
    var $profilePicturePath;
    var $joined;
    var $passwordHash;
    var $followers;
    var $following;

    public function __construct($tag, $email, $nickname, $birthdate, $aboutMe, $profilePicturePath, $joined, $passwordHash, $db) {
        $this->tag = $tag;
        $this->email = $email;
        $this->nickname = $nickname;
        $this->birthdate = $birthdate;
        $this->aboutMe = $aboutMe;
        $this->profilePicturePath = str_replace("#", "%23", $profilePicturePath);
        $this->joined = $joined;
        $this->passwordHash = $passwordHash;
        $this->followers = [];
        $this->following = [];

        // add following users and followers
        foreach($db->query("SELECT * FROM user_follows_user WHERE user_tag='$tag'") as $row){
            array_push($following, $row['follower_tag']);
        }

        foreach($db->query("SELECT * FROM user_follows_user WHERE follower_tag='$tag'") as $row){
            array_push($followers, $row['user_tag']);
        }
    }

    
}

?>