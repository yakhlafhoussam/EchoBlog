<header class="w-[15%] h-full py-5 z-[9999 bg-white">
    <div class="border-b border-blue-300 border-solid w-full flex justify-center items-center pb-2">
        <a href="/">
            <img class="w-40" src="assets/img/logo2.png" alt="">
        </a>
    </div>
    <div class="w-full bg-white p-4 space-y-2">
        <p class="text-[10px] font-bold text-slate-400 px-3 mb-2">NAVIGATION</p>
        <a href="/" class="<?php if ($view == 'home') { echo 'bg-indigo-50 text-indigo-600'; } else { echo 'text-slate-600 hover:bg-slate-50'; } ?> w-full flex items-center gap-3 px-3 py-2 rounded-md transition font-medium">
            <i class="fas fa-house text-sm"></i> Feed
        </a>
        <a href="add" class="<?php if ($view == 'add') { echo 'bg-indigo-50 text-indigo-600'; } else { echo 'text-slate-600 hover:bg-slate-50'; } ?> w-full flex items-center gap-3 px-3 py-2 rounded-md transition font-medium">
            <i class="fas fa-pen-nib text-sm"></i> My Articles
        </a>
        <div class="pt-4 mt-4 border-t border-slate-100 space-y-2">
            <p class="text-[10px] font-bold text-slate-400 px-3 mb-2">MANAGEMENT</p>
            <a href="cat" class="<?php if ($view == 'cat') { echo 'bg-red-50 text-red-600'; } else { echo 'text-slate-600 hover:bg-slate-50'; } ?> w-full flex items-center gap-3 px-3 py-2 rounded-md transition font-medium">
                <i class="fas fa-tags text-sm"></i> Categories
            </a>
            <a href="users" class="<?php if ($view == 'users') { echo 'bg-red-50 text-red-600'; } else { echo 'text-slate-600 hover:bg-slate-50'; } ?> w-full flex items-center gap-3 px-3 py-2 rounded-md transition font-medium">
                <i class="fas fa-users-cog text-sm"></i> User Roles
            </a>
        </div>
    </div>
</header>

<!-- bg-red-50
bg-red-50 -->

<!-- text-red-600 -->

<!-- <a href="login" class="bg-white py-3 w-32 text-center rounded-full font-inter font-bold text-xl transition-transform hover:scale-[1.02] text-blue-700">Log in</a>
<a href="signup" class="py-3 w-32 text-center rounded-full font-inter font-bold text-xl transition-transform hover:scale-[1.02] border border-solid border-white text-white">Sign UP</a> -->
<!-- <i class="fas fa-users-cog text-sm"></i> -->