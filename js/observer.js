const targetElement = document.querySelectorAll('.target-element');
const startx = document.querySelectorAll('.startx');

const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            console.log('Target element is visible');
            entry.target.classList.add('visible');
        } else {
            console.log('Target element is not visible');
            entry.target.classList.remove('visible');
        }
    });
}, {
    threshold: 0.20
});

const observer1 = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            console.log('Target element is visible');
            entry.target.classList.add('visible');
        } else {
            console.log('Target element is not visible');
            entry.target.classList.remove('visible');
        }
    });
}, {
    threshold: 0
});
targetElement.forEach(e => {
    observer.observe(e);
})

startx.forEach(e => {
    observer1.observe(e);
})