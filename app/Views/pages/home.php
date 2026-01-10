<section class="w-[70%] h-full flex flex-col px-10 py-5 bg-slate-100">
    <?php 
    if (isset($_SESSION['id'])) {
        echo '
        <div class="bg-white rounded-xl px-5 py-2 mb-4 flex items-center gap-2">
        <div class="w-10 h-10 rounded-full flex items-center justify-center bg-indigo-600 text-xl text-white font-bold relative">' . 
                ucfirst(substr($first, 0 ,1)) . ucfirst(substr($last, 0, 1)) . '
            <div class="w-3 h-3 bg-green-500 absolute right-0 bottom-0 rounded-full"></div>
        </div>
        <h1 class="text-black text-2xl font-bold">' . $first . ' ' . $last . '
        </h1>
    </div>
        ';
    }
    ?>
    <div class="w-full h-full p-5 flex flex-wrap justify-between overflow-y-auto gap-y-4" style="-ms-overflow-style: none; scrollbar-width: none;">
        <?php 
        for ($h=0; $h < count($_SESSION['blog']); $h++) { 
            echo '
            <div class="w-full max-h-[400px] rounded-xl bg-white border-2 border-blue-700 border-solid">
            <div class="w-full h-[75px] border-blue-100 border-b border-solid rounded-t-xl flex">
                <div class="flex items-center gap-3 px-3 w-1/2 h-full">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-indigo-600 text-xl text-white font-bold">'
                . ucfirst(substr($_SESSION['blog'][$h]['firstName'], 0, 1)) . ucfirst(substr($_SESSION['blog'][$h]['lastName'], 0, 1)) .
                '</div>
                    <div>
                        <p class="text-sm font-medium text-slate-800 truncate">' . $_SESSION['blog'][$h]['firstName'] . ' ' . $_SESSION['blog'][$h]['lastName'] . '</p>
                        <p class="text-xs text-slate-500 truncate">' . $_SESSION['blog'][$h]['email'] . '</p>
                    </div>
                </div>
                <div class="flex items-center justify-end px-3 w-1/2 h-full">
                    <div class="px-1 cursor-pointer">
                        <span class="role-badge inline-flex items-center px-2 py-0.5 rounded-full text-lg font-medium bg-opacity-10 bg-['. $_SESSION['blog'][$h]['color'] .'] text-[' . $_SESSION['blog'][$h]['color'] . ']">
                            <i class="fas fa-' . $_SESSION['blog'][$h]['icon'] . ' mr-1 text-lg"></i> ' . ucfirst($_SESSION['blog'][$h]['name']) . '
                        </span>
                    </div>
                </div>
            </div>
            <div class="w-full max-h-[265px] py-[10px] relative">
                <h1 class="text-black text-2xl w-full font-bold p-3">' . $_SESSION['blog'][$h]['title'] . '</h1>
                <p class="text-gray-600 w-full font-semibold p-3">' . $_SESSION['blog'][$h]['content'] . '</p>
            </div>';
            if (isset($_SESSION['id'])) {
                echo '
            <div class="w-full h-[50px] border-blue-100 border-t border-solid rounded-b-xl flex items-center gap-x-10 px-5 relative">
                <i id="like' . $_SESSION['blog'][$h]['id'] . '" data-name="no" class="likes cursor-pointer fas fa-heart text-slate-400 text-lg flex items-center gap-2"><span class="text-sm">' . $_SESSION['blog'][$h]['likes_count'] . '</span></i>
                <form method="get" action="comments">
                    <input type="hidden" name="comment" value="' . $_SESSION['blog'][$h]['id'] . '" />
                    <button id="two" type="submit" class="comments cursor-pointer fas fa-comment text-slate-400 text-lg flex items-center gap-2"><span class="text-sm">' . $_SESSION['blog'][$h]['comments_count'] . '</span></button>
                </form>
                <p class="text-gray-400 text-sm font-medium absolute right-5">' . $_SESSION['blog'][$h]['created_at'] . '</p>
            </div>
            </div>';
            } else {
                echo '</div>';
            }
        }
        ?>
    </div>
</section>