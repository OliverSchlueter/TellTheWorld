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

        $emailRes = $users_collection->find(["email" => $email])->toArray();

        if(count($emailRes) == 1){
            
            if($passwordHash == $emailRes[0]['password']){

                session_start();
                $user = new User(
                    $emailRes[0]['tag'],
                    $emailRes[0]['email'],
                    $emailRes[0]['nickname'],
                    $emailRes[0]['birthdate'],
                    $emailRes[0]['about_me'],
                    $emailRes[0]['profile_picture'],
                    $emailRes[0]['joined'],
                    $emailRes[0]['password'],
                    $emailRes[0]['followers'],
                    $emailRes[0]['following'],
                );

                $_SESSION['logged_in'] = true;
                $_SESSION['user'] = $user;

                if($rememberMe){
                    $_SESSION['rememberMe'] = true;
                    // TODO: set cookie
                }

                echo "<script>window.open('../web/');</script>";

                echo "<script>var nickname = '".$emailRes[0]['nickname']."';</script>";
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
        echo "<script>window.open('index.html');</script>";

        echo "<script>var errorMsg = 'Please go back to login page';</script>";
        include "fail.html";
    }

?>