let emojis = new Map();
emojis.set(":beers:", "🍻");
emojis.set(":joy:", "😂");
emojis.set(":grinning:", "😀");
emojis.set(":neutral:", "😐");
emojis.set(":sleeping:", "😴");
emojis.set(":money:", "🤑");
emojis.set(":angry:", "😠");
emojis.set(":pig:", "🐖");


function generateMessage(msg) {
    const messagesElement = document.getElementById("messages");

    var getIcon = function(iconName){
        var icon = document.createElement("i");
        iconName.split(" ").forEach((c) => icon.classList.add(c));
        return icon;
    };

    var getP = function(name, content, parent){
        var p = document.createElement("p");
        p.classList.add(name);
        p.innerHTML = content;
        parent.appendChild(p);
        return p;
    };

    var getFooterItem = function(name, amount, icon, parent){
        var fi = document.createElement("p");
        fi.classList.add(name);
        var txt = document.createTextNode(" " + amount + " ");
        fi.appendChild(txt);
        fi.insertBefore(getIcon(icon), txt);
        parent.appendChild(fi);
    }

    var getHr = function(parent) {
        parent.appendChild(document.createElement("hr"));
    };

    const formattedMessage = updatePreviewText(msg.content);

    // TODO: set id to message
    var message = document.createElement("div");
    message.classList.add("message");

    var dialogContainer = document.createElement("div");
    dialogContainer.id = msg.id;
    dialogContainer.classList.add("dialog-container");

    var dialog = document.createElement("dialog");
    dialog.open = true;

    var hideImg = document.createElement("img");
    hideImg.classList.add("hideBtn");
    hideImg.src = "https://upload.wikimedia.org/wikipedia/commons/a/a0/OOjs_UI_icon_close.svg";
    hideImg.onclick = () => hideDialog(msg.id);
    dialog.appendChild(hideImg);

    var msgH1 = document.createElement("h1");
    msgH1.innerText = "Message by @" + msg.author;
    dialog.appendChild(msgH1);

    getHr(dialog);
    getP("content", formattedMessage, dialog);
    getHr(dialog);

    var reportBtn = document.createElement("button");
    reportBtn.textContent = "REPORT";
    reportBtn.onclick = () => showSnackbar("This feature is currently disabled");
    dialog.appendChild(reportBtn);


    dialogContainer.appendChild(dialog);
    message.appendChild(dialogContainer);

    var profilePicture = document.createElement("img");
    profilePicture.classList.add("profile_picture");
    profilePicture.src = "https://st3.depositphotos.com/6672868/13701/v/600/depositphotos_137014128-stock-illustration-user-profile-icon.jpg";
    message.appendChild(profilePicture);

    const formatTime = (t) => {
        const current = Date.now();
        const millis = current - t;

        var seconds = Math.floor(millis / 1000);

        var minutes = 0, hours = 0, days = 0, weeks = 0, months = 0, years = 0;

        while(seconds >= 60){
            minutes++;
            seconds -= 60;
        }

        while(minutes >= 60){
            hours++;
            minutes -= 60;
        }

        while(hours >= 24){
            days++;
            hours -= 24;
        }

        while(days >= 7){
            weeks++;
            days -= 7;
        }

        while(weeks >= 4){
            months++;
            weeks -= 4;
        }

        while(months >= 12){
            years++;
            months -= 12;
        }

        var result = "";
        
        if(years > 0){
            result = years + " years";
        }

        if(months > 0){
            result = months + " months";
        }

        if(weeks > 0){
            result = weeks + " weeks";
        }

        if(days > 0){
            result = days + " days";
        }

        if(hours > 0){
            result = hours + " hours";
        }

        if(minutes > 0){
            result = minutes + " minutes";
        }

        return result + " ago";
    }

    var messageHeader = document.createElement("div");
    messageHeader.classList.add("message_header");

        getP("author", msg.author, messageHeader);
        getP("time", formatTime(msg.time), messageHeader);

        var more = document.createElement("p");
        more.classList.add("more");
        more.onclick = () => showDialog(msg.id);
        messageHeader.appendChild(more);

    message.appendChild(messageHeader);

    getP("content", formattedMessage, message);

    var messageFooter = document.createElement("div");
    messageFooter.classList.add("message_footer");

        getFooterItem("likes", msg.likes, "fa-solid fa-heart fa-xs", messageFooter);
        getFooterItem("comments", msg.comments, "fa-solid fa-message fa-xs", messageFooter);
        getFooterItem("reposts", msg.reposts, "fa-solid fa-rotate fa-xs", messageFooter);

        var share = document.createElement("p");
        share.classList.add("share");
        share.appendChild(getIcon("fa-solid fa-share-from-square fa-xs"));
        messageFooter.appendChild(share);

    message.appendChild(messageFooter);

    messagesElement.insertBefore(message, messagesElement.firstChild);
}

document.getElementById("write").addEventListener("click", function(){
    showDialog("writeDialog");
});

document.getElementById("writeText").oninput = function(e){
    if(document.getElementById("preview_container") != null){
        updatePreviewText(document.getElementById("writeText").value);
    }
};

document.getElementById("writePreview").onclick = function(e){
    var writeText = document.getElementById("writeText");

    if(document.getElementById("preview_container") != null){
        document.getElementById("preview_container").remove();
        document.getElementById("preview_label").remove();
        return;
    }

    var preview = document.createElement("div");
    preview.id = "preview_container";
    preview.classList.add("preview_container");

    var previewP = document.createElement("p");
    preview.appendChild(previewP);

    document.getElementById("writeDialog").firstElementChild.insertBefore(preview, document.getElementById("writePreview"));

    var previewLabel = document.createElement("label");
    previewLabel.id = "preview_label";
    previewLabel.setAttribute("for", "preview_container");
    previewLabel.textContent = "PREVIEW";
    document.getElementById("writeDialog").firstElementChild.insertBefore(previewLabel, preview);

    updatePreviewText(writeText.value);
};

// Also returns formatted text
function updatePreviewText(text){
    var words = text.split(/[\n\s]+/);
    var newText = text;

    words.forEach(w => {
        if(w.startsWith("#")){
            newText = newText.replace(w, "<span class='hashtag'>" + w.substring(1) + "</span>");
        } else if(w.startsWith("@")){
            newText = newText.replace(w, "<span class='mention'>" + w.substring(1) + "</span>");
        } else if(w.startsWith("https://")){
            newText = newText.replace(w, "<a  href='" + w + "'><span class='link'>" + w.substring(8) + "</span></a>");
        }
    });

    newText = newText.replaceAll("\n", "<br>");

    emojis.forEach((v, k) => {
        newText = newText.replaceAll(k, v);
    });

    if(document.getElementById("preview_container") == null){
        return newText;
    }

    var preview = document.getElementById("preview_container").firstChild;
    preview.innerHTML = newText;

    return newText;
}

document.getElementById("writeSend").onclick = function(e){
    
    var writeText = document.getElementById("writeText");

    if(writeText.value == ""){
        hideDialog("writeDialog");
        return;
    }

    generateMessage({
        id: "msg2",
        author: "Oliver",
        time: "now",
        content: writeText.value,
        likes: 0,
        comments: 0,
        reposts: 0
    });

    message_data = {
        "action": "new_message",
        "timestamp": Date.now().toString(),  
        "content": writeText.value
    }

    httpRequest("POSt", "messageEndpoint.php", message_data)

    hideDialog("writeDialog");

    writeText.value = "";

    updatePreviewText();
}

document.getElementById("writeClear").onclick = function(e){
    document.getElementById("writeText").value = "";
    updatePreviewText("");
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