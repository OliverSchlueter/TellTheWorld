var sidebar_hidden = false;

function scroll_down(){
    window.scrollBy({
        top: document.getElementById("header").scrollHeight + 1, 
        behavior: 'smooth'
    });
}

function hide_sidebar(){
    var sidebar = document.getElementById("sidebar");
    var hideArrows = document.getElementById("hide_arrows");

    if(sidebar_hidden){
        sidebar.classList.remove("hidden")
        sidebar_hidden = false
    } else {
        sidebar.classList.add("hidden")
        hideArrows.style.transform = "rotate(180deg)"
        sidebar_hidden = true
    }
}