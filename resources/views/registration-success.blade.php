<!DOCTYPE html>
<html lang="en" data-root="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration received — ScholarDesk</title>
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
                <h2 class="text-3xl font-extrabold leading-tight tracking-tight mb-4">You are almost in.</h2>
                <p class="text-brand-200 mb-8 leading-relaxed">You can sign in as soon as the Registrar approves your registration.</p>
                <ul class="space-y-4"><li class="flex items-start gap-3"><span class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center shrink-0"><i data-lucide="clock" class="w-4 h-4 text-accent-400"></i></span><span class="text-sm text-brand-100 pt-1">Approval usually takes 1–2 working days</span></li><li class="flex items-start gap-3"><span class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center shrink-0"><i data-lucide="phone" class="w-4 h-4 text-accent-400"></i></span><span class="text-sm text-brand-100 pt-1">Questions? Call the Registrar on +256 414 000 300</span></li></ul>
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
                <!-- Start: Success -->
                <div class="card p-8 text-center">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-brand-50 flex items-center justify-center mb-5"><i data-lucide="badge-check" class="w-8 h-8 text-brand-600"></i></div>
                    <h1 class="text-2xl font-extrabold tracking-tight">Registration received</h1>
                    <p class="text-sm text-slate-500 mt-2">Thank you, <span data-q="name">there</span>. Your <span data-q="role">application</span> reference is</p>
                    <p class="text-xl font-extrabold text-brand-800 tracking-wider my-3" data-q="ref">APP-2026-00000</p>
                    <div class="text-left bg-slate-50 rounded-xl p-5 my-6 space-y-3 text-sm">
                        <div class="flex gap-3"><i data-lucide="circle-check" class="w-5 h-5 text-brand-600 shrink-0"></i><span>Details submitted</span></div>
                        <div class="flex gap-3"><i data-lucide="loader-circle" class="w-5 h-5 text-accent-500 shrink-0"></i><span>Waiting for the Registrar to approve <span class="text-slate-400">(1–2 working days)</span></span></div>
                        <div class="flex gap-3 text-slate-400"><i data-lucide="circle" class="w-5 h-5 shrink-0"></i><span>Your <span data-q="numlabel">student number</span> is issued on approval</span></div>
                        <div class="flex gap-3 text-slate-400"><i data-lucide="circle" class="w-5 h-5 shrink-0"></i><span>Sign in with your email and password</span></div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                        <a href="login.html" class="btn-primary justify-center">Go to sign in</a>
                        <a href="index.html" class="btn-ghost justify-center">Back to home</a>
                    </div>
                </div>
                <!-- End: Success -->
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
