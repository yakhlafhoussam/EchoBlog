<section class="w-[70%] h-full flex flex-col px-10 py-5 bg-slate-100">
    <div class="bg-white rounded-xl px-5 py-2 mb-4 flex items-center gap-2">
        <div class="w-10 h-10 rounded-full flex items-center justify-center bg-indigo-600 text-xl text-white font-bold relative">
            <?php
                echo ucfirst(substr($_SESSION['first'], 0 ,1)) . ucfirst(substr($_SESSION['last'], 0, 1))
            ?>
            <div class="w-3 h-3 bg-green-500 absolute right-0 bottom-0 rounded-full"></div>
        </div>
        <h1 class="text-black text-2xl font-bold">
            <?php echo $_SESSION['first'] . ' ' . $_SESSION['last'] ?>
        </h1>
    </div>
    <div class="space-y-2 mb-8">
        <h1 class="text-3xl text-black font-bold px-5">User management</h1>
        <p class="text-gray-500 font-semibold px-5">Manage your users members and their account permissions here.</p>
    </div>
    <div class="flex items-end px-5 mb-5 gap-2">
        <h1 class="text-2xl text-black font-semibold">All Users</h1>
        <h1 class="text-2xl text-gray-500 font-semibold"><?php echo count($_SESSION['users']) ?></h1>
    </div>
</section>