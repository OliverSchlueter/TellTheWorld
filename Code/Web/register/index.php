<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/register.css">
    <script src="https://kit.fontawesome.com/690661ce23.js" crossorigin="anonymous"></script>
    <script src="../assets/js/main.js"></script>
    <title>Tell The World - Register</title>
</head>
<body>
    <header>
        <main>
            <form action="" method="post" class="center_self">
                <h1>Create an account</h1>
                <div class="center_items">
                    <img id="profile_picture" src="https://st3.depositphotos.com/6672868/13701/v/600/depositphotos_137014128-stock-illustration-user-profile-icon.jpg" alt="">
                    <label for="register_profile_picture" class="custom_file_upload">
                        <i class="fa fa-cloud-upload"></i> Upload
                    </label>
                    <input type="file" name="register_profile_picture" id="register_profile_picture">
                </div>
                <div class="form_item full_width">
                </div>
                <div class="center_items">
                    <div class="form_item">
                        <label for="register_nickname">NICKNAME*</label>
                        <input type="text" name="register_nickname" placeholder="i_am_oliver" required>
                    </div>
                    <div class="form_item">
                        <label for="register_email">E-MAIL*</label>
                        <input type="email" name="register_email" placeholder="oliver@telltheworld.com" required>
                    </div>
                </div>
                <div class="center_items">
                    <div class="form_item">
                        <label for="register_discord">DISCORD</label>
                        <input type="text" name="register_discord" placeholder="oliver#6512">
                    </div>
                    <div class="form_item">
                        <label for="register_bday">BIRTHDAY*</label>
                        <input type="date" name="register_bday" required>
                    </div>
                </div>
                <div class="center_items">
                    <div class="form_item">
                        <label for="register_password">PASSWORD*</label>
                        <input type="password" name="register_password" id="register_password" minlength="8" maxlength="512" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" required>
                    </div>
                    <div class="form_item">
                        <p id="pasword_feedback">Not long enough</p>
                    </div>
                </div>
                <div class="center_items">
                    <input type="submit" value="CREATE NOW">
                </div>
            </form>
        </main>
    </header>
    <script src="../assets/js/register.js"></script>
</body>
</html>