const errormsg = document.querySelector('#error');
const successmsg = document.querySelector('#success');
const page = document.querySelector('#page').dataset.name;

function showmsg() {
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
}

showmsg();

if (page == "categories") {
    const input = document.getElementById('colorInput');
    const preview = document.getElementById('colorPreview');
    input.addEventListener('input', () => {
        preview.style.background = input.value;
    });
} else if (page == "article") {
    let maxtitle = 60;
    let maxcontent = 1300;
    let select = 0;
    let category = document.querySelectorAll(".category");
    const submit = document.querySelector("#submit");
    const title = document.querySelector("#title");
    const content = document.querySelector("#content");
    const maxt = document.querySelector("#maxt");
    const maxc = document.querySelector("#maxc");
    category = Array.from(category);
    title.oninput = function () {
        maxtitle = 60;
        maxtitle -= title.value.length;
        maxt.innerText = maxtitle;
    }
    content.oninput = function () {
        maxcontent = 1300;
        maxcontent -= content.value.length;
        maxc.innerText = maxcontent;
    }
    category.forEach(cat => {
        cat.onclick = function () {
            if (document.getElementById(this.id).dataset.name == 'no') {
                if (select >= 1) {
                    errormsg.innerHTML = 'You can use just one category for every article !';
                    showmsg();
                } else {
                    select++;
                    document.getElementById(this.id).dataset.name = 'yes';
                    document.getElementById("empty").style.display = "none";
                    document.getElementById('categorySelect').appendChild(document.getElementById(this.id));
                    document.getElementById('categoryone').value += this.id;
                }
            } else {
                document.getElementById('categoryone').value = "";
                select--;
                document.getElementById(this.id).dataset.name = 'no';
                document.getElementById('categorylist').appendChild(document.getElementById(this.id));
                if (select == 0) {
                    document.getElementById("empty").style.display = "flex";
                }
            }
        }
    })
    submit.onclick = function () {
        if (select == 0 || title.value == "" || content.value == "") {
            errormsg.innerHTML = 'Please fill in the all fields !';
            showmsg();
        } else {
            submit.type = "submit";
        }
    }
}
