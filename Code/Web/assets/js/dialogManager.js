function showDialog(dialogId){
    var dialog = document.getElementById(dialogId);
    dialog.style.display = "block";
}

function hideDialog(dialogId){
    var dialog = document.getElementById(dialogId);
    dialog.style.display = "none";
}

function showSnackbar(text){
    var snackbar = document.createElement("div");
    snackbar.classList.add("snackbar");
    var snackbarText = document.createElement("p");
    snackbarText.innerText = text;
    snackbar.appendChild(snackbarText);

    document.body.appendChild(snackbar);

    snackbar.classList.add("show");

    setTimeout(() => snackbar.remove(), 3500);
}