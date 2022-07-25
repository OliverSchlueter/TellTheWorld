<?php
    $db = @new mysqli('localhost', 'root', '', 'telltheworld');
    $connectedToDatabase = false;
    
    if($db->connect_error) {
        $connectedToDatabase = false;
    } else {
        $connectedToDatabase = true;
    }
?>