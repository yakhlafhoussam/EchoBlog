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
        <h1 class="text-3xl text-black font-bold px-5">Articles management</h1>
        <p class="text-gray-500 font-semibold px-5">Manage your article here.</p>
    </div>
    <div class="w-full flex gap-2">
        <div class="flex flex-col p-5 mb-5 gap-2 bg-slate-200 rounded-xl w-1/4">
            <h1 class="text-2xl text-black font-semibold"><i class="fas fa-icons"></i> Category Used</h1>
            <h1 class="text-2xl text-gray-500 font-semibold"><?php echo count($_SESSION['category']) ?> Category</h1>
        </div>
        <div class="flex flex-col p-5 mb-5 gap-2 bg-slate-200 rounded-xl w-1/4">
            <h1 class="text-2xl text-black font-semibold"><i class="fas fa-newspaper"></i> All Article</h1>
            <h1 class="text-2xl text-gray-500 font-semibold"><?php echo count($_SESSION['article']) ?> Article</h1>
        </div>
        <div class="flex flex-col p-5 mb-5 gap-2 bg-slate-200 rounded-xl w-1/4">
            <h1 class="text-2xl text-black font-semibold"><i class="fas fa-star"></i> Most category used</h1>
            <h1 class="text-2xl text-gray-500 font-semibold"><?php if (isset($_SESSION['authorcat'])) { echo '
                                                                            <div class="px-1 cursor-pointer">
                                                                                <span class="role-badge inline-flex items-center px-2 py-0.5 rounded-full text-lg font-medium bg-opacity-10 bg-['. $_SESSION['authorcat']['color'] .'] text-[' . $_SESSION['authorcat']['color'] . ']">
                                                                                    <i class="fas fa-' . $_SESSION['authorcat']['icon'] . ' mr-1 text-lg"></i> ' . ucfirst($_SESSION['authorcat']['name']) . '
                                                                                </span>
                                                                            </div>
                                                                            '; }?></h1>
        </div>
        <div class="flex flex-col p-5 mb-5 gap-2 bg-slate-200 rounded-xl w-1/4">
            <h1 class="text-2xl text-black font-semibold"><i class="fas fa-heart"></i> All like</h1>
            <h1 class="text-2xl text-gray-500 font-semibold"><?php echo count($_SESSION['category']) ?> Article</h1>
        </div>
    </div>
    <div class="w-full flex justify-between">
        <div class="w-[48%] h-[300px] rounded-2xl bg-white">
            <div class="w-full h-16 flex items-center bg-blue-100 rounded-t-xl">
                <h1 class="w-1/2 px-4 text-xl font-semibold text-gray-500"><i class="fas fa-icons"></i> Add categorys</h1>
            </div>
            <div id="categorylist" class="w-full max-h-56 overflow-y-auto flex flex-wrap gap-2 p-4">
            <?php 
            if ($_SESSION['category']) {
                for ($i=0; $i < count($_SESSION['category']); $i++) { 
                    echo '
                        <div id="' . $_SESSION['category'][$i]['id'] . '" data-name="no" class="category px-1 cursor-pointer">
                            <span class="role-badge inline-flex items-center px-2 py-0.5 rounded-full text-lg font-medium bg-opacity-10 bg-['. $_SESSION['category'][$i]['color'] .'] text-[' . $_SESSION['category'][$i]['color'] . ']">
                                <i class="fas fa-' . $_SESSION['category'][$i]['icon'] . ' mr-1 text-lg"></i> ' . ucfirst($_SESSION['category'][$i]['name']) . '
                            </span>
                        </div>
                        ';
                }
            }
            ?>
            </div>
        </div>
        <div class="w-[48%] h-[300px] rounded-2xl bg-white">
            <div class="w-full h-16 flex items-center bg-blue-100 rounded-t-xl">
                <h1 class="w-1/2 px-4 text-xl font-semibold text-gray-500"><i class="fas fa-circle-plus"></i> Add Article</h1>
            </div>
            <form method="POST" action="addarticle" class="w-full flex flex-col p-4 gap-2 bg-white rounded-b-xl overflow-y-auto">
                <div class="relative">
                    <i class="fas fa-heading absolute left-3 top-3 text-slate-400 text-sm"></i>
                    <input id="title" name="title" maxlength="60" value="<?php if (isset($_SESSION['title'])) { echo $_SESSION['title']; unset($_SESSION['title']); } ?>" type="text" placeholder="Title" class="w-full pl-10 pr-3 py-2 text-sm font-bold border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <p id="maxt" class="text-gray-400 font-bold absolute right-2 bottom-[6px]">60</p>
                </div>
                <div class="relative">
                    <i class="fas fa-arrows-to-circle absolute left-3 top-3 text-slate-400 text-sm"></i>
                    <textarea id="content" name="content" maxlength="310" value="<?php if (isset($_SESSION['content'])) { echo $_SESSION['content']; unset($_SESSION['content']); } ?>" type="text" placeholder="Content" class="w-full pl-10 pr-3 py-2 text-lg border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent h-14 resize-none"></textarea>
                    <p id="maxc" class="text-gray-400 font-bold absolute right-2 bottom-[6px]">310</p>
                </div>
                <input id="categoryone" name="categoryone" class="w-0 h-0 hidden" type="text" value="">
                <div id="categorySelect" class="w-full h-10 border border-solid border-slate-200 rounded-md flex items-center gap-2 px-4"><h1 id="empty" class="w-full h-full flex justify-center items-center text-2xl text-gray-400 font-bold">You will see the added category here</h1></div>
                <button id="submit" type="button" name="newcategory" class="signin-btn w-full bg-indigo-600 text-white py-2 rounded-md font-medium hover:bg-indigo-700 transition">
                    Add Category
                </button>
            </form>
        </div>
    </div>
</section>