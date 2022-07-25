<link rel="stylesheet" href="../assets/css/profile.css">

<div class="profile">
    <div class="profile_top">
        <?php
            if(strlen($showProfileUser->profilePicturePath) > 0){
                echo '<img class="profile_picture" id="profile_picture" src="..'.$showProfileUser->profilePicturePath.'">';
            } else {
                echo '<img class="profile_picture" id="profile_picture" src="../assets/img/logo.png">';
            }
        ?>
        <div class="info">
            <h1 class="tag"><?= $showProfileUser->tag ?></span></h1>
            <h2 class="joined"><i class="fa-solid fa-calendar-days"></i> Joined <?= $showProfileUser->joinedFormated() ?></h2>
            <div class="follow">
                <h2><span class="amount"><?= count($showProfileUser->following) ?></span> Following</h2>
                <h2><span class="amount"><?= count($showProfileUser->followers) ?></span> Followers</h2>
            </div>
        </div>
    </div>

    <div class="center_items">
        <div>
            <label for="about_me">ABOUT ME</label>
            <p class="about_me" name="about_me"><?= str_replace("\'", "'", str_replace("\n", "<br>", $showProfileUser->aboutMe)) ?></p>
        </div>
    </div>
</div>