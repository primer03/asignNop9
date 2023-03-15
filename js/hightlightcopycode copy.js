var coptcodex = document.querySelectorAll('.copycode')
var fontcode = document.querySelectorAll('.fontcode')

// console.log(fontcode);
coptcodex.forEach(e => {
    e.onclick = (ex) => {
        console.log(ex.target.dataset.name);
        fontcode.forEach(ec => {
            if (ex.target.dataset.name == ec.dataset.name) {
                var range = document.createRange();
                range.selectNodeContents(ec);
                var selection = window.getSelection();
                selection.removeAllRanges();
                selection.addRange(range);
                document.execCommand('copy');
                selection.removeAllRanges();
                ex.target.innerHTML = "Copied!"
                setTimeout(() => {
                    ex.target.innerHTML = "Copy code"
                }, 2000)
            }
        })
    }
})