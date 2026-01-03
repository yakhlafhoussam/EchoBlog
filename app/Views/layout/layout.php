<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EchoBlog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=BBH+Sans+Hegarty&family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Pixelify+Sans:wght@400..700&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Press+Start+2P&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9ffdd5c604.js" crossorigin="anonymous"></script>
</head>

<body class="w-screen h-screen flex overflow-hidden">
    <div id="toast" class="flex gap-2 bg-green-600 text-white px-4 py-3 rounded-lg absolute top-10 -left-80">
        <span class="font-semibold">Success:</span>
        <h1>Account created successfully!</h1>
    </div>
    <div id="toast0" class="flex gap-2 bg-red-600 text-white px-4 py-3 rounded-lg absolute top-10 -left-80">
        <span class="font-semibold">Error:</span>
        <h1 id="error"><?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
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
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>
    <script src="/assets/script.js"></script>
</body>

</html>