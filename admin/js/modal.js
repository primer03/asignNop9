var clo = document.querySelector('#close')
var modal = document.getElementById('modal')
clo.onclick = () => {
        modal.style.display = "none"
    }
    // btn.onclick = () => {
    //     modal.style.display = "block"
    // }
window.onkeyup = function(ev) {
    if (ev.keyCode == 27) {
        modal.style.display = "none"
    }
}