// Variable Declaration

const loginBtn = document.querySelector("#login");
const registerBtn = document.querySelector("#register");
const loginForm = document.querySelector(".login-form");
const registerForm = document.querySelector(".register-form");

// Login button function
loginBtn.addEventListener('click', () => {
    loginBtn.style.backgrounColor ="#21264D";
    registerBtn.style.backgrounColor = "rgba(255, 255, 255, 0.2)";

    loginForm.style.left = "50%";
    registerBtn.style.left = "-50%";

    loginForm.style.opcity = 1;
    registerForm.opacity = 0;
})
// Register button function
registerBtn.addEventListener('click', () => {
    loginBtn.style.backgrounColor ="rgba(255, 255, 255, 0.2)";
    registerBtn.style.backgrounColor = "#21264D";

    loginForm.style.left = "150%";
    registerBtn.style.left = "50%";

    loginForm.style.opcity = 0;
    registerForm.opacity = 1;
})