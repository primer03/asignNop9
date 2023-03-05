const targetElement = document.querySelectorAll('.target-element');
const startx = document.querySelectorAll('.startx');
const erabox = document.querySelectorAll('.erabox');

const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        } else {
            entry.target.classList.remove('visible');
        }
    });
}, {
    threshold: 0.20
});

const observer1 = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        } else {
            entry.target.classList.remove('visible');
        }
    });
}, {
    threshold: 0
});

const oberabox = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('showerabox');
        } else {
            entry.target.classList.remove('showerabox');
        }
    });
}, {
    threshold: 0
});
targetElement.forEach(e => {
    observer.observe(e);
})

erabox.forEach(era => {
    oberabox.observe(era)
})

startx.forEach(e => {
    observer1.observe(e);
})