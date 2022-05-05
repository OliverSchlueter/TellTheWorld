function scroll_down(){
    window.scrollBy({
        top: document.getElementById("header").scrollHeight + 1, 
        behavior: 'smooth'
    });
}