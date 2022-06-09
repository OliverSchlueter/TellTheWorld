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

    public function __construct($tag, $email, $nickname, $birthdate, $aboutMe, $profilePicturePath, $joined, $passwordHash, $followers, $following) {
        $this->tag = $tag;
        $this->email = $email;
        $this->nickname = $birthdate;
        $this->birthdate = $tag;
        $this->aboutMe = $aboutMe;
        $this->profilePicturePath = $profilePicturePath;
        $this->joined = $joined;
        $this->passwordHash = $passwordHash;
        $this->followers = $followers;
        $this->following = $following;
    }

    
}

?>