<header class="w-full h-[10%] flex items-center justify-between px-10 z-[9999] fixed bg-blue-700">
    <a class="flex gap-1" href="/">
        <img class="w-64" src="assets/img/logo.png" alt="">
    </a>
    <div class="w-1/2 h-full flex justify-around items-center">
        <a id="home" class="font-inter font-bold text-xl transition-transform <?php if ($page == "/") { echo "border-b-2 text-white"; } else { echo "hover:scale-105 text-[#8896af]"; } ?>" href="/">Home</a>
    </div>
    <div class="h-full w-1/4 flex justify-end items-center gap-2">
        <?php
        if (isset($_SESSION['id'])) {
            echo '<a href="profile" class="bg-white py-3 w-32 text-center rounded-full font-inter font-bold text-xl transition-transform hover:scale-[1.02] text-blue-700">Profile</a>
                <a href="borrow" class="py-3 w-32 text-center rounded-full font-inter font-bold text-xl transition-transform hover:scale-[1.02] border border-solid border-white text-white">Borrows</a>';
        } else {
            echo '<a href="login" class="bg-white py-3 w-32 text-center rounded-full font-inter font-bold text-xl transition-transform hover:scale-[1.02] text-blue-700">Log in</a>
                <a href="signup" class="py-3 w-32 text-center rounded-full font-inter font-bold text-xl transition-transform hover:scale-[1.02] border border-solid border-white text-white">Sign UP</a>';
        }
         ?>
        </div>
</header>
<div class="w-full h-[10%]"></div>
