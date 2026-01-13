<header class="w-[15%] h-full py-5 z-[9999 bg-white">
    <div class="border-b border-blue-300 border-solid w-full flex justify-center items-center pb-2">
        <a href="/">
            <img class="w-40" src="assets/img/logo2.png" alt="">
        </a>
    </div>
    <div class="w-full bg-white p-4 space-y-2">
        <p class="text-[10px] font-bold text-slate-400 px-3 mb-2">NAVIGATION</p>
        <a href="/" class="<?php if ($view == 'home') { echo 'bg-indigo-100 text-indigo-600'; } else { echo 'text-slate-600 hover:bg-slate-100'; } ?> w-full flex items-center gap-3 px-3 py-2 rounded-md transition font-medium">
            <i class="fas fa-house text-sm"></i> Feed
        </a>
        <?php 
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'author') {
            if ($view == 'article') { 
                echo '<a href="article" class="bg-indigo-100 text-indigo-600 w-full flex items-center gap-3 px-3 py-2 rounded-md transition font-medium"><i class="fas fa-pen-nib text-sm"></i> My Articles</a>'; 
            } else { 
                echo '<a href="article" class="text-slate-600 hover:bg-slate-100 w-full flex items-center gap-3 px-3 py-2 rounded-md transition font-medium"><i class="fas fa-pen-nib text-sm"></i> My Articles</a>'; 
            }
        }
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
            if ($view == 'categories') { 
                echo '<div class="pt-4 mt-4 border-t border-slate-100 space-y-2"><p class="text-[10px] font-bold text-slate-400 px-3 mb-2">MANAGEMENT</p><a href="categories" class="bg-red-100 text-red-600 w-full flex items-center gap-3 px-3 py-2 rounded-md transition font-medium"><i class="fas fa-tags text-sm"></i> Categories</a>'; 
            } else { 
                echo '<div class="pt-4 mt-4 border-t border-slate-100 space-y-2"><p class="text-[10px] font-bold text-slate-400 px-3 mb-2">MANAGEMENT</p><a href="categories" class="text-slate-600 hover:bg-slate-100 w-full flex items-center gap-3 px-3 py-2 rounded-md transition font-medium"><i class="fas fa-tags text-sm"></i> Categories</a>'; 
            }
            if ($view == 'users') { 
                echo '<a href="users" class="bg-red-100 text-red-600 w-full flex items-center gap-3 px-3 py-2 rounded-md transition font-medium"><i class="fas fa-users-cog text-sm"></i> User Roles ';
                if (isset($_SESSION['request'])) {
                    echo '<p class="w-4 h-4 bg-red-600 rounded-full text-white text-xs text-center font-bold">' . $_SESSION['request'] . '</p>' . '</a></div>';
                } else {
                    echo '</a></div>'; 
                }
            } else { 
                echo '<a href="users" class="text-slate-600 hover:bg-slate-100 w-full flex items-center gap-3 px-3 py-2 rounded-md transition font-medium"><i class="fas fa-users-cog text-sm"></i> User Roles ';
                if (isset($_SESSION['request'])) {
                    echo '<p class="w-4 h-4 bg-red-600 rounded-full text-white text-xs text-center font-bold">' . $_SESSION['request'] . '</p>' . '</a></div>';
                } else {
                    echo '</a></div>'; 
                }
            }
        }
        ?>
    </div>
</header>