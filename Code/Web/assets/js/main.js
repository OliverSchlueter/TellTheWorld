var sidebar_hidden = false;

function scroll_down(){
    window.scrollBy({
        top: document.getElementById("header").scrollHeight + 1, 
        behavior: 'smooth'
    });
}

function scroll_top() {
    document.getElementById('header').scrollIntoView({block: "start", behavior: "smooth"});
}


function scroll_to(elementName) {
    document.getElementById(elementName).scrollIntoView({block: "start", behavior: "smooth"});
}

function hide_sidebar(){
    var sidebar = document.getElementById("sidebar");
    var hideArrows = document.getElementById("hide_arrows");

    if(sidebar_hidden){
        sidebar.classList.remove("hidden")
        hideArrows.classList.remove("hidden")
        sidebar_hidden = false
    } else {
        sidebar.classList.add("hidden")
        hideArrows.classList.add("hidden")
        sidebar_hidden = true
    }
}

function httpRequest(method, url, data) {
    const requestOptions = {
        method: method,
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    };

    fetch(url, requestOptions);
}