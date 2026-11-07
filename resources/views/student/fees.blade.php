<!DOCTYPE html>
<html lang="en" data-root="../" data-role="student">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fees — ScholarDesk</title>
    <link rel="icon" type="image/svg+xml" href="../assets/img/logo.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { 50: '#effcf9', 100: '#c9f5ec', 200: '#95e9da', 300: '#5bd5c3', 400: '#2bb9a7', 500: '#14998b', 600: '#0d7a71', 700: '#0f625b', 800: '#114e4a', 900: '#0f3f3c', 950: '#062624' },
                        accent: { 50: '#fff6ed', 100: '#ffead4', 200: '#ffd0a8', 400: '#ff8a3d', 500: '#f76b15', 600: '#e5520b', 700: '#bd3d0b' },
                        canvas: '#f4f6f5'
                    },
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'] }
                }
            }
        };
    </script>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="https://unpkg.com/lucide@0.460.0/dist/umd/lucide.min.js"></script>
    <script src="../assets/js/app.js"></script>
</head>
<body class="bg-canvas text-slate-900 font-sans antialiased min-h-screen">
    <!-- Start: Sidebar toggle (checkbox, no JavaScript) -->
    <input type="checkbox" id="sidebar-toggle" class="peer hidden">
    <label for="sidebar-toggle" class="fixed inset-0 bg-slate-900/40 z-30 hidden peer-checked:block lg:!hidden"></label>
    <!-- End: Sidebar toggle -->

    <!-- Start: Sidebar -->
    <aside class="fixed top-0 left-0 z-40 w-[260px] h-screen -translate-x-full peer-checked:translate-x-0 lg:translate-x-0 transition-transform bg-brand-950 text-brand-100 flex flex-col sidebar-pattern">
        <a href="../student/dashboard.html" class="flex items-center gap-3 px-5 h-16 border-b border-white/10 shrink-0">
            <img src="../assets/img/logo.svg" alt="ScholarDesk" class="h-9 w-9">
            <div class="leading-tight">
                <p class="font-extrabold text-white tracking-tight">ScholarDesk</p>
                <p class="text-[11px] text-brand-300">Student Management System</p>
            </div>
        </a>
        <nav class="flex-1 px-3 py-6 overflow-y-auto sidebar-scrollbar">
            <div class="mb-6"><p class="nav-label">Overview</p><div class="space-y-1"><a href="../student/dashboard.html" class="nav-item"><i data-lucide="layout-dashboard" class="w-[18px] h-[18px]"></i><span>Dashboard</span></a><a href="../student/notifications.html" class="nav-item"><i data-lucide="bell" class="w-[18px] h-[18px]"></i><span>Notifications</span></a></div></div><div class="mb-6"><p class="nav-label">Academics</p><div class="space-y-1"><a href="../student/courses.html" class="nav-item"><i data-lucide="book-open-check" class="w-[18px] h-[18px]"></i><span>Course registration</span></a><a href="../student/timetable.html" class="nav-item"><i data-lucide="calendar-days" class="w-[18px] h-[18px]"></i><span>Timetable</span></a><a href="../student/attendance.html" class="nav-item"><i data-lucide="user-check" class="w-[18px] h-[18px]"></i><span>Attendance</span></a><a href="../student/results.html" class="nav-item"><i data-lucide="award" class="w-[18px] h-[18px]"></i><span>Results &amp; transcript</span></a></div></div><div class="mb-6"><p class="nav-label">Finance</p><div class="space-y-1"><a href="../student/fees.html" class="nav-item nav-item-active"><i data-lucide="wallet" class="w-[18px] h-[18px]"></i><span>Fees &amp; payments</span></a></div></div><div class="mb-6"><p class="nav-label">Account</p><div class="space-y-1"><a href="../student/profile.html" class="nav-item"><i data-lucide="user-round-cog" class="w-[18px] h-[18px]"></i><span>My profile</span></a></div></div>
        </nav>
        <!-- Start: Sidebar user card -->
        <div class="p-3 border-t border-white/10">
            <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5">
                <div class="relative">
                    <div class="w-10 h-10 rounded-full bg-accent-500 text-white flex items-center justify-center text-sm font-bold" data-u="initials">SN</div>
                    <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-400 border-2 border-brand-950 rounded-full"></span>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-semibold text-white truncate" data-u="name">Sarah Nakato</p>
                    <p class="text-[11px] text-brand-300 truncate">2400714521 · BBC Year 2</p>
                </div>
                <a href="../login.html" data-logout title="Sign out" class="p-1.5 rounded-lg text-brand-300 hover:text-white hover:bg-white/10"><i data-lucide="log-out" class="w-4 h-4"></i></a>
            </div>
        </div>
        <!-- End: Sidebar user card -->
    </aside>
    <!-- End: Sidebar -->

    <!-- Start: Main column -->
    <div class="lg:pl-[260px] min-h-screen flex flex-col">
        <!-- Start: Top bar -->
        <header class="sticky top-0 z-20 h-16 bg-white/85 backdrop-blur border-b border-slate-200/80">
            <div class="h-full px-4 sm:px-8 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3 flex-1">
                    <label for="sidebar-toggle" class="lg:hidden p-2 -ml-2 text-slate-600 rounded-lg hover:bg-slate-100 cursor-pointer"><span class="sr-only">Open menu</span><i data-lucide="menu" class="w-6 h-6"></i></label>
                    <div class="relative hidden md:block w-full max-w-sm">
                        <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                        <input type="search" placeholder="Search students, courses, programmes…" class="w-full pl-9 pr-3 py-2 rounded-xl bg-slate-100 border border-transparent text-sm focus:outline-none focus:bg-white focus:border-brand-400">
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="hidden sm:inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-full bg-brand-50 text-brand-700"><i data-lucide="calendar" class="w-3.5 h-3.5"></i>2026/27 · Semester I</span>
                    <!-- Start: Notifications -->
                    <details class="menu-dropdown relative">
                        <summary class="relative p-2 rounded-lg text-slate-500 hover:bg-slate-100 hover:text-slate-900 cursor-pointer">
                            <i data-lucide="bell" class="w-5 h-5"></i>
                            <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-accent-500 ring-2 ring-white"></span>
                        </summary>
                        <div class="absolute right-0 mt-2 w-80 bg-white border border-slate-200 rounded-xl shadow-xl overflow-hidden z-50">
                            <div class="px-4 py-3 flex justify-between items-center"><p class="text-sm font-bold">Notifications</p><span class="text-xs text-accent-600 font-semibold">2 new</span></div>
                            <a href="../student/results.html" class="block px-4 py-3 hover:bg-slate-50 border-t border-slate-100"><p class="text-sm">Results for <b>BBC2104</b> are out</p><p class="text-xs text-slate-500 mt-1">Accounting Information Systems · 20 min ago</p></a><a href="../student/fees.html" class="block px-4 py-3 hover:bg-slate-50 border-t border-slate-100"><p class="text-sm">Fees balance reminder</p><p class="text-xs text-slate-500 mt-1">UGX 650,000 due before 15 Nov · 2 hrs ago</p></a>
                        </div>
                    </details>
                    <!-- End: Notifications -->
                    <!-- Start: User menu -->
                    <details class="menu-dropdown relative">
                        <summary class="flex items-center gap-2 p-1 pr-2 rounded-xl hover:bg-slate-100 cursor-pointer">
                            <div class="w-8 h-8 rounded-full bg-brand-700 text-white flex items-center justify-center text-xs font-bold" data-u="initials">SN</div>
                            <div class="hidden md:block leading-tight text-left">
                                <p class="text-xs font-bold" data-u="name">Sarah Nakato</p>
                                <p class="text-[10px] text-slate-500">Student</p>
                            </div>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400"></i>
                        </summary>
                        <div class="absolute right-0 mt-2 w-60 bg-white border border-slate-200 rounded-xl shadow-xl overflow-hidden z-50">
                            <div class="px-4 py-3 bg-slate-50 border-b border-slate-100"><p class="text-sm font-bold" data-u="name">Sarah Nakato</p><p class="text-xs text-slate-500 truncate" data-u="email">sarah.nakato@students.campus.ac.ug</p></div>
                            <a href="../student/profile.html" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50"><i data-lucide="user" class="w-4 h-4"></i>My profile</a>
                            <a href="../reset-password.html" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50"><i data-lucide="key-round" class="w-4 h-4"></i>Change password</a>
                            <a href="../login.html" data-logout class="flex items-center gap-2 px-4 py-2.5 text-sm text-accent-600 hover:bg-accent-50 border-t border-slate-100"><i data-lucide="log-out" class="w-4 h-4"></i>Sign out</a>
                        </div>
                    </details>
                    <!-- End: User menu -->
                </div>
            </div>
        </header>
        <!-- End: Top bar -->

        <main class="flex-1 px-4 sm:px-8 py-8 animate-rise">
            <!-- Start: Page heading -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-7">
                <div>
                    
                    <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">Fees &amp; payments</h1>
                    <p class="text-slate-500 mt-1 text-sm">Semester I, 2026/27 · Evening programme · Private sponsorship</p>
                </div>
                <div class="flex flex-wrap gap-2"><a href="#" class="btn-ghost"><i data-lucide="download" class="w-4 h-4"></i>Download invoice</a><a href="#pay" class="btn-accent"><i data-lucide="credit-card" class="w-4 h-4"></i>Pay now</a></div>
            </div>
            <!-- End: Page heading -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Start: Balance card -->
                <div class="lg:col-span-1 rounded-2xl bg-gradient-to-br from-brand-700 to-brand-950 text-white p-6 relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 w-36 h-36 rounded-full bg-accent-500/30 blur-2xl"></div>
                    <p class="text-sm text-brand-200">Balance due</p>
                    <p class="text-4xl font-extrabold tracking-tight mt-1">UGX 650,000</p>
                    <p class="text-xs text-brand-200 mt-1">Due by 15 November 2026</p>
                    <div class="mt-6"><div class="flex justify-between text-xs mb-1.5"><span>Paid 65%</span><span>UGX 1,200,000 of 1,850,000</span></div><div class="h-2 rounded-full bg-white/15"><div class="h-2 rounded-full bg-accent-400" style="width:65%"></div></div></div>
                </div>
                <!-- End: Balance card -->
                <!-- Start: Breakdown -->
                <div class="lg:col-span-2 card p-6">
                    <h2 class="font-bold mb-4">Invoice breakdown</h2>
                    <dl class="divide-y divide-slate-100 text-sm">
                        <div class="flex justify-between py-3"><dt class="text-slate-500">Tuition fees</dt><dd class="font-semibold">UGX 1,450,000</dd></div>
                        <div class="flex justify-between py-3"><dt class="text-slate-500">Functional fees</dt><dd class="font-semibold">UGX 250,000</dd></div>
                        <div class="flex justify-between py-3"><dt class="text-slate-500">Examination fees</dt><dd class="font-semibold">UGX 100,000</dd></div>
                        <div class="flex justify-between py-3"><dt class="text-slate-500">Library &amp; ICT</dt><dd class="font-semibold">UGX 50,000</dd></div>
                        <div class="flex justify-between py-3 text-base"><dt class="font-bold">Total</dt><dd class="font-extrabold text-brand-800">UGX 1,850,000</dd></div>
                    </dl>
                </div>
                <!-- End: Breakdown -->
            </div>

            <h2 class="font-bold text-lg mb-4">Payment history</h2>
            <div class="card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[640px]">
                        <thead><tr class="bg-slate-50"><th class="py-3 px-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Date</th><th class="py-3 px-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Reference</th><th class="py-3 px-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Method</th><th class="py-3 px-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">Amount (UGX)</th><th class="py-3 px-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Status</th></tr></thead>
                        <tbody>
                            <tr class="border-t border-slate-100 hover:bg-brand-50/40"><td class="py-3.5 px-4 text-sm text-left">14 Aug 2026</td><td class="py-3.5 px-4 text-sm text-left">PRN 2260014521-01</td><td class="py-3.5 px-4 text-sm text-left">Stanbic Bank</td><td class="py-3.5 px-4 text-sm text-right">800,000</td><td class="py-3.5 px-4 text-sm text-left"><span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full bg-brand-50 text-brand-700">Paid</span></td></tr>
<tr class="border-t border-slate-100 hover:bg-brand-50/40"><td class="py-3.5 px-4 text-sm text-left">02 Oct 2026</td><td class="py-3.5 px-4 text-sm text-left">PRN 2260014521-02</td><td class="py-3.5 px-4 text-sm text-left">MTN Mobile Money</td><td class="py-3.5 px-4 text-sm text-right">400,000</td><td class="py-3.5 px-4 text-sm text-left"><span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full bg-brand-50 text-brand-700">Paid</span></td></tr>
<tr class="border-t border-slate-100 hover:bg-brand-50/40"><td class="py-3.5 px-4 text-sm text-left">—</td><td class="py-3.5 px-4 text-sm text-left">PRN 2260014521-03</td><td class="py-3.5 px-4 text-sm text-left">Pending</td><td class="py-3.5 px-4 text-sm text-right">650,000</td><td class="py-3.5 px-4 text-sm text-left"><span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full bg-red-50 text-red-600">Unpaid</span></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Start: Pay -->
            <div id="pay" class="card p-6 mt-8">
                <h2 class="font-bold text-lg mb-1">Generate a payment reference (PRN)</h2>
                <p class="text-sm text-slate-500 mb-5">Use the PRN at any partner bank or on mobile money. Payments reflect within 24 hours.</p>
                <form action="fees.html" method="get" class="grid sm:grid-cols-3 gap-5 items-end">
                    <div class="">
                            <label for="amount" class="field-label">Amount (UGX) <span class="text-accent-600">*</span></label>
                            <input type="number" id="amount" name="amount" placeholder="650000" value="650000" required class="input-field">
                        </div>
                    <div class="">
                            <label for="method" class="field-label">Pay with <span class="text-accent-600">*</span></label>
                            <select id="method" name="method" required class="input-field"><option selected>MTN Mobile Money</option><option>Airtel Money</option><option>Stanbic Bank</option><option>Centenary Bank</option></select>
                        </div>
                    <div><button class="btn-accent w-full justify-center py-3">Generate PRN</button></div>
                </form>
            </div>
            <!-- End: Pay -->
        </main>

        <!-- Start: Footer -->
        <footer class="border-t border-slate-200 bg-white">
            <div class="px-4 sm:px-8 py-4 flex flex-col md:flex-row justify-between items-center gap-2 text-xs text-slate-500">
                <p>© 2026 <span class="font-bold text-brand-800">ScholarDesk</span> · Student Management System</p>
                <p>Academic Registrar · Finance · Faculties · ICT</p>
            </div>
        </footer>
        <!-- End: Footer -->
    </div>
    <!-- End: Main column -->

    <script>lucide.createIcons();</script>
</body>
</html>
