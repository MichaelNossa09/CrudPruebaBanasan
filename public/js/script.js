$(document).ready(function () {
    // Agregar evento de clic al elemento con id "user"
    $("#user").click(function () {
        // Alternar la clase "show" en el elemento con id "profile"
        $("#profile").toggleClass("show");
    });
});