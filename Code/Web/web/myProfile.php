<link rel="stylesheet" href="../assets/css/myProfile.css">

<div class="my_profile_container">
    <?php
        if(strlen($currentUser->profilePicturePath) > 0){
            echo '<img class="profile_picture center_self" id="profile_picture" src="..'.$currentUser->profilePicturePath.'">';
        } else {
            echo '<img class="profile_picture center_self" id="profile_picture" src="../assets/img/logo.png">';
        }
    ?>
    
    <h1><?= $currentUser->tag ?></span></h1>
    <h2 class="joined"><i class="fa-solid fa-calendar-days"></i> Joined <?= $currentUser->joinedFormated() ?></h2>
    <div class="follow">
        <h2><span class="amount"><?= count($currentUser->following) ?></span> Following</h2>
        <h2><span class="amount"><?= count($currentUser->followers) ?></span> Followers</h2>
    </div>
</div>