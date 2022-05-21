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
    <a href="../" class="back_to_main_page_btn"><i class="fa-solid fa-house"></i></a>
    <header>
        <main>
            <form action="" method="post" class="center_self">
                <h1>Login now</h1>
                    <div class="form_item">
                        <label for="login_nickname">NICKNAME*</label>
                        <input type="text" name="login_nickname" placeholder="i_am_oliver" required>
                    </div>
                    <div class="form_item">
                        <label for="login_password">PASSWORD*</label>
                        <input type="password" name="login_password" minlength="8" maxlength="512" placeholder="secure_password" required>
                    </div>
                    <div class="form_item login_extras">
                        <div>
                            <input type="checkbox" name="login_remember_me" value="a">
                            <label for="login_remember_me" class="label_checkbox">Remember me</label>
                        </div>
                        <a href="reset-password" class="forgot_password">Reset password</a>
                    </div>
                    <div class="center_items">
                        <input type="submit" value="LOG IN">
                    </div>
            </form>
        </main>
    </header>
</body>
</html>