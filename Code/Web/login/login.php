<?php
    if(isset($_POST["login_submit"])){
        include "../assets/php/database.php";
        include "../assets/php/hash.php";
        include "../assets/php/user.php";

        $email = $_POST['login_email'];
        $password = $_POST['login_password'];
        $passwordHash = hashPasswordv1($password, $email);
        $rememberMe = false;

        if(isset($_POST['login_remember_me'])){
            $rememberMe = true;
        }

        $queryResult = $db->query("SELECT * FROM users WHERE email='$email'")->fetch_assoc();

        if($queryResult){
            
            if($passwordHash == $queryResult['password']){

                session_start();
                $user = new User(
                    $queryResult['tag'],
                    $queryResult['email'],
                    $queryResult['nickname'],
                    $queryResult['birthdate'],
                    $queryResult['about_me'],
                    $queryResult['profile_picture'],
                    $queryResult['joined'],
                    $queryResult['password'],
                    $db
                );

                $_SESSION['logged_in'] = true;
                $_SESSION['user'] = $user;

                if($rememberMe){
                    $_SESSION['rememberMe'] = true;
                    // TODO: set cookie
                }

                //echo "<script>window.open('../web/');</script>";

                echo "<script>var nickname = '".$queryResult['nickname']."';</script>";
                include "success.html";
                exit();

            } else {
                echo "<script>var errorMsg = 'Incorrect password';</script>";
                include "fail.html";
                exit();
            }

        } else {
            echo "<script>var errorMsg = 'Incorrect E-Mail';</script>";
            include "fail.html";
            exit();
        }

    } else {
        //echo "<script>window.open('index.html');</script>";

        echo "<script>var errorMsg = 'Please go back to login page';</script>";
        include "fail.html";
    }

?>