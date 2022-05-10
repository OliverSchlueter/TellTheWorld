<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="https://kit.fontawesome.com/690661ce23.js" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>
    <title>Tell The World</title>
</head>
<body>

    <div id="sidebar" class="hidden">
        <i id="hide_arrows" class="hidden fa-solid fa-angles-left" onclick="hide_sidebar()"></i>
        <p class="headline">Navigation</p>
        <ul>
            <li><a onclick="scroll_top()">Overview</a></li>
            <li><a onclick="scroll_to('about_section')">About TTW</a></li>
            <li><a onclick="scroll_to('values_section')">Our values</a></li>
            <li><a onclick="scroll_to('api_section')">How to - API</a></li>
            <hr>
            <li><a href="login/">Login</a></li>
            <li><a href="register/">Register</a></li>
            <li><a href="web/">Start now</a></li>
            <li><a href="share/">Share</a></li>
        </ul>
    </div>

    <header id="header">
        <h1 id="headline">TELL THE WORLD</h1>
        <h1 id="subline">Share your thoughts</h1>
        <div class="center_items">
            <button><i class="fa-solid fa-user fa-xs"></i> LOGIN</button>
            <button><i class="fa-solid fa-user-plus fa-xs"></i> REGISTER</button>
            <button><i class="fa-solid fa-circle-play fa-xs"></i> START</button>
            <button><i class="fa-solid fa-share-from-square fa-xs"></i> SHARE</button>
        </div>
        <p class="scroll_down" onclick="scroll_down()">&#5167;</p>
    </header>

    <section id="about_section">
        <h1>About TellTheWorld</h1>
        <p class="block_text center_text">
            TellTheWorld ist a short message service developed by Oliver Schlüter in his freetime.<br>
            Here you can share your thoughts with the world, like and comment other messages. You can also follow other people and send them private messages.
        </p>
    </section>

    <section id="values_section" class="highlight">
        <h1>Our values</h1>
        <p class="block_text center_text">
            Wir legen sehr viel Wert auf Datensicherheit und Vertraulichkeit. Daher sind alle Algorithmen open source und öffentlich einsehbar.
        </p>
    </section>

    <section id="api_section">
        <h1>How to - API</h1>
        <p class="block_text">
            Du bist Entwickler und möchtest coole Projekte mit der TellTheWorld-Platform schaffen? Nutze doch gerne unsere API! Eine Dokumentation findest du hier: [link]
        </p>
    </section>

</body>
</html>