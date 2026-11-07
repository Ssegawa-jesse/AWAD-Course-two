<!DOCTYPE html>
<html lang="en" data-root="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in — ScholarDesk</title>
    <link rel="icon" type="image/svg+xml" href="assets/img/logo.svg">
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
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="https://unpkg.com/lucide@0.460.0/dist/umd/lucide.min.js"></script>
    <script src="assets/js/app.js"></script>
</head>
<body class="bg-canvas text-slate-900 font-sans antialiased min-h-screen flex flex-col">
    <!-- Start: Auth layout -->
    <div class="flex-1 grid lg:grid-cols-[minmax(0,5fr)_minmax(0,7fr)]">
        <!-- Start: Brand panel -->
        <aside class="hidden lg:flex flex-col justify-between bg-brand-950 sidebar-pattern text-white p-12 relative overflow-hidden">
            <a href="index.html" class="flex items-center gap-3">
                <img src="assets/img/logo.svg" alt="ScholarDesk" class="h-11 w-11">
                <div class="leading-tight"><p class="font-extrabold text-lg">ScholarDesk</p><p class="text-xs text-brand-300">Student Management System</p></div>
            </a>
            <div class="max-w-md">
                <h2 class="text-3xl font-extrabold leading-tight tracking-tight mb-4">One portal for students, lecturers and the registrar.</h2>
                <p class="text-brand-200 mb-8 leading-relaxed">Students register course units and see results. Lecturers take attendance and enter marks. The registrar approves new accounts and manages records.</p>
                <ul class="space-y-4"><li class="flex items-start gap-3"><span class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center shrink-0"><i data-lucide="graduation-cap" class="w-4 h-4 text-accent-400"></i></span><span class="text-sm text-brand-100 pt-1">Students: units, timetable, results, fees</span></li><li class="flex items-start gap-3"><span class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center shrink-0"><i data-lucide="presentation" class="w-4 h-4 text-accent-400"></i></span><span class="text-sm text-brand-100 pt-1">Lecturers: classes, attendance, marks</span></li><li class="flex items-start gap-3"><span class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center shrink-0"><i data-lucide="shield-check" class="w-4 h-4 text-accent-400"></i></span><span class="text-sm text-brand-100 pt-1">Registrar: approves students and lecturers</span></li></ul>
            </div>
            <div class="flex items-center gap-3 p-4 rounded-2xl bg-white/5 border border-white/10 max-w-md">
                <div class="flex -space-x-2">
                    <div class="w-8 h-8 rounded-full bg-accent-500 border-2 border-brand-950 flex items-center justify-center text-[10px] font-bold">SN</div>
                    <div class="w-8 h-8 rounded-full bg-brand-500 border-2 border-brand-950 flex items-center justify-center text-[10px] font-bold">JO</div>
                    <div class="w-8 h-8 rounded-full bg-indigo-500 border-2 border-brand-950 flex items-center justify-center text-[10px] font-bold">AK</div>
                </div>
                <p class="text-xs text-brand-200"><span class="font-bold text-white">4,812 students</span> registered for Semester I, 2026/27</p>
            </div>
        </aside>
        <!-- End: Brand panel -->

        <!-- Start: Form panel -->
        <div class="flex items-center justify-center p-5 sm:p-10">
            <div class="w-full max-w-md animate-rise">
                <a href="index.html" class="lg:hidden flex items-center gap-3 mb-8">
                    <img src="assets/img/logo.svg" alt="ScholarDesk" class="h-10 w-10">
                    <p class="font-extrabold text-brand-900">ScholarDesk</p>
                </a>
                <!-- Start: Sign in -->
                <h1 class="text-2xl font-extrabold tracking-tight">Welcome back</h1>
                <p class="text-sm text-slate-500 mt-1 mb-8">Choose who you are, then sign in with your email and password.</p>
                <form id="login-form" action="#" method="post" class="space-y-5" novalidate>
                    <div>
                        <p class="field-label">I am signing in as</p>
                        <div class="grid grid-cols-3 gap-3"><label class="cursor-pointer">
                            <input type="radio" name="role" value="student" checked class="peer sr-only">
                            <span class="flex flex-col items-center gap-1 py-3 rounded-xl border border-slate-200 bg-white text-slate-500 text-xs font-bold peer-checked:border-brand-500 peer-checked:bg-brand-50 peer-checked:text-brand-800 transition"><i data-lucide="graduation-cap" class="w-5 h-5"></i>Student</span>
                        </label><label class="cursor-pointer">
                            <input type="radio" name="role" value="lecturer" class="peer sr-only">
                            <span class="flex flex-col items-center gap-1 py-3 rounded-xl border border-slate-200 bg-white text-slate-500 text-xs font-bold peer-checked:border-brand-500 peer-checked:bg-brand-50 peer-checked:text-brand-800 transition"><i data-lucide="presentation" class="w-5 h-5"></i>Lecturer</span>
                        </label><label class="cursor-pointer">
                            <input type="radio" name="role" value="admin" class="peer sr-only">
                            <span class="flex flex-col items-center gap-1 py-3 rounded-xl border border-slate-200 bg-white text-slate-500 text-xs font-bold peer-checked:border-brand-500 peer-checked:bg-brand-50 peer-checked:text-brand-800 transition"><i data-lucide="shield-check" class="w-5 h-5"></i>Registrar</span>
                        </label></div>
                    </div>
                    <div>
                        <label for="email" class="field-label">Email</label>
                        <div class="relative">
                            <i data-lucide="at-sign" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                            <input type="email" id="email" name="email" required autofocus autocomplete="username" placeholder="you@example.com" class="input-field !pl-10">
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center"><label for="password" class="field-label">Password</label><a href="forgot-password.html" class="text-xs font-semibold text-brand-700 hover:text-brand-900 mb-1.5">Forgot password?</a></div>
                        <div class="relative">
                            <i data-lucide="lock" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                            <input type="password" id="password" name="password" required autocomplete="current-password" placeholder="••••••••" class="input-field !pl-10">
                        </div>
                    </div>
                    <!-- Start: Login error -->
                    <div id="login-error" hidden class="flex items-start gap-2 p-3 rounded-xl bg-red-50 border border-red-100 text-sm text-red-700"><i data-lucide="circle-alert" class="w-4 h-4 mt-0.5 shrink-0"></i><span></span></div>
                    <!-- End: Login error -->
                    <button type="submit" class="btn-primary w-full justify-center py-3">Sign in<i data-lucide="arrow-right" class="w-4 h-4"></i></button>
                </form>
                <!-- End: Sign in -->

                <div class="mt-8 p-4 rounded-xl bg-white border border-slate-200 text-sm text-slate-600 flex gap-3">
                    <i data-lucide="info" class="w-5 h-5 text-brand-600 shrink-0"></i>
                    <p>New students and lecturers must <a href="register.html" class="font-bold text-brand-700">register first</a>. You can sign in once the Registrar approves your registration.</p>
                </div>
            </div>
        </div>
        <!-- End: Form panel -->
    </div>
    <!-- End: Auth layout -->

    <!-- Start: Footer -->
    <footer class="bg-brand-950 text-brand-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col md:flex-row justify-between items-center gap-2 text-xs">
            <p>© 2026 <span class="font-bold text-white">ScholarDesk</span> · Student Management System</p>
            <p>Admissions · Registrar · Finance · ICT</p>
        </div>
    </footer>
    <!-- End: Footer -->
    <script>lucide.createIcons();</script>
</body>
</html>
