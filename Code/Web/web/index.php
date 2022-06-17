<?php 
        include "../assets/php/database.php";
        include "../assets/php/hash.php";
        include "../assets/php/user.php";

        session_start();
        $logged_in = isset($_SESSION['logged_in']) ? $_SESSION['logged_in'] : false;
        $mode = $logged_in ? "home" : "explore";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/dialog.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/web.css">
    <script src="https://kit.fontawesome.com/690661ce23.js" crossorigin="anonymous"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/dialogManager.js"></script>
    <title>Tell The World</title>
</head>
<body>
    <div class="bg"></div>

    <div class="dialog-container" id="writeDialog">
        <dialog open>
            <img class="hideBtn" onclick="hideDialog('writeDialog')" src="https://upload.wikimedia.org/wikipedia/commons/a/a0/OOjs_UI_icon_close.svg">
            <h1>Tell the world!</h1>
            <textarea id="writeText"></textarea>
            <button id="writeSend">SEND</button>
            <button id="writePreview">PREVIEW</button>
        </dialog>
    </div>

    <section class="side_section" id="left_section">
        <ul>
            <li><img class="profile_picture" src="https://st3.depositphotos.com/6672868/13701/v/600/depositphotos_137014128-stock-illustration-user-profile-icon.jpg"></li>
            <li><a href="../"><i class="fa-solid fa-house"></i>Home</a></li>
            <li><a href=""><i class="fa-solid fa-magnifying-glass"></i>Explore</a></li>
            <?php 
                if($logged_in){
                    echo '<li><a href=""><i class="fa-solid fa-user"></i>My Profile</a></li>
                          <li><a href=""><i class="fa-solid fa-bell"></i>Notifications</a></li>
                          <li><a href=""><i class="fa-solid fa-gear"></i>Settings</a></li>';
                }
            ?>
            <a id="write"><li class="write">Write</li></a>
        </ul>
    </section>

    <main>
        <div id="header">
            <h1>Latest Posts</h1>
        </div>
        <div id="messages">
            <!-- AUTO GENERATE MESSAGES -->
            <div class="message">
                <div class="dialog-container" id="msg1">
                    <dialog open>
                        <img class="hideBtn" onclick="hideDialog('msg1')" src="https://upload.wikimedia.org/wikipedia/commons/a/a0/OOjs_UI_icon_close.svg">
                        <h1>Message by @i_am_oliver</h1>
                        <hr>
                        <p class="content">
                            <span class="hashtag">TellTheWorld</span> beta is starting SOON!<br>
                            Get a beta account now at <span class="link">TellThe.world</span> and be in the beta team to help us improve the platform!<br>
                        </p>
                    </dialog>
                </div>

                <img class="profile_picture" src="https://st3.depositphotos.com/6672868/13701/v/600/depositphotos_137014128-stock-illustration-user-profile-icon.jpg">
                <div class="message_header">
                    <p class="author">i_am_oliver</p>
                    <p class="time">12min</p>
                    <p class="more" onclick="showDialog('msg1')"></p>
                </div>
                <p class="content">
                    <span class="hashtag">TellTheWorld</span> beta is starting SOON!<br>
                    Get a beta account now at <span class="link">TellThe.world</span> and be in the beta team to help us improve the platform!<br>
                </p>
                <div class="message_footer">
                    <p class="likes">
                        <i class="fa-solid fa-heart fa-xs"></i>
                        123
                    </p>
                    <p class="comments">
                        <i class="fa-solid fa-message fa-xs"></i>
                        123
                    </p>
                    <p class="reposts">
                        <i class="fa-solid fa-rotate fa-xs"></i>
                        123
                    </p>
                    <p class="share">
                        <i class="fa-solid fa-share-from-square fa-xs"></i>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <section class="side_section" id="right_section">
        <form action="" method="post">
            <!-- TODO: auto generate -->
            <datalist id="search_history">
                <option value="@i_am_oliver">
                <option value="#TellTheWorld">
                <option value="Beta account">
            </datalist>
            <input type="search" name="search_input" placeholder="Search for users or hashtags" list="search_history">
        </form>
    </section>

    <script src="../assets/js/web.js"></script>
</body>
</html>