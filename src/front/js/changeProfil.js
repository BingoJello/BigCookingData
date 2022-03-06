function passwordValidation(){
    var passwordConfirm=document.getElementById('password-confirm').value;
    var passwordConfirmError = document.getElementById('error-password-confirm');

    if ((passwordConfirm != document.getElementById("password").value) && (passwordConfirm !="")) {
        passwordConfirmError.style.display="block";
        passwordConfirmError.innerHTML="Mot de passe incorrect";
        return "false";
    }
    else{
        passwordConfirmError.style.display="none";
        return "true";
    }
}

function enterElement(element){
    error=document.getElementById(element);
    if(error.value!=""){
        error.innerHTML="";
    }
}

document.getElementById('profil-form').addEventListener("submit",function(e){
    if(document.getElementById('password-confirm').disabled==false && document.getElementById('password').disabled==false){
        var errorPassword=passwordValidation();
        if("true" != errorPassword){
            e.preventDefault();
            return false;
        }
    }
});

function passwordBlock(){
    if(document.getElementById('change-password-block').style.display=="block"){
        document.getElementById('change-password-block').style.display="none";
        document.getElementById('modified-password-link').style.color="blue";
        document.getElementById('modified-password-link').innerHTML="editer";
        document.getElementById('password-confirm').disabled=true;
        document.getElementById('password').disabled=true;
    }
    else{
        document.getElementById('change-password-block').style.display="block";
        document.getElementById('modified-password-link').style.color="red";
        document.getElementById('modified-password-link').innerHTML="annuler";
        document.getElementById('password-confirm').disabled=false;
        document.getElementById('password').disabled=false;
    }
}