document.getElementById("register_profile_picture").onchange = function(e) {
    var selectedFile = document.getElementById('register_profile_picture').files[0];
    if(selectedFile.type.startsWith("image")){
        document.getElementById("profile_picture").src = window.URL.createObjectURL(selectedFile);
    }
}

document.getElementById("register_password").addEventListener('input', function (e) {
    const pw = e.target.value;
    const pwChars = pw.split('');

    var feedback = document.getElementById("pasword_feedback");
    
    if(pw.length < 8){
        feedback.innerHTML = "Not long enough";
        return;
    }

    const numberChars = "0123456789".split('');

    var hasUpper, hasLower, hasNumber = false;

    for (let i = 0; i < pwChars.length; i++) {
        const c = pwChars[i];
        
        if(numberChars.includes(c)){
            hasNumber = true;
        } else if(c == c.toLowerCase()){
            hasLower = true;
        } else if(c == c.toUpperCase()){
            hasUpper = true;
        }

    }
    if(!hasLower){
        feedback.innerHTML = "No lowercase letter";
        return;
    }

    if(!hasUpper){
        feedback.innerHTML = "No uppercase letter";
        return;
    }


    if(!hasNumber){
        feedback.innerHTML = "No number";
        return;
    }


    feedback.innerHTML = "Valid password";
});