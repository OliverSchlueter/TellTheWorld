<?php

    include "../assets/php/database.php";
    include "../assets/php/user.php";

    session_start();

    $responseCodeCreated = 201;
    $responseCodeBadRequest = 400;
    
    header('Content-type: application/json');
    
    // Check if request is POST
    if($_SERVER['REQUEST_METHOD'] != "POST"){
        http_response_code($responseCodeBadRequest);
        echo json_encode([
            "status" => "fail",
            "error" => "Please use POST request method"
        ]);
        exit();
    }

    if(!isset($_POST['action'])){
        http_response_code($responseCodeBadRequest);
        echo json_encode([
            "status" => "fail",
            "error" => "Please provide an action"
        ]);
        exit();
    }

    $action = $_POST['action'];

    if(!isset($_SESSION['user'])){
        http_response_code($responseCodeBadRequest);
        echo json_encode([
            "status" => "fail",
            "error" => "User is currently not logged in"
        ]);
        exit();
    }

    $currentUser = $_SESSION['user'];

    switch ($action) {
        case 'new_message':
            
            if(!isset($_POST['timestamp']) || !isset($_POST['content'])){
                http_response_code($responseCodeBadRequest);
                echo json_encode([
                    "status" => "fail",
                    "error" => "Please provide all needed fields"
                ]);
                exit();
            }
            
            $timeSent = $_POST['timestamp'];
            $content = $_POST['content'];
            $senderTag = $currentUser->tag;
            $id = hash("sha256", $timeSent . "" . $senderTag . "" . $content);

            $query = $db->query("INSERT INTO messages(id, time_sent, sender_tag, content, amount_likes, amount_comments) VALUES('$id', ".intval($timeSent).", '$senderTag', '$content', 0, 0)");
            
            if(!$query){
                http_response_code($responseCodeBadRequest);
                echo json_encode([
                    "status" => "fail",
                    "error" => "Could not insert into database"
                ]);
                exit();
            }

            $msg = new Message(
                $id,
                $timeSent,
                $senderTag,
                $content,
                0,
                0
            );

            array_push($currentUser->messages, $msg);

            http_response_code($responseCodeCreated);

            echo json_encode([
                "status" => "success",
                "message_id" => $id
            ]);

            break;
        
        case 'like_message':
            if(!isset($_POST['timestamp']) || !isset($_POST['message_id'])){
                http_response_code($responseCodeBadRequest);
                echo json_encode([
                    "status" => "fail",
                    "error" => "Please provide all needed fields"
                ]);
            }

                $message_id = $_POST['message_id'];
                $timestamp = $_POST['timestamp'];

                $query = $db->query("INSERT INTO user_likes_message VALUES('".$currentUser->tag."', '$message_id', '$timestamp')");

                if(!$query){
                    http_response_code($responseCodeBadRequest);
                    echo json_encode([
                        "status" => "fail",
                        "error" => "Could not insert into database"
                    ]);
                    exit();
                }

                // update amount_likes field in messages table
                // TODO: repalce by creating a sql trigger
                $query = $db->query("UPDATE messages SET amount_likes=CAST((SELECT amount_likes FROM messages WHERE id='$message_id') AS INT)+1 WHERE id='$message_id'");
                
                if(!$query){
                    http_response_code($responseCodeBadRequest);
                    echo json_encode([
                        "status" => "fail",
                        "error" => "Could not update in database"
                    ]);
                    exit();
                }

                http_response_code($responseCodeCreated);

                echo json_encode([
                    "status" => "success"
                ]);
            
            break;

        case 'remove_like':
            echo json_encode([
                "status" => "fail",
                "error" => "Not implemented"
            ]);
            exit();
            break;

        case 'comment_message':
            echo json_encode([
                "status" => "fail",
                "error" => "Not implemented"
            ]);
            exit();
            break;

        case 'delete_message':
            echo json_encode([
                "status" => "fail",
                "error" => "Not implemented"
            ]);
            exit();
            break;
        default:
            echo json_encode([
                "status" => "fail",
                "error" => "Unknown action"
            ]);
            exit();
            break;
    }
    
?>