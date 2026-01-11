<section class="w-[70%] h-full flex flex-col px-10 py-5 bg-slate-100">
    <div class="bg-white rounded-xl px-5 py-2 mb-4 flex items-center gap-2">
        <div class="w-10 h-10 rounded-full flex items-center justify-center bg-indigo-600 text-xl text-white font-bold relative">
            <?php
                echo ucfirst(substr($first, 0 ,1)) . ucfirst(substr($last, 0, 1))
            ?>
            <div class="w-3 h-3 bg-green-500 absolute right-0 bottom-0 rounded-full"></div>
        </div>
        <h1 class="text-black text-2xl font-bold">
            <?php echo $first . ' ' . $last ?>
        </h1>
    </div>
    <div class="space-y-2 mb-8">
        <h1 class="text-3xl text-black font-bold px-5">Categorys management</h1>
        <p class="text-gray-500 font-semibold px-5">Manage your categorys of the articles here.</p>
    </div>
    <div class="w-full flex gap-2">
        <div class="flex flex-col p-5 mb-5 gap-2 bg-slate-200 rounded-xl w-1/4">
            <h1 class="text-2xl text-black font-semibold"><i class="fas fa-icons"></i> All Category</h1>
            <h1 class="text-2xl text-gray-500 font-semibold"><?php echo count($_SESSION['category']) ?> Category</h1>
        </div>
        <div class="flex flex-col p-5 mb-5 gap-2 bg-slate-200 rounded-xl w-1/4">
            <h1 class="text-2xl text-black font-semibold"><i class="fas fa-newspaper"></i> All Article</h1>
            <h1 class="text-2xl text-gray-500 font-semibold"><?php echo count($_SESSION['article']) ?> Article</h1>
        </div>
        <div class="flex flex-col p-5 mb-5 gap-2 bg-slate-200 rounded-xl w-1/4">
            <h1 class="text-2xl text-black font-semibold"><i class="fas fa-star"></i> Most category used</h1>
            <h1 class="text-2xl text-gray-500 font-semibold"><?php if($_SESSION['mostcat'] != false) { echo '<span class="role-badge inline-flex items-center px-2 py-0.5 rounded-full text-lg font-medium bg-opacity-10 bg-['. $_SESSION['mostcat']['color'] .'] text-[' . $_SESSION['mostcat']['color'] . ']">
                                <i class="fas fa-' . $_SESSION['mostcat']['icon'] . ' mr-1 text-lg"></i> ' . ucfirst($_SESSION['mostcat']['name']) . '
                            </span>'; } ?></h1>
        </div>
        <div class="flex flex-col p-5 mb-5 gap-2 bg-slate-200 rounded-xl w-1/4">
            <h1 class="text-2xl text-black font-semibold"><i class="fas fa-star-half"></i> Least category used</h1>
            <h1 class="text-2xl text-gray-500 font-semibold"><?php if($_SESSION['mostcat'] != false) { echo '<span class="role-badge inline-flex items-center px-2 py-0.5 rounded-full text-lg font-medium bg-opacity-10 bg-['. $_SESSION['leastcat']['color'] .'] text-[' . $_SESSION['leastcat']['color'] . ']">
                                <i class="fas fa-' . $_SESSION['leastcat']['icon'] . ' mr-1 text-lg"></i> ' . ucfirst($_SESSION['leastcat']['name']) . '
                                </span>'; } ?></h1>
        </div>
    </div>
    <div class="w-full flex justify-between">
        <div class="w-[45%] rounded-2xl bg-white">
            <div class="w-full h-16 flex items-center bg-blue-100 rounded-t-xl">
                <h1 class="w-1/2 px-4 text-xl font-semibold text-gray-500"><i class="fas fa-icons"></i> Categorys</h1>
            </div>
            <div class="w-full max-h-96 overflow-y-auto">
            <?php 
            if (isset($_SESSION['category'])) {
                for ($i=0; $i < count($_SESSION['category']); $i++) { 
                    if (($i + 1) != count($_SESSION['category'])) {
                        echo '<div class="w-full h-14 flex items-center justify-between border-b border-solid border-blue-200 px-5">';
                    } else {
                        echo '<div class="w-full h-14 flex items-center justify-between px-5">';
                    }
                    echo '
                        <div class="px-1 flex gap-2 items-center">
                            <h1 class="text-gray-500 font-semibold">' . ($i + 1) . ' .</h1>
                            <span class="role-badge inline-flex items-center px-2 py-0.5 rounded-full text-lg font-medium bg-opacity-10 bg-['. $_SESSION['category'][$i]['color'] .'] text-[' . $_SESSION['category'][$i]['color'] . ']">
                                <i class="fas fa-' . $_SESSION['category'][$i]['icon'] . ' mr-1 text-lg"></i> ' . ucfirst($_SESSION['category'][$i]['name']) . '
                            </span>
                        </div>
                        <form method="POST" action="delcategory">
                            <input type="hidden" name="categorydel" value="' . $_SESSION['category'][$i]['id'] . '">
                            <button type="submit" class="fas fa-trash mr-1 text-lg text-red-500"></button>
                        </form>
                    </div>
                    ';
                }
            }
            ?>
            </div>
        </div>
        <div class="w-[45%] max-h-52 rounded-2xl bg-white">
            <div class="w-full h-16 flex items-center bg-blue-100 rounded-t-xl">
                <h1 class="w-1/2 px-4 text-xl font-semibold text-gray-500"><i class="fas fa-circle-plus"></i> ADD Categorys</h1>
            </div>
            <form method="post" action="addcategory" class="w-full flex flex-col p-4 gap-2 bg-white rounded-b-xl overflow-y-auto">
                <div class="relative">
                    <i class="fas fa-heading absolute left-3 top-3 text-slate-400 text-sm"></i>
                    <input name="title" value="<?php if (isset($_SESSION['title'])) { echo $_SESSION['title']; unset($_SESSION['title']); } ?>" type="text" placeholder="Title" class="w-full pl-10 pr-3 py-2 text-sm border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                <div class="relative">
                    <i class="fas fa-font-awesome absolute left-3 top-3 text-slate-400 text-sm"></i>
                    <input name="icon" value="<?php if (isset($_SESSION['icon'])) { echo $_SESSION['icon']; unset($_SESSION['icon']); } ?>" type="text" placeholder="Font-awesome" class="w-full pl-10 pr-3 py-2 text-sm border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                <div class="relative">
                    <i class="fas fa-palette absolute left-3 top-3 text-slate-400 text-sm"></i>
                    <input name="color" value="<?php if (isset($_SESSION['color'])) { echo $_SESSION['color']; unset($_SESSION['color']); } else { echo "#ffffff"; } ?>" type="color" id="colorInput" class="absolute inset-0 opacity-0 cursor-pointer">
                    <div id="colorPreview" class="w-full h-[38px] pl-10 pr-3 rounded-md border border-slate-200 flex items-center shadow-sm cursor-pointer"></div>
                </div>
                <button type="submit" name="newcategory" class="signin-btn w-full bg-indigo-600 text-white py-2 rounded-md font-medium hover:bg-indigo-700 transition">
                    Add Category
                </button>
            </form>
        </div>
    </div>
</section>