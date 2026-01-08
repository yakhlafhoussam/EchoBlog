const errormsg = document.querySelector('#error');
const successmsg = document.querySelector('#success');
const page = document.querySelector('#page').dataset.name;

/* function addLike(arid, reid) {
    const form = new FormData();
    form.append('article_id', arid);
    form.append('reader_id', reid);
    fetch('/../../app/Controllers/LikeController.php', {
        method: 'POST',
        body: form
    }).then(function (res) {
        return res.text();
    }).then(function (data) {
        console.log(data);
    }).catch(function (error) {
        console.log(error);
    })
} */

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
} else if (page == "home") {
    const like = document.querySelectorAll('.likes');
    const comment = document.getElementById('comments');
    like.forEach(liked => {
        liked.onclick = function () {
            if (this.dataset.name == "no") {
                this.classList.replace("text-slate-400", "text-red-600");
                this.dataset.name = "yes";
                document.querySelector(`#${this.id} span`).innerText++;
                addLike('Houssam', 'YK');
            } else {
                this.classList.replace("text-red-600", "text-slate-400");
                this.dataset.name = "no";
                document.querySelector(`#${this.id} span`).innerText--;
            }
        }
    })
} else if (page == "article") {
    let maxtitle = 60;
    let maxcontent = 310;
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
        maxcontent = 310;
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
