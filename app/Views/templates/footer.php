<footer class="w-[15%] h-full py-5 z-[9999 bg-white p-4">
    <p class="text-[10px] font-bold text-slate-400 px-3">ACCOUNT</p>
    <?php 
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'reader') {
            echo '
            <div class="mt-1 mb-4 px-1">
                <span class="role-badge inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    <i class="fas fa-user mr-1 text-xs"></i> Reader
                </span>
            </div>
            ';
        } elseif ($_SESSION['role'] == 'author') {
            echo '
            <div class="mt-1 mb-4 px-1">
                <span class="role-badge inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <i class="fas fa-user mr-1 text-xs"></i> Author
                </span>
            </div>
            ';
        } elseif ($_SESSION['role'] == 'admin') {
            echo '
            <div class="mt-1 mb-4 px-1">
                <span class="role-badge inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                    <i class="fas fa-user mr-1 text-xs"></i> Admin
                </span>
            </div>
            ';
        }
    } else {
        echo '
        <div class="mt-1 mb-4 px-1">
            <span class="role-badge inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                <i class="fas fa-user mr-1 text-xs"></i> Visitor
            </span>
        </div>
        ';
    }
    ?>
    <div class="h-full flex flex-col justify-between">
            <?php 
            if (!isset($_SESSION['id'])) {
                if (isset($_SESSION['newuser']) && $_SESSION['newuser'] != 'yes') {
                    echo '
                    <div class="auth-forms">
                <form method="post" class="signin-form space-y-4">
                    <div class="space-y-3">
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-3 top-3 text-slate-400 text-sm"></i>
                            <input name="email" type="email" placeholder="Email" class="w-full pl-10 pr-3 py-2 text-sm border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-3 top-3 text-slate-400 text-sm"></i>
                            <input name="password" type="password" placeholder="Password" class="w-full pl-10 pr-3 py-2 text-sm border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div class="flex items-center justify-between px-1">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="checkbox" class="w-3 h-3 text-indigo-600 rounded focus:ring-indigo-500">
                                <span class="text-xs text-slate-600">Remember me</span>
                            </label>
                            <a href="#" class="text-xs text-indigo-600 hover:text-indigo-800">Forgot password?</a>
                        </div>
                        <button type="submit" name="signin" class="signin-btn w-full bg-indigo-600 text-white py-2 rounded-md font-medium hover:bg-indigo-700 transition">
                            Sign In
                        </button>
                    </div>
                </form>
                <form method="post">
                    <div class="text-center mt-2">
                        <p class="text-xs text-slate-500">Don\'t have an account?</p>
                        <button type="submit" name="tosignup" class="toggle-to-signup text-xs text-indigo-600 font-medium hover:text-indigo-800 transition mt-1">
                            Create Account
                        </button>
                    </div>
                </form>
            </div>
                    ';
                } else {
                    echo '
                    <form method="post" class="signup-form space-y-4">
                    <div class="space-y-3">
                        <div class="relative">
                            <i class="fas fa-user absolute left-3 top-3 text-slate-400 text-sm"></i>
                            <input name="first" type="text" value="'; if (isset($_SESSION['first'])) { echo $_SESSION['first']; unset($_SESSION['first']); } echo '" placeholder="First Name" class="w-full pl-10 pr-3 py-2 text-sm border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div class="relative">
                            <i class="fas fa-user absolute left-3 top-3 text-slate-400 text-sm"></i>
                            <input name="last" type="text" value="'; if (isset($_SESSION['last'])) { echo $_SESSION['last']; unset($_SESSION['last']); } echo '" placeholder="Last Name" class="w-full pl-10 pr-3 py-2 text-sm border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-3 top-3 text-slate-400 text-sm"></i>
                            <input name="email" type="email" value="'; if (isset($_SESSION['email'])) { echo $_SESSION['email']; unset($_SESSION['email']); } echo '" placeholder="Email" class="w-full pl-10 pr-3 py-2 text-sm border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-3 top-3 text-slate-400 text-sm"></i>
                            <input name="password" type="password" value="'; if (isset($_SESSION['password'])) { echo $_SESSION['password']; unset($_SESSION['password']); } echo '" placeholder="Password" class="w-full pl-10 pr-3 py-2 text-sm border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-3 top-3 text-slate-400 text-sm"></i>
                            <input name="passwordCheck" type="password" value="'; if (isset($_SESSION['passwordCheck'])) { echo $_SESSION['passwordCheck']; unset($_SESSION['passwordCheck']); } echo '" placeholder="Confirm Password" class="w-full pl-10 pr-3 py-2 text-sm border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        
                        <label class="flex items-start space-x-2 cursor-pointer px-1">
                            <input name="policy" type="checkbox" class="w-3 h-3 text-indigo-600 rounded focus:ring-indigo-500 mt-1">
                            <span class="text-xs text-slate-600">
                                I agree to the <a href="#" class="text-indigo-600 hover:text-indigo-800">Terms & Conditions</a> and <a href="#" class="text-indigo-600 hover:text-indigo-800">Privacy Policy</a>
                            </span>
                        </label>
                        <button type="submit" name="signup" class="signup-btn w-full bg-green-600 text-white py-2 rounded-md font-medium hover:bg-green-700 transition">
                            Create Account
                        </button>
                    </div>
                </from>
                <form method="post">
                    <div class="text-center">
                        <p class="text-xs text-slate-500">Already have an account?</p>
                        <button type="submit" name="tosignin" class="toggle-to-signin text-xs text-indigo-600 font-medium hover:text-indigo-800 transition mt-1">
                            Sign In
                        </button>
                    </div>
                </form>
                    ';
                }
            } else {
                echo '
            <div class="space-y-4">
                <div class="flex items-center gap-3 px-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-indigo-600 text-xl text-white font-bold">'
                        . ucfirst(substr($first, 0 ,1)) . ucfirst(substr($last, 0, 1)) .
                    '</div>
                    <div>
                        <p class="text-sm font-medium text-slate-800 truncate">' . $first . ' ' . $last . '</p>
                        <p class="text-xs text-slate-500 truncate">'. $email .'</p>
                    </div>
                </div>
                <div class="space-y-2">';
                if (isset($_SESSION['role']) && $_SESSION['role'] == 'reader') {
                    if (isset($_SESSION['situation']) && $_SESSION['situation'] == 'no') {
                        echo '
                        <form method="POST">
                            <button type="submit" name="request" class="flex w-full items-center justify-center gap-2 px-3 py-2 mt-4 bg-purple-50 text-purple-700 rounded-md hover:bg-purple-100 transition font-medium border border-purple-200">
                                <i class="fas fa-feather-alt"></i>
                                <span>Request Author Role</span>
                            </button>
                        </form>
                        ';
                    } else {
                        echo '
                        <div class="space-y-2 p-3 bg-yellow-50 rounded-md border border-yellow-200">
                            <div class="flex items-start gap-2">
                                <i class="fas fa-clock text-yellow-600 mt-0.5"></i>
                                <div>
                                    <p class="text-xs font-medium text-yellow-800">Author Request Pending</p>
                                    <p class="text-xs text-yellow-600 mt-1">Your request is under review by administrators.</p>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                }
                echo '</div>
            </div>
            <form method="post" class="p-4 mb-10 border-t border-slate-100 space-y-3">
                <button type="submit" name="logout" class="signout-btn w-full flex items-center justify-center gap-2 px-3 py-2 bg-red-50 text-red-600 rounded-md hover:bg-red-100 transition font-medium">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Sign Out</span>
                </button>
            </form>
                ';
            }
            ?>
    </div>
</footer>