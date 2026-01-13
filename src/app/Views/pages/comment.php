<section class="w-[70%] h-full flex flex-col px-10 py-5 bg-slate-100">
    <?php
    if (isset($_SESSION['id'])) {
        echo '
        <div class="bg-white rounded-xl px-5 py-2 mb-4 flex items-center gap-2">
        <div class="w-10 h-10 rounded-full flex items-center justify-center bg-indigo-600 text-xl text-white font-bold relative">' .
            ucfirst(substr($first, 0, 1)) . ucfirst(substr($last, 0, 1)) . '
            <div class="w-3 h-3 bg-green-500 absolute right-0 bottom-0 rounded-full"></div>
        </div>
        <h1 class="text-black text-2xl font-bold">' . $first . ' ' . $last . '
        </h1>
    </div>
        ';
    }
    ?>
    <div class="bg-white w-full h-full rounded-xl px-5 py-3 mb-4">
        <div class="w-full h-[75px] border-blue-100 border-b border-solid rounded-t-xl flex">
            <div class="flex items-center gap-3 px-3 w-1/2 h-full">
                <div class="w-10 h-10 rounded-full flex items-center justify-center bg-indigo-600 text-xl text-white font-bold">
                    <?php echo ucfirst(substr($_SESSION['oneblog']['firstName'], 0, 1)) . ucfirst(substr($_SESSION['oneblog']['lastName'], 0, 1)); ?>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-800 truncate"><?php echo $_SESSION['oneblog']['firstName'] . ' ' . $_SESSION['oneblog']['lastName']; ?></p>
                    <p class="text-xs text-slate-500 truncate"><?php echo $_SESSION['oneblog']['email']; ?></p>
                </div>
            </div>
            <div class="flex items-center justify-end px-3 w-1/2 h-full">
                <div class="px-1 cursor-pointer">
                    <span class="role-badge inline-flex items-center px-2 py-0.5 rounded-full text-lg font-medium bg-opacity-10 bg-[<?php echo $_SESSION['oneblog']['color']; ?>] text-[<?php echo $_SESSION['oneblog']['color']; ?>]">
                        <i class="fas fa-<?php echo $_SESSION['oneblog']['icon']; ?> mr-1 text-lg"></i><?php echo ucfirst($_SESSION['oneblog']['name']); ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="w-full py-[10px] relative">
            <h1 class="text-black text-2xl w-full font-bold p-3"><?php echo $_SESSION['oneblog']['title']; ?></h1>
            <p class="text-gray-600 w-full font-semibold p-3"><?php echo $_SESSION['oneblog']['content']; ?></p>
        </div>
        <div class="w-full h-[40%] bg-white rounded-xl mt-4">
            <div class="w-full h-16 flex items-center bg-blue-100 rounded-t-xl">
                <h1 class="w-1/5 h-full flex gap-5 items-center px-4 text-xl font-semibold text-gray-500"><i class="fas fa-comment"></i> Comments (<?php echo count($_SESSION['allcomment']) ?>)</h1>
            </div>
            <div class="w-full h-[85%] overflow-y-auto bg-white  border-x border-solid border-blue-100">
                <?php 
                for ($i=0; $i < count($_SESSION['allcomment']); $i++) { 
                    echo '
                    <div class="border-b border-solid">
                    <div class="flex items-center gap-3 px-3 pt-5 w-full">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center bg-indigo-600 text-xl text-white font-bold">
                            ' . ucfirst(substr($_SESSION['allcomment'][$i]['firstName'], 0, 1)) . ucfirst(substr($_SESSION['allcomment'][$i]['lastName'], 0, 1)) . '
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-800 truncate">' . $_SESSION['allcomment'][$i]['firstName'] . ' ' . $_SESSION['allcomment'][$i]['lastName'] . '</p>
                            <p class="text-xs text-slate-500 truncate">' . $_SESSION['allcomment'][$i]['email'] . '</p>
                        </div>
                    </div>
                    <p class="text-gray-600 w-full font-semibold p-3">' . $_SESSION['allcomment'][$i]['content'] . '</p>
                    <p class="w-full px-5 py-3 flex justify-end text-gray-400">' . $_SESSION['allcomment'][$i]['created_at'] . '</p>
                </div>
                    ';
                }
                ?>
            </div>
        </div>
        <form action="sendcomment" method="POST" class="w-full h-16 flex items-center justify-center bg-blue-100 rounded-b-xl relative">
            <input name="pushcomment" type="text" placeholder="Comment..." class="w-[98%] px-3 py-2 text-sm border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
            <button type="submit" class="fas fa-paper-plane text-sm text-gray-500 absolute right-8 top-6 cursor-pointer"></button>
        </form>
    </div>
    </div>
</section>