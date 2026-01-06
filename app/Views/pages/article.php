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
            <h1 class="text-2xl text-gray-500 font-semibold"><?php echo count($_SESSION['category']) ?> Article</h1>
        </div>
        <div class="flex flex-col p-5 mb-5 gap-2 bg-slate-200 rounded-xl w-1/4">
            <h1 class="text-2xl text-black font-semibold"><i class="fas fa-star-half"></i> Least category used</h1>
            <h1 class="text-2xl text-gray-500 font-semibold"><?php echo count($_SESSION['category']) ?> Article</h1>
        </div>
    </div>

</section>