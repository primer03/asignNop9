const targetElement = document.querySelectorAll('.target-element');
const startx = document.querySelectorAll('.startx');
const nameeraX = document.querySelectorAll('.nameeraX');
var bocfera = document.querySelector('.bocfera')
var imgfirstX = document.querySelectorAll('.imgfirstX')

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

const scalename = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            console.log("OK");
            entry.target.classList.add('nameerashow');
        } else {
            entry.target.classList.remove('nameerashow');
        }
    });
}, {
    threshold: 0
});

const opcity = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            console.log("OK");
            entry.target.classList.add('opacityshow');
        } else {
            entry.target.classList.remove('opacityshow');
        }
    });
}, {
    threshold: 0.5
});

const opcitynamefi = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('boxheadfshow');
        } else {
            entry.target.classList.remove('boxheadfshow');
        }
    });
}, {
    threshold: 0.5
});

const rorateX = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('imgfirstXshow');
        } else {
            entry.target.classList.remove('imgfirstXshow');
        }
    });
}, {
    threshold: 0.3
});

targetElement.forEach(e => {
    observer.observe(e);
})



startx.forEach(e => {
    observer1.observe(e);
})

nameeraX.forEach(e => {
    scalename.observe(e);
})

imgfirstX.forEach(e => {
    rorateX.observe(e);
})

opcitynamefi.observe(bocfera)