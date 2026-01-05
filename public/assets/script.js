const errormsg = document.querySelector('#error');
const successmsg = document.querySelector('#success');
const page = document.querySelector('#page').dataset.name;


if (errormsg.innerHTML != '') {
    gsap.to(document.querySelector("#toast0"), {
        x: 330,
        duration: 0.25,
        onComplete: () => {
            gsap.to(document.querySelector("#toast0"), {
                delay: 2,
                duration: 2,
                opacity: 0,
                onComplete: () => {
                    gsap.to(document.querySelector("#toast0"), {
                        duration: 0,
                        x: -330,
                        opacity: 1,
                    });
                }
            });
        }
    });
} else if (successmsg.innerHTML != '') {
    gsap.to(document.querySelector("#toast"), {
        x: 330,
        duration: 0.25,
        onComplete: () => {
            gsap.to(document.querySelector("#toast"), {
                delay: 2,
                duration: 2,
                opacity: 0,
                onComplete: () => {
                    gsap.to(document.querySelector("#toast"), {
                        duration: 0,
                        x: -330,
                        opacity: 1,
                    });
                }
            });
        }
    });
}

if (page == "categories") {
    const input = document.getElementById('colorInput');
    const preview = document.getElementById('colorPreview');
    input.addEventListener('input', () => {
    preview.style.background = input.value;
});
}
