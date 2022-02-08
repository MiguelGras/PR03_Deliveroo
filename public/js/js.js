$(document).ready(function() {
    $("#cerrar").click(function() {
        document.getElementsByClassName("modalmask")[0].style.opacity = 0
        document.getElementsByClassName("modalmask")[0].style.pointerEvents = "none"
        document.getElementsByTagName("html")[0].style.overflowY = "scroll"
    });


});

function modal() {
    document.getElementsByClassName("modalmask")[0].style.opacity = 1
    document.getElementsByClassName("modalmask")[0].style.pointerEvents = "auto"
        //document.getElementsByTagName("html")[0].style.overflow = "hidden"
}