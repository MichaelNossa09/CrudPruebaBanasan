document.addEventListener("DOMContentLoaded", function () {
    const modalContainer = document.getElementById("modalContainer");
    const registerContainer = document.getElementById("registerContainer");
    const loginButton = document.getElementById("loginButton");
    const registerButton = document.getElementById("registerButton");
    const closeButton = document.getElementById("closeButton");
    const closeButtonReg = document.getElementById("closeButtonReg");

    loginButton.addEventListener("click", function () {
        modalContainer.style.display = "flex";
    });

    closeButton.addEventListener("click", function () {
        modalContainer.style.display = "none";
    });

    registerButton.addEventListener("click", function () {
        registerContainer.style.display = "flex";
    });

    closeButtonReg.addEventListener("click", function () {
        registerContainer.style.display = "none";
    });
}); 
