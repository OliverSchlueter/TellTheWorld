const messagesElement = document.getElementById("messages");

function generateMessage(msg) {

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

    // TODO: set id to message
    var message = document.createElement("div");
    message.classList.add("message");

    var profilePicture = document.createElement("img");
    profilePicture.classList.add("profile_picture");
    profilePicture.src = "https://st3.depositphotos.com/6672868/13701/v/600/depositphotos_137014128-stock-illustration-user-profile-icon.jpg";
    message.appendChild(profilePicture);

    var messageHeader = document.createElement("div");
    messageHeader.classList.add("message_header");

        getP("author", msg.author, messageHeader);
        getP("time", msg.time, messageHeader);

        var more = document.createElement("p");
        more.classList.add("more");
        messageHeader.appendChild(more);

    message.appendChild(messageHeader);

    var contentStr = msg.content;
    contentStr = contentStr.replaceAll("\n", " <br> ");
    var contentWords = contentStr.split(" ");
    contentWords.forEach(w => {
        if(w.startsWith("#")){
            contentStr = contentStr.replace(w, "<span class='hashtag'>" + w.substring(1) + "</span>");
        } else if(w.startsWith("@")){
            contentStr = contentStr.replace(w, "<span class='mention'>" + w.substring(1) + "</span>");
        }
    });

    getP("content", contentStr, message); //TODO: add support for hashtags, links and line-breaks

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
    /*generateMessage({
        author: "Oliver",
        time: "5min",
        content: "Hello world, I'm Oliver.\n#FreiBier",
        likes: 420,
        comments: 69,
        reposts: 42
    });*/

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

    document.getElementById("writeDialog").firstElementChild.insertBefore(preview, document.getElementById("writeSend"));

    var previewLabel = document.createElement("label");
    previewLabel.id = "preview_label";
    previewLabel.setAttribute("for", "preview_container");
    previewLabel.textContent = "PREVIEW";
    document.getElementById("writeDialog").firstElementChild.insertBefore(previewLabel, preview);

    updatePreviewText(writeText.value);
};

function updatePreviewText(text){

    if(document.getElementById("preview_container") == null){
        return;
    }

    var preview = document.getElementById("preview_container").firstChild;

    var words = text.split(/[\n\s]+/);
    var newText = text;

    words.forEach(w => {
        if(w.startsWith("#")){
            newText = newText.replace(w, "<span class='hashtag'>" + w.substring(1) + "</span>");
        }
    });

    newText = newText.replaceAll("\n", "<br>");

    preview.innerHTML = newText;
}

document.getElementById("writeSend").onclick = function(e){
    
    var writeText = document.getElementById("writeText");

    if(writeText.value == ""){
        hideDialog("writeDialog");
        return;
    }

    generateMessage({
        author: "Oliver",
        time: "now",
        content: writeText.value,
        likes: 0,
        comments: 0,
        reposts: 0
    });

    hideDialog("writeDialog");

    writeText.value = "";

    updatePreviewText();
}