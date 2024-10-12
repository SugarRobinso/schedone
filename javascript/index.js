const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');
const errorLoginDiv = document.getElementById('credential-error');
const errorRegisterDiv = document.getElementById('register-credential-error')
const passwordRegisterInput = document.getElementById('register-psw');
let passwordCheck = false;


loginForm.addEventListener('submit', function(e){

    let mail = document.getElementById('login-mail').value;
    let psw = document.getElementById('login-psw').value;
    
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(!mail){
        createErroreMessage('Insert mail!');
        e.preventDefault();
        return;
    }
    if(!emailPattern.test(mail)){
        createErroreMessage('Insert valid mail');
        e.preventDefault();
        return;
    }
    

    if(!psw){
        createErroreMessage('Insert password!');
        e.preventDefault();
        return;
    }


});

registerForm.addEventListener('submit', function(e){


    let username = document.getElementById('register-username').value;
    let mail = document.getElementById('register-mail').value;
    let psw = document.getElementById('register-psw').value;
    
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(!mail || !psw || !username){
        errorRegisterDiv.innerHTML = "<p> Complete all fields </p>"; 
        e.preventDefault();
        return;
    }
    if(!emailPattern.test(mail)){
        errorRegisterDiv.innerHTML = "<p> Insert valid mail </p>";
        e.preventDefault();
        return;
    }
    if(!passwordCheck){
        errorRegisterDiv.innerHTML = "<p> Insert valid password </p>";
        e.preventDefault();
        return;
    }
    if(username.length > 16){
        errorRegisterDiv.innerHTML = "<p> Username too long </p>";
        e.preventDefault();
        return;
    }
    

});

passwordRegisterInput.addEventListener('input', function(){

    const password = passwordRegisterInput.value;
    const uppercaseParagraphCheck = document.getElementById('uppercase-check');
    const numberParagraphCheck = document.getElementById('number-check');
    const specialCharParagraphCheck = document.getElementById('character-check');

    const hasUppercase = /[A-Z]/.test(password);
    if(hasUppercase){
        uppercaseParagraphCheck.style.color = 'red';
    }
    else{
        uppercaseParagraphCheck.style.color = 'black';
    }

    const hasNumber = /\d/.test(password);
    if(hasNumber){
        numberParagraphCheck.style.color = 'red';
    }
    else{
        numberParagraphCheck.style.color = 'black';
    }

    const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
    if(hasSpecialChar){
        specialCharParagraphCheck.style.color = 'red';
    }
    else{
        specialCharParagraphCheck.style.color = 'black';
    }

    if(hasSpecialChar && hasNumber && hasUppercase){
        passwordCheck = true;
    }
    else{
        passwordCheck = false;
    }

    


});



function createErroreMessage(message){

    errorLoginDiv.innerHTML = '<p> ' + message + '</p>';

}

