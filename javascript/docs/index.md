# Login and Registration Application - `index.js`

## Description
This JavaScript file is part of a web application that allows users to register and log into a system through a simple interface. It includes input field validation for both login and registration, ensuring that users enter valid information before submitting the forms.

## Table of Contents
- [Usage](#usage)
- [Code Structure](#code-structure)
- [Key Features](#key-features)
- [Login Form Validation](#login-form-validation)
- [Registration Form Validation](#registration-form-validation)
- [Password Validation](#password-validation)

## Usage
To use this file, include it in your HTML document by adding the following script tag:

```html
<script src="./javascript/index.js"></script>
```


## Code Structure
The `index.js` file consists of event listeners and functions to handle user interactions in the login and registration forms. It ensures that the input data is valid before any submission.

## Key Features

```javascript
const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');
const errorLoginDiv = document.getElementById('credential-error');
const errorRegisterDiv = document.getElementById('register-credential-error')
const passwordRegisterInput = document.getElementById('register-psw');
let passwordCheck = false;
```

**Description**: These variables identify the different DOM elements and initialize a variable for password validation.

## Login Form Validation

```javascript
loginForm.addEventListener('submit', function(e) {
    let mail = document.getElementById('login-mail').value;
    let psw = document.getElementById('login-psw').value;
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(!mail) {
        createErroreMessage('Insert mail!');
        e.preventDefault();
        return;
    }
    if(!emailPattern.test(mail)) {
        createErroreMessage('Insert valid mail');
        e.preventDefault();
        return;
    }
    if(!psw) {
        createErroreMessage('Insert password!');
        e.preventDefault();
        return;
    }
});
```
**Description**: This part of the code handles the validation of the login form. It checks whether the email is present, if it has a valid format, and if the password has been entered.

## Registration Form Validation

```javascript
registerForm.addEventListener('submit', function(e) {
    let username = document.getElementById('register-username').value;
    let mail = document.getElementById('register-mail').value;
    let psw = document.getElementById('register-psw').value;
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(!mail || !psw || !username) {
        errorRegisterDiv.innerHTML = "<p> Complete all fields </p>";
        e.preventDefault();
        return;
    }
    if(!emailPattern.test(mail)) {
        errorRegisterDiv.innerHTML = "<p> Insert valid mail </p>";
        e.preventDefault();
        return;
    }
    if(!passwordCheck) {
        errorRegisterDiv.innerHTML = "<p> Insert valid password </p>";
        e.preventDefault();
        return;
    }
    if(username.length > 16) {
        errorRegisterDiv.innerHTML = "<p> Username too long </p>";
        e.preventDefault();
        return;
    }
});
```
**Description**: This part handles the validation of the registration form, ensuring that all fields are filled and meet the established requirements.

## Password Validation

```javascript
passwordRegisterInput.addEventListener('input', function() {
    const password = passwordRegisterInput.value;
    const uppercaseParagraphCheck = document.getElementById('uppercase-check');
    const numberParagraphCheck = document.getElementById('number-check');
    const specialCharParagraphCheck = document.getElementById('character-check');

    const hasUppercase = /[A-Z]/.test(password);
    if(hasUppercase) {
        uppercaseParagraphCheck.style.color = 'red';
    } else {
        uppercaseParagraphCheck.style.color = 'black';
    }

    const hasNumber = /\d/.test(password);
    if(hasNumber) {
        numberParagraphCheck.style.color = 'red';
    } else {
        numberParagraphCheck.style.color = 'black';
    }

    const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
    if(hasSpecialChar) {
        specialCharParagraphCheck.style.color = 'red';
    } else {
        specialCharParagraphCheck.style.color = 'black';
    }

    if(hasSpecialChar && hasNumber && hasUppercase) {
        passwordCheck = true;
    } else {
        passwordCheck = false;
    }
});
```
**Description**: This section monitors the input of the password field and checks for the presence of uppercase letters, numbers, and special characters. It updates the display of validation states in real-time.
