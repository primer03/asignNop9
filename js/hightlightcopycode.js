var coptcodex = document.querySelector('.copycode')
var fontcode = document.querySelector('.fontcode')

coptcodex.onclick = () => {
    var range = document.createRange();
    range.selectNodeContents(fontcode);
    var selection = window.getSelection();
    selection.removeAllRanges();
    selection.addRange(range);
    document.execCommand('copy');
    selection.removeAllRanges();
    coptcodex.innerHTML = "Copied!"
    setTimeout(() => {
        coptcodex.innerHTML = "Copy code"
    }, 2000)
}