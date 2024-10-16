// Get references to the login and register forms, as well as the error message divs
const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');
const errorLoginDiv = document.getElementById('credential-error');
const errorRegisterDiv = document.getElementById('register-credential-error');
const passwordRegisterInput = document.getElementById('register-psw');
let passwordCheck = false;  // Variable to track if the password meets the validation criteria

// Event listener for login form submission
loginForm.addEventListener('submit', function(e){

    let mail = document.getElementById('login-mail').value;  // Get email value from the input field
    let psw = document.getElementById('login-psw').value;    // Get password value from the input field
    
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;  // Regular expression for validating an email format

    // Check if email is empty
    if(!mail){
        createErroreMessage('Insert mail!');  // Show error message if email is empty
        e.preventDefault();  // Prevent form submission
        return;
    }
    // Check if the email format is valid
    // if(!emailPattern.test(mail)){
    //     createErroreMessage('Insert valid mail');  // Show error if email is not valid
    //     e.preventDefault();  // Prevent form submission
    //     return;
    // }
    
    // Check if password is empty
    if(!psw){
        createErroreMessage('Insert password!');  // Show error if password is empty
        e.preventDefault();  // Prevent form submission
        return;
    }
});

// Event listener for register form submission
registerForm.addEventListener('submit', function(e){

    let username = document.getElementById('register-username').value;  // Get username value from input
    let mail = document.getElementById('register-mail').value;  // Get email value from input
    let psw = document.getElementById('register-psw').value;   // Get password value from input
    
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;  // Regular expression for validating email format

    // Check if all fields are filled
    if(!mail || !psw || !username){
        errorRegisterDiv.innerHTML = "<p> Complete all fields </p>";  // Show error if fields are incomplete
        e.preventDefault();  // Prevent form submission
        return;
    }

    // Check if email format is valid
    if(!emailPattern.test(mail)){
        errorRegisterDiv.innerHTML = "<p> Insert valid mail </p>";  // Show error if email is invalid
        e.preventDefault();  // Prevent form submission
        return;
    }

    // Check if the password passes all validation checks
    if(!passwordCheck){
        errorRegisterDiv.innerHTML = "<p> Insert valid password </p>";  // Show error if password doesn't meet criteria
        e.preventDefault();  // Prevent form submission
        return;
    }

    // Check if username is within allowed length (less than or equal to 16 characters)
    if(username.length > 16){
        errorRegisterDiv.innerHTML = "<p> Username too long </p>";  // Show error if username is too long
        e.preventDefault();  // Prevent form submission
        return;
    }
});

// Event listener to validate password strength in real-time during input
passwordRegisterInput.addEventListener('input', function(){

    const password = passwordRegisterInput.value;  // Get the password entered by the user
    const uppercaseParagraphCheck = document.getElementById('uppercase-check');  // Element for uppercase validation feedback
    const numberParagraphCheck = document.getElementById('number-check');  // Element for number validation feedback
    const specialCharParagraphCheck = document.getElementById('character-check');  // Element for special character validation feedback

    // Check if the password contains an uppercase letter
    const hasUppercase = /[A-Z]/.test(password);
    if(hasUppercase){
        uppercaseParagraphCheck.style.color = 'red';  // Mark as valid with red color
    }
    else{
        uppercaseParagraphCheck.style.color = 'black';  // Mark as invalid with black color
    }

    // Check if the password contains a number
    const hasNumber = /\d/.test(password);
    if(hasNumber){
        numberParagraphCheck.style.color = 'red';  // Mark as valid with red color
    }
    else{
        numberParagraphCheck.style.color = 'black';  // Mark as invalid with black color
    }

    // Check if the password contains a special character
    const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
    if(hasSpecialChar){
        specialCharParagraphCheck.style.color = 'red';  // Mark as valid with red color
    }
    else{
        specialCharParagraphCheck.style.color = 'black';  // Mark as invalid with black color
    }

    // If password contains uppercase, number, and special character, mark passwordCheck as true
    if(hasSpecialChar && hasNumber && hasUppercase){
        passwordCheck = true;
    }
    else{
        passwordCheck = false;
    }
});

// Function to display error messages in the login form
function createErroreMessage(message){
    errorLoginDiv.innerHTML = '<p> ' + message + '</p>';  // Insert the error message inside the error div
}