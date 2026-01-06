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
        <h1 class="text-3xl text-black font-bold px-5">User management</h1>
        <p class="text-gray-500 font-semibold px-5">Manage your users members and their account permissions here.</p>
    </div>
    <div class="flex items-end px-5 mb-5 gap-2">
        <h1 class="text-2xl text-black font-semibold">All Users</h1>
        <h1 class="text-2xl text-gray-500 font-semibold"><?php echo count($_SESSION['users']) ?></h1>
    </div>
    <div class="w-full bg-white rounded-xl">
        <div class="w-full h-16 flex items-center bg-blue-100 rounded-t-xl">
            <h1 class="w-1/2 px-4 text-xl font-semibold text-gray-500"><i class="fas fa-user"></i> User name</h1>
            <h1 class="w-1/4 px-4 text-xl font-semibold text-gray-500"><i class="fas fa-address-card"></i> User role</h1>
            <h1 class="w-1/4 px-4 text-xl font-semibold text-gray-500"><i class="fas fa-circle-check"></i> Request</h1>
        </div>
        <div class="w-full max-h-96 flex flex-col bg-white rounded-b-xl overflow-y-auto">
            <div class="w-full flex">
            <div class="w-1/2 px-4 py-2">
                <div class="flex items-center gap-3 px-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-indigo-600 text-xl text-white font-bold relative">
                        <?php
                            echo ucfirst(substr($first, 0 ,1)) . ucfirst(substr($last, 0, 1))
                        ?>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-800 truncate"><?php echo $first . ' ' . $last ?> (YOU)</p>
                        <p class="text-xs text-slate-500 truncate"><?php echo $email ?></p>
                    </div>
                </div>
            </div>
            <div class="w-1/4 px-4 py-2">
                <div class="px-1">
                    <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                        <i class="fas fa-user mr-1 text-sm"></i> Admin
                    </span>
                </div>
            </div>
            <div class="w-1/4 px-4 py-2 flex gap-2">
                <div class="px-1">
                    <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-medium bg-yellow-500 text-white">
                        <i class="fas fa-circle-check mr-1 text-sm"></i> Good
                    </span>
                </div>
            </div>
            </div>
            <?php 
            if (isset($_SESSION['users'])) {
                for ($i=0; $i < count($_SESSION['users']); $i++) { 
                    if ($_SESSION['users'][$i]['id'] == $_SESSION['id']) {
                        continue;
                    }
                    echo '
                    <div class="w-full flex">
                    <div class="w-1/2 px-4 py-2">
                <div class="flex items-center gap-3 px-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-indigo-600 text-xl text-white font-bold relative">
                        ' . ucfirst(substr($_SESSION['users'][$i]['firstName'], 0 ,1)) . ucfirst(substr($_SESSION['users'][$i]['lastName'], 0, 1)) . '
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-800 truncate">' . $_SESSION['users'][$i]['firstName'] . ' ' . $_SESSION['users'][$i]['lastName'] . '</p>
                        <p class="text-xs text-slate-500 truncate">' . $_SESSION['users'][$i]['email'] . '</p>
                    </div>
                </div>
            </div>
            <div class="w-1/4 px-4 py-2">';
            if ($_SESSION['users'][$i]['role'] == 'reader') {
                echo '
                <div class="px-1">
                    <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        <i class="fas fa-user mr-1 text-sm"></i> Reader
                    </span>
                </div>
                </div>
                ';
            } elseif ($_SESSION['users'][$i]['role'] == 'author') {
                echo '
                <div class="px-1">
                    <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <i class="fas fa-user mr-1 text-sm"></i> Author
                    </span>
                </div>
                </div>
                ';
            } elseif ($_SESSION['users'][$i]['role'] == 'admin') {
                echo '
                <div class="px-1">
                    <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                        <i class="fas fa-user mr-1 text-sm"></i> Admin
                    </span>
                </div>
                </div>
                ';
            }
            if ($_SESSION['users'][$i]['situation'] == 'yes') {
                echo '
                <div class="w-1/4 px-4 py-2 flex gap-2">
                    <form method="POST">
                        <input class="h-0 w-0 hidden" type="text" name="accepted" value="'. $_SESSION['users'][$i]['id'] .'">
                        <button type="submit" name="accept" class="px-1">
                            <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-medium bg-green-500 text-white">
                                <i class="fas fa-circle-check mr-1 text-sm"></i> Accept
                            </span>
                        </button>
                    </form>
                    <form method="POST">
                        <input class="h-0 w-0 hidden" type="text" name="refused" value="'. $_SESSION['users'][$i]['id'] .'">
                        <button type="submit" name="refuse" class="px-1">
                            <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-medium bg-red-500 text-white">
                                <i class="fas fa-circle-xmark mr-1 text-sm"></i> Refuse
                            </span>
                        </button>
                    </form>
                </div>
            </div>
                    ';
            } else {
                echo '
                <div class="w-1/4 px-4 py-2 flex gap-2">
                <div class="px-1">
                    <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-medium bg-yellow-500 text-white">
                        <i class="fas fa-circle-check mr-1 text-sm"></i> Good
                    </span>
                </div>
                </div>
                </div>';
            }
            }
            }
            ?>
        </div>
    </div>
</section>