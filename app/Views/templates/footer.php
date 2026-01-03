<footer class="w-[15%] h-full py-5 z-[9999 bg-white">
    <div class="h-full flex flex-col justify-between">
        <div class="p-4">
            <p class="text-[10px] font-bold text-slate-400 px-3 mb-4">ACCOUNT</p>

            <?php 
            if (!isset($_SESSION['id'])) {
                if (isset($_SESSION['newuser']) && $_SESSION['newuser'] != 'yes') {
                    echo '
                    <div class="auth-forms">
                <form method="post" class="signin-form space-y-4">
                    <input name="signin"/>
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
                        <button type="submit" class="signin-btn w-full bg-indigo-600 text-white py-2 rounded-md font-medium hover:bg-indigo-700 transition">
                            Sign In
                        </button>
                    </div>
                </form>
                <form method="post">
                    <div class="text-center">
                        <p class="text-xs text-slate-500">Don\'t have an account?</p>
                        <button type="submit" class="toggle-to-signup text-xs text-indigo-600 font-medium hover:text-indigo-800 transition mt-1">
                            Create Account
                        </button>
                    </div>
                </form>
            </div>
                    ';
                } else {
                    echo '
                    <form method="post" class="signup-form space-y-4">
                    <input name="signup"/>
                    <div class="space-y-3">
                        <div class="relative">
                            <i class="fas fa-user absolute left-3 top-3 text-slate-400 text-sm"></i>
                            <input name="first" type="text" placeholder="First Name" class="w-full pl-10 pr-3 py-2 text-sm border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div class="relative">
                            <i class="fas fa-user absolute left-3 top-3 text-slate-400 text-sm"></i>
                            <input name="last" type="text" placeholder="Last Name" class="w-full pl-10 pr-3 py-2 text-sm border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-3 top-3 text-slate-400 text-sm"></i>
                            <input name="email" type="email" placeholder="Email" class="w-full pl-10 pr-3 py-2 text-sm border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-3 top-3 text-slate-400 text-sm"></i>
                            <input name="password" type="password" placeholder="Password" class="w-full pl-10 pr-3 py-2 text-sm border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-3 top-3 text-slate-400 text-sm"></i>
                            <input name="passwordCeck" type="password" placeholder="Confirm Password" class="w-full pl-10 pr-3 py-2 text-sm border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        
                        <label class="flex items-start space-x-2 cursor-pointer px-1">
                            <input type="checkbox" class="w-3 h-3 text-indigo-600 rounded focus:ring-indigo-500 mt-1" required>
                            <span class="text-xs text-slate-600">
                                I agree to the <a href="#" class="text-indigo-600 hover:text-indigo-800">Terms & Conditions</a> and <a href="#" class="text-indigo-600 hover:text-indigo-800">Privacy Policy</a>
                            </span>
                        </label>
                        <button type="submit" class="signup-btn w-full bg-green-600 text-white py-2 rounded-md font-medium hover:bg-green-700 transition">
                            Create Account
                        </button>
                    </div>
                </from>
                <form method="post">
                    <div class="text-center">
                        <p class="text-xs text-slate-500">Already have an account?</p>
                        <button type="submit" class="toggle-to-signin text-xs text-indigo-600 font-medium hover:text-indigo-800 transition mt-1">
                            Sign In
                        </button>
                    </div>
                </form>
                    ';
                }
            } else {
                echo '
                <div class="user-profile space-y-4">
                <div class="flex items-center gap-3 px-3">
                    <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-indigo-600"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-800 truncate">John Doe</p>
                        <p class="text-xs text-slate-500 truncate">Reader</p>
                        -- Role Badge --
                        <div class="mt-1">
                            <span class="role-badge inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-user mr-1 text-xs"></i> Reader
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-2">
                    <a href="profile" class="text-slate-600 hover:bg-slate-100 w-full flex items-center gap-3 px-3 py-2 rounded-md transition font-medium">
                        <i class="fas fa-user-cog text-sm"></i> Profile Settings
                    </a>
                    <a href="settings" class="text-slate-600 hover:bg-slate-100 w-full flex items-center gap-3 px-3 py-2 rounded-md transition font-medium">
                        <i class="fas fa-cog text-sm"></i> Account Settings
                    </a>
                    
                    -- Request Author Button (Only show if user is not an author/admin) --
                    <button class="request-author-btn w-full flex items-center justify-center gap-2 px-3 py-2 mt-4 bg-purple-50 text-purple-700 rounded-md hover:bg-purple-100 transition font-medium border border-purple-200">
                        <i class="fas fa-feather-alt"></i>
                        <span>Request Author Role</span>
                    </button>
                    
                    -- Upgrade to Author Section (Shows after request) --
                    <div class="author-upgrade-info hidden space-y-2 p-3 bg-yellow-50 rounded-md border border-yellow-200">
                        <div class="flex items-start gap-2">
                            <i class="fas fa-clock text-yellow-600 mt-0.5"></i>
                            <div>
                                <p class="text-xs font-medium text-yellow-800">Author Request Pending</p>
                                <p class="text-xs text-yellow-600 mt-1">Your request is under review by administrators.</p>
                            </div>
                        </div>
                        <button class="cancel-request-btn w-full text-xs text-red-600 hover:text-red-800 font-medium">
                            Cancel Request
                        </button>
                    </div>
                </div>
            </div>
            <form method="post" class="p-4 border-t border-slate-100 space-y-3">
                <button type="submit" class="signout-btn w-full flex items-center justify-center gap-2 px-3 py-2 bg-red-50 text-red-600 rounded-md hover:bg-red-100 transition font-medium">
                    <input name="logout"/>
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Sign Out</span>
                </button>
            </form>
                ';
            }
            ?>
            
        </div>
    </div>
</footer>