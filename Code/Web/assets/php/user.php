<?php

class Message{
    var $id;
    var $timeSent;
    var $senderTag;
    var $content;
    var $amountLikes;
    var $amountComments;
    var $likes;
    var $comments;

    public function __construct($id, $timeSent, $senderTag, $content, $amountLikes, $amountComments){
        $this->id = $id;
        $this->timeSent = $timeSent;
        $this->senderTag = $senderTag;
        $this->content = $content;
        $this->amountLikes = $amountLikes;
        $this->amountComments = $amountComments;
        $this->likes = [];
        $this->comments = [];
    }

    public function loadLikes(){
        //TODO: load likes from db
    }

    public function loadComments(){
        //TODO: load comments from db
    }
}

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
    var $messages;

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
        $this->messages = [];

        foreach($db->query("SELECT * FROM user_follows_user WHERE user_tag='$tag'") as $row){
            array_push($this->following, $row['follower_tag']);
        }

        foreach($db->query("SELECT * FROM user_follows_user WHERE follower_tag='$tag'") as $row){
            array_push($this->followers, $row['user_tag']);
        }

        foreach($db->query("SELECT * FROM messages WHERE sender_tag='$tag' ORDER BY time_sent LIMIT 20") as $row){
            $msg = new Message(
                $row['id'],
                $row['time_sent'],
                $row['sender_tag'],
                $row['content'],
                $row['amount_likes'],
                $row['amount_comments'],
            );

            array_push($this->messages, $msg);
        }
    }

    public function joinedFormated() {
        return date("d M Y", $this->joined);
    }

    public static function loadUserFromDB($db, $tag){
        $query = $db->query("SELECT * FROM users WHERE tag='$tag'")->fetch_assoc();
        
        if(!$query) return null;

        return new User(
            $query['tag'],
            $query['email'],
            $query['nickname'],
            $query['birthdate'],
            $query['about_me'],
            $query['profile_picture'],
            $query['joined'],
            $query['password'],
            $db
        );
    }

    
}

?>