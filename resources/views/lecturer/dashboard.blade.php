<!DOCTYPE html>
<html lang="en" data-root="../" data-role="lecturer">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer dashboard — ScholarDesk</title>
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
        <a href="../lecturer/dashboard.html" class="flex items-center gap-3 px-5 h-16 border-b border-white/10 shrink-0">
            <img src="../assets/img/logo.svg" alt="ScholarDesk" class="h-9 w-9">
            <div class="leading-tight">
                <p class="font-extrabold text-white tracking-tight">ScholarDesk</p>
                <p class="text-[11px] text-brand-300">Student Management System</p>
            </div>
        </a>
        <nav class="flex-1 px-3 py-6 overflow-y-auto sidebar-scrollbar">
            <div class="mb-6"><p class="nav-label">Overview</p><div class="space-y-1"><a href="../lecturer/dashboard.html" class="nav-item nav-item-active"><i data-lucide="layout-dashboard" class="w-[18px] h-[18px]"></i><span>Dashboard</span></a></div></div><div class="mb-6"><p class="nav-label">Teaching</p><div class="space-y-1"><a href="../lecturer/classes.html" class="nav-item"><i data-lucide="users-round" class="w-[18px] h-[18px]"></i><span>My classes</span></a><a href="../lecturer/attendance.html" class="nav-item"><i data-lucide="clipboard-check" class="w-[18px] h-[18px]"></i><span>Take attendance</span></a><a href="../lecturer/marks.html" class="nav-item"><i data-lucide="pen-line" class="w-[18px] h-[18px]"></i><span>Enter marks</span></a></div></div>
        </nav>
        <!-- Start: Sidebar user card -->
        <div class="p-3 border-t border-white/10">
            <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5">
                <div class="relative">
                    <div class="w-10 h-10 rounded-full bg-accent-500 text-white flex items-center justify-center text-sm font-bold" data-u="initials">MK</div>
                    <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-400 border-2 border-brand-950 rounded-full"></span>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-semibold text-white truncate" data-u="name">Dr. Moses Kato</p>
                    <p class="text-[11px] text-brand-300 truncate">Dept. of Business Computing</p>
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
                            <a href="../lecturer/marks.html" class="block px-4 py-3 hover:bg-slate-50 border-t border-slate-100"><p class="text-sm">Marks deadline in <b>6 days</b></p><p class="text-xs text-slate-500 mt-1">BBC2101 coursework marks · today</p></a><a href="../lecturer/classes.html" class="block px-4 py-3 hover:bg-slate-50 border-t border-slate-100"><p class="text-sm">3 students added to BBC2102</p><p class="text-xs text-slate-500 mt-1">Late registration approved · yesterday</p></a>
                        </div>
                    </details>
                    <!-- End: Notifications -->
                    <!-- Start: User menu -->
                    <details class="menu-dropdown relative">
                        <summary class="flex items-center gap-2 p-1 pr-2 rounded-xl hover:bg-slate-100 cursor-pointer">
                            <div class="w-8 h-8 rounded-full bg-brand-700 text-white flex items-center justify-center text-xs font-bold" data-u="initials">MK</div>
                            <div class="hidden md:block leading-tight text-left">
                                <p class="text-xs font-bold" data-u="name">Dr. Moses Kato</p>
                                <p class="text-[10px] text-slate-500">Lecturer</p>
                            </div>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400"></i>
                        </summary>
                        <div class="absolute right-0 mt-2 w-60 bg-white border border-slate-200 rounded-xl shadow-xl overflow-hidden z-50">
                            <div class="px-4 py-3 bg-slate-50 border-b border-slate-100"><p class="text-sm font-bold" data-u="name">Dr. Moses Kato</p><p class="text-xs text-slate-500 truncate" data-u="email">moses.kato@campus.ac.ug</p></div>
                            <a href="#" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50"><i data-lucide="user" class="w-4 h-4"></i>My profile</a>
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
                    
                    <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">Welcome, <span data-u="first">Dr. Kato</span></h1>
                    <p class="text-slate-500 mt-1 text-sm">You teach 3 classes this semester. Coursework marks are due in 6 days.</p>
                </div>
                <div class="flex flex-wrap gap-2"><a href="attendance.html" class="btn-primary"><i data-lucide="clipboard-check" class="w-4 h-4"></i>Take attendance</a><a href="marks.html" class="btn-accent"><i data-lucide="pen-line" class="w-4 h-4"></i>Enter marks</a></div>
            </div>
            <!-- End: Page heading -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
                <div class="card p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Students taught</p>
                            <p class="text-3xl font-extrabold tracking-tight mt-1">222</p>
                        </div>
                        <div class="w-11 h-11 rounded-xl bg-brand-50 flex items-center justify-center"><i data-lucide="users-round" class="w-5 h-5 text-brand-600"></i></div>
                    </div><p class="text-xs text-slate-400 mt-3">Across 3 classes</p>
                </div>
                <div class="card p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Lectures delivered</p>
                            <p class="text-3xl font-extrabold tracking-tight mt-1">41</p>
                        </div>
                        <div class="w-11 h-11 rounded-xl bg-indigo-50 flex items-center justify-center"><i data-lucide="calendar-check" class="w-5 h-5 text-indigo-600"></i></div>
                    </div><p class="text-xs text-slate-400 mt-3">of 48 planned</p>
                </div>
                <div class="card p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Average attendance</p>
                            <p class="text-3xl font-extrabold tracking-tight mt-1">87%</p>
                        </div>
                        <div class="w-11 h-11 rounded-xl bg-brand-50 flex items-center justify-center"><i data-lucide="user-check" class="w-5 h-5 text-brand-600"></i></div>
                    </div>
                </div>
                <div class="card p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Marks deadline</p>
                            <p class="text-3xl font-extrabold tracking-tight mt-1">6 days</p>
                        </div>
                        <div class="w-11 h-11 rounded-xl bg-accent-50 flex items-center justify-center"><i data-lucide="hourglass" class="w-5 h-5 text-accent-600"></i></div>
                    </div><p class="text-xs text-slate-400 mt-3">BBC2101 coursework</p>
                </div>
            </div>
            <h2 class="font-bold text-lg mb-4">My classes</h2>
            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-5 mb-8"><div class="card p-5 hover:border-brand-300 transition">
                    <div class="flex items-start justify-between mb-3"><span class="text-xs font-extrabold text-brand-700">BBC2101</span><span class="text-xs font-semibold px-2 py-1 rounded-lg bg-slate-100">86 students</span></div>
                    <p class="font-bold leading-snug">Advanced Web Application Programming</p>
                    <p class="text-xs text-slate-500 mt-1">BBC Year 2 · Day</p>
                    <div class="flex items-center gap-4 text-xs text-slate-500 mt-4 pt-4 border-t border-slate-100"><span class="flex items-center gap-1"><i data-lucide="map-pin" class="w-3.5 h-3.5"></i>Lab 3</span><span class="flex items-center gap-1"><i data-lucide="clock" class="w-3.5 h-3.5"></i>Mon 08:00, Thu 08:00</span></div>
                    <div class="grid grid-cols-2 gap-2 mt-4"><a href="attendance.html" class="btn-ghost justify-center !py-2 text-xs">Attendance</a><a href="marks.html" class="btn-primary justify-center !py-2 text-xs">Marks</a></div>
                </div><div class="card p-5 hover:border-brand-300 transition">
                    <div class="flex items-start justify-between mb-3"><span class="text-xs font-extrabold text-brand-700">BBC2101</span><span class="text-xs font-semibold px-2 py-1 rounded-lg bg-slate-100">64 students</span></div>
                    <p class="font-bold leading-snug">Advanced Web Application Programming</p>
                    <p class="text-xs text-slate-500 mt-1">BBC Year 2 · Evening</p>
                    <div class="flex items-center gap-4 text-xs text-slate-500 mt-4 pt-4 border-t border-slate-100"><span class="flex items-center gap-1"><i data-lucide="map-pin" class="w-3.5 h-3.5"></i>Lab 3</span><span class="flex items-center gap-1"><i data-lucide="clock" class="w-3.5 h-3.5"></i>Tue 17:30</span></div>
                    <div class="grid grid-cols-2 gap-2 mt-4"><a href="attendance.html" class="btn-ghost justify-center !py-2 text-xs">Attendance</a><a href="marks.html" class="btn-primary justify-center !py-2 text-xs">Marks</a></div>
                </div><div class="card p-5 hover:border-brand-300 transition">
                    <div class="flex items-start justify-between mb-3"><span class="text-xs font-extrabold text-brand-700">BIT2205</span><span class="text-xs font-semibold px-2 py-1 rounded-lg bg-slate-100">72 students</span></div>
                    <p class="font-bold leading-snug">Web Technologies</p>
                    <p class="text-xs text-slate-500 mt-1">BIT Year 2 · Day</p>
                    <div class="flex items-center gap-4 text-xs text-slate-500 mt-4 pt-4 border-t border-slate-100"><span class="flex items-center gap-1"><i data-lucide="map-pin" class="w-3.5 h-3.5"></i>Lab 1</span><span class="flex items-center gap-1"><i data-lucide="clock" class="w-3.5 h-3.5"></i>Wed 11:00</span></div>
                    <div class="grid grid-cols-2 gap-2 mt-4"><a href="attendance.html" class="btn-ghost justify-center !py-2 text-xs">Attendance</a><a href="marks.html" class="btn-primary justify-center !py-2 text-xs">Marks</a></div>
                </div></div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                <div class="card p-6">
                    <h2 class="font-bold text-lg mb-4">Marks submission</h2>
                    <div class="space-y-5">
                        <div><div class="flex justify-between text-sm mb-1.5"><span class="font-semibold">BBC2101 · Day</span><span class="text-brand-700 font-bold">86 / 86</span></div><div class="progress"><span style="width:100%"></span></div></div>
                        <div><div class="flex justify-between text-sm mb-1.5"><span class="font-semibold">BBC2101 · Evening</span><span class="text-accent-600 font-bold">40 / 64</span></div><div class="progress warn"><span style="width:62%"></span></div></div>
                        <div><div class="flex justify-between text-sm mb-1.5"><span class="font-semibold">BIT2205 · Day</span><span class="text-accent-600 font-bold">12 / 72</span></div><div class="progress warn"><span style="width:17%"></span></div></div>
                    </div>
                </div>
                <div class="card p-6">
                    <h2 class="font-bold text-lg mb-4">Students below 75% attendance</h2>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3"><div class="w-9 h-9 rounded-full bg-accent-100 text-accent-700 flex items-center justify-center text-xs font-bold shrink-0">KM</div><div class="flex-1"><p class="text-sm font-semibold">Kevin Mugabi</p><p class="text-xs text-slate-500">BBC2101 · Evening</p></div><span class="text-sm font-bold text-red-600">58%</span></div>
                        <div class="flex items-center gap-3"><div class="w-9 h-9 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center text-xs font-bold shrink-0">IL</div><div class="flex-1"><p class="text-sm font-semibold">Ibrahim Lubega</p><p class="text-xs text-slate-500">BIT2205 · Day</p></div><span class="text-sm font-bold text-red-600">63%</span></div>
                        <div class="flex items-center gap-3"><div class="w-9 h-9 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center text-xs font-bold shrink-0">RT</div><div class="flex-1"><p class="text-sm font-semibold">Ronald Tumusiime</p><p class="text-xs text-slate-500">BBC2101 · Day</p></div><span class="text-sm font-bold text-accent-600">71%</span></div>
                    </div>
                </div>
            </div>
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
