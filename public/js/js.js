$(document).ready(function() {
    $("#cerrar").click(function() {
        document.getElementsByClassName("modalmask")[0].style.opacity = 0
        document.getElementsByClassName("modalmask")[0].style.pointerEvents = "none"
        document.getElementsByTagName("html")[0].style.overflowY = "scroll"
        document.getElementById('login_username').style.borderColor = "rgb(177, 172, 172)"
        document.getElementById('login_password').style.borderColor = "rgb(177, 172, 172)"
        texto.innerHTML = ""
        document.getElementById("form").reset();
    });


});

function modal() {
    document.getElementsByClassName("modalmask")[0].style.opacity = 1
    document.getElementsByClassName("modalmask")[0].style.pointerEvents = "auto"
        //document.getElementsByTagName("html")[0].style.overflow = "hidden"
}

function validar_login() {
    username = document.getElementById('login_username').value
    password = document.getElementById('login_password').value
    texto = document.getElementById('texto-mal')

    if (username == '' && password == '') {
        document.getElementById('login_username').style.borderColor = "red"
        document.getElementById('login_password').style.borderColor = "red"
        texto.innerHTML = "Usuario y contraseña vacios."
        return false
    } else if (username != '' && password == '') {
        document.getElementById('login_password').style.borderColor = "red"
        document.getElementById('login_username').style.borderColor = "rgb(177, 172, 172)"
        texto.innerHTML = "Contraseña vacia."
        return false
    } else if (username == '' && password != '') {
        document.getElementById('login_username').style.borderColor = "red"
        document.getElementById('login_password').style.borderColor = "rgb(177, 172, 172)"
        texto.innerHTML = "Usuario vacio."
        return false
    } else {
        return true
    }
}