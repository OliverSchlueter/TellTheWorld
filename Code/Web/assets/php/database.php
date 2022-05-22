<?php
    // this is not cool!
    // TODO: setup composer
    require "libs/MongoDB/Client.php";
    require "libs/MongoDB/Database.php";
    require "libs/MongoDB/Collection.php";
    require "libs/MongoDB/Operation/Executable.php";
    require "libs/MongoDB/Operation/ListDatabases.php";
    require "libs/MongoDB/Model/BSONArray.php";
    require "libs/MongoDB/Model/BSONDocument.php";
    require "libs/MongoDB/Operation/InsertOne.php";
    require "libs/MongoDB/InsertOneResult.php";
    require "libs/MongoDB/Operation/Explainable.php";
    require "libs/MongoDB/Operation/Find.php";
    require "libs/MongoDB/functions.php";
    require "libs/MongoDB/Model/DatabaseInfoIterator.php";
    require "libs/MongoDB/Model/DatabaseInfoLegacyIterator.php";
    require "libs/MongoDB/Command/ListDatabases.php";
    

    $mongo = new MongoDB\Client("mongodb://127.0.0.1:27017");

    $users_collection = $mongo->tell_the_world->users;
    $messages_collection = $mongo->tell_the_world->messages;
?>