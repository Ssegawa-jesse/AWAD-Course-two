<!DOCTYPE html>
<html lang="en" data-root="../../" data-role="admin">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add student — ScholarDesk</title>
    <link rel="icon" type="image/svg+xml" href="../../assets/img/logo.svg">
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
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <script src="https://unpkg.com/lucide@0.460.0/dist/umd/lucide.min.js"></script>
    <script src="../../assets/js/app.js"></script>
</head>
<body class="bg-canvas text-slate-900 font-sans antialiased min-h-screen">
    <!-- Start: Sidebar toggle (checkbox, no JavaScript) -->
    <input type="checkbox" id="sidebar-toggle" class="peer hidden">
    <label for="sidebar-toggle" class="fixed inset-0 bg-slate-900/40 z-30 hidden peer-checked:block lg:!hidden"></label>
    <!-- End: Sidebar toggle -->

    <!-- Start: Sidebar -->
    <aside class="fixed top-0 left-0 z-40 w-[260px] h-screen -translate-x-full peer-checked:translate-x-0 lg:translate-x-0 transition-transform bg-brand-950 text-brand-100 flex flex-col sidebar-pattern">
        <a href="../../admin/dashboard.html" class="flex items-center gap-3 px-5 h-16 border-b border-white/10 shrink-0">
            <img src="../../assets/img/logo.svg" alt="ScholarDesk" class="h-9 w-9">
            <div class="leading-tight">
                <p class="font-extrabold text-white tracking-tight">ScholarDesk</p>
                <p class="text-[11px] text-brand-300">Student Management System</p>
            </div>
        </a>
        <nav class="flex-1 px-3 py-6 overflow-y-auto sidebar-scrollbar">
            <div class="mb-6"><p class="nav-label">Overview</p><div class="space-y-1"><a href="../../admin/dashboard.html" class="nav-item"><i data-lucide="layout-dashboard" class="w-[18px] h-[18px]"></i><span>Dashboard</span></a><a href="../../admin/applications/index.html" class="nav-item"><i data-lucide="user-check" class="w-[18px] h-[18px]"></i><span>Approvals</span></a></div></div><div class="mb-6"><p class="nav-label">Records</p><div class="space-y-1"><a href="../../admin/students/index.html" class="nav-item nav-item-active"><i data-lucide="graduation-cap" class="w-[18px] h-[18px]"></i><span>Students</span></a><a href="../../admin/lecturers/index.html" class="nav-item"><i data-lucide="presentation" class="w-[18px] h-[18px]"></i><span>Lecturers</span></a></div></div><div class="mb-6"><p class="nav-label">Academics</p><div class="space-y-1"><a href="../../admin/programmes/index.html" class="nav-item"><i data-lucide="layers" class="w-[18px] h-[18px]"></i><span>Programmes</span></a><a href="../../admin/courses/index.html" class="nav-item"><i data-lucide="library" class="w-[18px] h-[18px]"></i><span>Course units</span></a><a href="../../admin/reports.html" class="nav-item"><i data-lucide="bar-chart-3" class="w-[18px] h-[18px]"></i><span>Reports</span></a></div></div>
        </nav>
        <!-- Start: Sidebar user card -->
        <div class="p-3 border-t border-white/10">
            <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5">
                <div class="relative">
                    <div class="w-10 h-10 rounded-full bg-accent-500 text-white flex items-center justify-center text-sm font-bold" data-u="initials">RG</div>
                    <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-400 border-2 border-brand-950 rounded-full"></span>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-semibold text-white truncate" data-u="name">Registrar</p>
                    <p class="text-[11px] text-brand-300 truncate">Academic Registrar's Office</p>
                </div>
                <a href="../../login.html" data-logout title="Sign out" class="p-1.5 rounded-lg text-brand-300 hover:text-white hover:bg-white/10"><i data-lucide="log-out" class="w-4 h-4"></i></a>
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
                            <a href="../../admin/applications/index.html" class="block px-4 py-3 hover:bg-slate-50 border-t border-slate-100"><p class="text-sm">New registrations waiting</p><p class="text-xs text-slate-500 mt-1">Students and lecturers to approve · 10 min ago</p></a><a href="../../admin/reports.html" class="block px-4 py-3 hover:bg-slate-50 border-t border-slate-100"><p class="text-sm">Marks submitted for BBC2101</p><p class="text-xs text-slate-500 mt-1">Dr. Moses Kato · 1 hr ago</p></a>
                        </div>
                    </details>
                    <!-- End: Notifications -->
                    <!-- Start: User menu -->
                    <details class="menu-dropdown relative">
                        <summary class="flex items-center gap-2 p-1 pr-2 rounded-xl hover:bg-slate-100 cursor-pointer">
                            <div class="w-8 h-8 rounded-full bg-brand-700 text-white flex items-center justify-center text-xs font-bold" data-u="initials">RG</div>
                            <div class="hidden md:block leading-tight text-left">
                                <p class="text-xs font-bold" data-u="name">Registrar</p>
                                <p class="text-[10px] text-slate-500">Registrar</p>
                            </div>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400"></i>
                        </summary>
                        <div class="absolute right-0 mt-2 w-60 bg-white border border-slate-200 rounded-xl shadow-xl overflow-hidden z-50">
                            <div class="px-4 py-3 bg-slate-50 border-b border-slate-100"><p class="text-sm font-bold" data-u="name">Registrar</p><p class="text-xs text-slate-500 truncate" data-u="email">2400725284@mubs.ac.ug</p></div>
                            <a href="#" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50"><i data-lucide="user" class="w-4 h-4"></i>My profile</a>
                            <a href="../../reset-password.html" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50"><i data-lucide="key-round" class="w-4 h-4"></i>Change password</a>
                            <a href="../../login.html" data-logout class="flex items-center gap-2 px-4 py-2.5 text-sm text-accent-600 hover:bg-accent-50 border-t border-slate-100"><i data-lucide="log-out" class="w-4 h-4"></i>Sign out</a>
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
                    <nav class="flex items-center gap-2 text-xs text-slate-400 mb-2"><a href="index.html" class="hover:text-brand-700">Students</a><i data-lucide="chevron-right" class="w-3 h-3"></i><span class="text-slate-700">Add student</span></nav>
                    <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">Add student</h1>
                    <p class="text-slate-500 mt-1 text-sm">Use this for walk-in registrations. Online registrations appear under Approvals.</p>
                </div>
                
            </div>
            <!-- End: Page heading -->
            <form action="index.html" method="get" class="space-y-6 max-w-4xl">
                <div class="card">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-brand-50 flex items-center justify-center"><i data-lucide="user-round" class="w-4 h-4 text-brand-600"></i></div>
                        <div><h2 class="font-bold">Personal details</h2><p class="text-xs text-slate-500">Legal name and contact</p></div>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                        
                    <div class="">
                            <label for="first_name" class="field-label">First name <span class="text-accent-600">*</span></label>
                            <input type="text" id="first_name" name="first_name" placeholder="First name" required class="input-field">
                        </div>
                    <div class="">
                            <label for="last_name" class="field-label">Last name <span class="text-accent-600">*</span></label>
                            <input type="text" id="last_name" name="last_name" placeholder="Last name" required class="input-field">
                        </div>
                    <div class="">
                            <label for="gender" class="field-label">Gender <span class="text-accent-600">*</span></label>
                            <select id="gender" name="gender" required class="input-field"><option value="" disabled selected>Choose…</option><option>Female</option><option>Male</option></select>
                        </div>
                    <div class="">
                            <label for="dob" class="field-label">Date of birth <span class="text-accent-600">*</span></label>
                            <input type="date" id="dob" name="dob" placeholder="" required class="input-field">
                        </div>
                    <div class="">
                            <label for="phone" class="field-label">Phone <span class="text-accent-600">*</span></label>
                            <input type="tel" id="phone" name="phone" placeholder="+256 7XX XXX XXX" required class="input-field">
                        </div>
                    <div class="">
                            <label for="email" class="field-label">Email <span class="text-accent-600">*</span></label>
                            <input type="email" id="email" name="email" placeholder="name@students.campus.ac.ug" required class="input-field">
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-brand-50 flex items-center justify-center"><i data-lucide="graduation-cap" class="w-4 h-4 text-brand-600"></i></div>
                        <div><h2 class="font-bold">Academic record</h2><p class="text-xs text-slate-500">Programme and status</p></div>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                        
                    <div class="">
                            <label for="student_no" class="field-label">Student number</label>
                            <input type="text" id="student_no" name="student_no" placeholder="Auto-generated if blank" class="input-field">
                        </div>
                    <div class="">
                            <label for="reg_no" class="field-label">Registration number</label>
                            <input type="text" id="reg_no" name="reg_no" placeholder="24/U/00000/DAY" class="input-field">
                        </div>
                    <div class="sm:col-span-2">
                            <label for="programme" class="field-label">Programme <span class="text-accent-600">*</span></label>
                            <select id="programme" name="programme" required class="input-field"><option value="" disabled selected>Choose…</option><option>Bachelor of Business Computing (BBC)</option><option>Bachelor of Information Technology (BIT)</option><option>Bachelor of Commerce (BCOM)</option><option>Bachelor of Procurement &amp; Logistics (BPLM)</option><option>Bachelor of Human Resource Management (BHRM)</option><option>Diploma in Computer Science (DCS)</option></select>
                        </div>
                    <div class="">
                            <label for="year" class="field-label">Year of study <span class="text-accent-600">*</span></label>
                            <select id="year" name="year" required class="input-field"><option value="" disabled selected>Choose…</option><option>Year 1</option><option>Year 2</option><option>Year 3</option><option>Year 4</option></select>
                        </div>
                    <div class="">
                            <label for="mode" class="field-label">Study mode <span class="text-accent-600">*</span></label>
                            <select id="mode" name="mode" required class="input-field"><option value="" disabled selected>Choose…</option><option>Day</option><option>Evening</option><option>Weekend</option></select>
                        </div>
                    <div class="">
                            <label for="sponsorship" class="field-label">Sponsorship <span class="text-accent-600">*</span></label>
                            <select id="sponsorship" name="sponsorship" required class="input-field"><option value="" disabled selected>Choose…</option><option>Private</option><option>Government</option><option>Scholarship</option></select>
                        </div>
                    <div class="">
                            <label for="status" class="field-label">Status <span class="text-accent-600">*</span></label>
                            <select id="status" name="status" required class="input-field"><option selected>Active</option><option>Suspended</option><option>Inactive</option><option>Graduated</option></select>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-brand-50 flex items-center justify-center"><i data-lucide="users-round" class="w-4 h-4 text-brand-600"></i></div>
                        <div><h2 class="font-bold">Next of kin</h2><p class="text-xs text-slate-500">Emergency contact</p></div>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                        
                    <div class="">
                            <label for="kin_name" class="field-label">Full name <span class="text-accent-600">*</span></label>
                            <input type="text" id="kin_name" name="kin_name" placeholder="Full name" required class="input-field">
                        </div>
                    <div class="">
                            <label for="kin_phone" class="field-label">Phone <span class="text-accent-600">*</span></label>
                            <input type="tel" id="kin_phone" name="kin_phone" placeholder="+256 7XX XXX XXX" required class="input-field">
                        </div>
                    </div>
                </div>
                <div class="flex justify-between gap-3"><a href="index.html" class="btn-ghost">Cancel</a><button class="btn-primary">Save student<i data-lucide="check" class="w-4 h-4"></i></button></div>
            </form>
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
