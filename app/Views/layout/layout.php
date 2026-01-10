<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EchoBlog | <?php echo ucfirst($view) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=BBH+Sans+Hegarty&family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Pixelify+Sans:wght@400..700&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Press+Start+2P&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9ffdd5c604.js" crossorigin="anonymous"></script>
</head>

<body class="w-screen h-screen flex overflow-hidden">
    <h1 class="hidden"><?php echo $notFound; ?></h1>
    <div id="toast" class="flex gap-2 z-[9999] bg-green-600 text-white px-4 py-3 rounded-lg absolute top-10 -left-80">
        <span class="font-semibold">Success:</span>
        <h1 id="success"><?php
                            if (isset($_SESSION['successmsg'])) {
                                echo $_SESSION['successmsg'];
                                unset($_SESSION['successmsg']);
                            }
                            ?></h1>
    </div>
    <div id="toast0" class="flex gap-2 z-[9999] bg-red-600 text-white px-4 py-3 rounded-lg absolute top-10 -left-80">
        <span class="font-semibold">Error:</span>
        <h1 id="error"><?php
                        if (isset($_SESSION['errormsg'])) {
                            echo $_SESSION['errormsg'];
                            unset($_SESSION['errormsg']);
                        }
                        ?></h1>
    </div>
    <!-- Header -->
    <?php
    include __DIR__ . '/../templates/header.php';
    ?>
    <!-- Main -->
    <?php
    include $viewFile;
    ?>
    <!-- Footer -->
    <?php
    include __DIR__ . '/../templates/footer.php';
    ?>
    <div id="page" data-name="<?php echo $view ?>" class="w-0 h-0 hidden"></div>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>
    <script src="/assets/script.js"></script>
    <script>
        function addLike(arid, reid) {
            let xr = new XMLHttpRequest();

            xr.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    console.log(xr.response);
                } else {
                    console.log('loading');
                }
            };

            xr.open('POST', '/../../LikeController', true);
            xr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            xr.send(`article_id=${arid}&reader_id=${reid}`);
        }
        if (page == "home") {
            const like = document.querySelectorAll('.likes');
            const comment = document.getElementById('comments');
            like.forEach(liked => {
                liked.onclick = function() {
                    if (this.dataset.name == "no") {
                        this.classList.replace("text-slate-400", "text-red-600");
                        this.dataset.name = "yes";
                        document.querySelector(`#${this.id} span`).innerText++;
                        addLike(2, 3);
                    } else {
                        this.classList.replace("text-red-600", "text-slate-400");
                        this.dataset.name = "no";
                        document.querySelector(`#${this.id} span`).innerText--;
                    }
                }
            })
        }
    </script>
</body>

</html>