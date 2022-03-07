function civilityValidation(){
    var civility=document.getElementById('civility-select').value;
    var civilityError = document.getElementById('error-civility');
    if((civility != "Mr") && (civility != "Mme")){
        civilityError.style.display="block";
        civilityError.innerHTML="Veuillez choisir une civilité";
        return "false";
    }
    else{
        civilityError.style.display="none";
        return "true";
    }
}

function mailValidation(){
    var email=document.getElementById('email').value;
    var emailError =  document.getElementById('error-email');
    const pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

    if((!email.match(pattern)) && (email!="")){
        emailError.style.display="block";
        emailError.innerHTML="Email invalide";
        return "false";
    }
    else{
        emailError.style.display="none";
        return "true";
    }
}


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

document.getElementById('registration-form').addEventListener("submit",function(e){
    var errorMail=mailValidation();
    var errorPassword=passwordValidation();
    var errorCivility=civilityValidation();

    if((errorMail != "true" ) || (errorPassword != "true") || (errorCivility != "true")){
        e.preventDefault();
        return false;
    }
});

