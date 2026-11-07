<!DOCTYPE html>
<html lang="en" data-root="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — ScholarDesk</title>
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
                <h2 class="text-3xl font-extrabold leading-tight tracking-tight mb-4">Register as a student or a lecturer.</h2>
                <p class="text-brand-200 mb-8 leading-relaxed">Fill in your details once. The Registrar reviews every registration, and approves it before you can sign in.</p>
                <ul class="space-y-4"><li class="flex items-start gap-3"><span class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center shrink-0"><i data-lucide="user-round" class="w-4 h-4 text-accent-400"></i></span><span class="text-sm text-brand-100 pt-1">Personal details</span></li><li class="flex items-start gap-3"><span class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center shrink-0"><i data-lucide="graduation-cap" class="w-4 h-4 text-accent-400"></i></span><span class="text-sm text-brand-100 pt-1">Students: programme and next of kin</span></li><li class="flex items-start gap-3"><span class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center shrink-0"><i data-lucide="presentation" class="w-4 h-4 text-accent-400"></i></span><span class="text-sm text-brand-100 pt-1">Lecturers: department and qualification</span></li><li class="flex items-start gap-3"><span class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center shrink-0"><i data-lucide="shield-check" class="w-4 h-4 text-accent-400"></i></span><span class="text-sm text-brand-100 pt-1">Registrar approves, then you sign in</span></li></ul>
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
            <div class="w-full max-w-2xl animate-rise">
                <a href="index.html" class="lg:hidden flex items-center gap-3 mb-8">
                    <img src="assets/img/logo.svg" alt="ScholarDesk" class="h-10 w-10">
                    <p class="font-extrabold text-brand-900">ScholarDesk</p>
                </a>
                <!-- Start: Register heading -->
                <div class="mb-6">
                    <span class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-accent-600 bg-accent-50 px-3 py-1 rounded-full mb-3"><i data-lucide="sparkles" class="w-3.5 h-3.5"></i>Semester I 2026/27</span>
                    <h1 class="text-2xl font-extrabold tracking-tight">Create your account</h1>
                    <p class="text-sm text-slate-500 mt-1">Students and lecturers register here. The Registrar's office checks your details and approves your account, usually within 2 working days.</p>
                </div>
                <!-- End: Register heading -->

                <!-- Start: Register form -->
                <form id="register-form" action="registration-success.html" method="get" class="space-y-6">
                    <!-- Start: Account type -->
                <div class="mb-6">
                    <p class="field-label">I am registering as <span class="text-accent-600">*</span></p>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="account_type" value="student" checked class="peer sr-only">
                            <span class="flex items-center gap-3 p-4 rounded-2xl border-2 border-slate-200 bg-white peer-checked:border-brand-500 peer-checked:bg-brand-50 transition">
                                <span class="w-10 h-10 rounded-xl bg-brand-100 flex items-center justify-center shrink-0"><i data-lucide="graduation-cap" class="w-5 h-5 text-brand-700"></i></span>
                                <span><span class="block font-bold">Student</span><span class="block text-xs text-slate-500">Admitted to a programme</span></span>
                            </span>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="account_type" value="lecturer" class="peer sr-only">
                            <span class="flex items-center gap-3 p-4 rounded-2xl border-2 border-slate-200 bg-white peer-checked:border-accent-500 peer-checked:bg-accent-50 transition">
                                <span class="w-10 h-10 rounded-xl bg-accent-100 flex items-center justify-center shrink-0"><i data-lucide="presentation" class="w-5 h-5 text-accent-700"></i></span>
                                <span><span class="block font-bold">Lecturer</span><span class="block text-xs text-slate-500">Teaching staff</span></span>
                            </span>
                        </label>
                    </div>
                </div>
                <!-- End: Account type -->

                    <div class="card">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-brand-50 flex items-center justify-center"><i data-lucide="user-round" class="w-4 h-4 text-brand-600"></i></div>
                        <div><h2 class="font-bold">Personal details</h2><p class="text-xs text-slate-500">As they appear on your national ID or passport</p></div>
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
                            <label for="nationality" class="field-label">Nationality <span class="text-accent-600">*</span></label>
                            <select id="nationality" name="nationality" required class="input-field"><option value="" disabled selected>Choose…</option><option>Ugandan</option><option>Kenyan</option><option>Tanzanian</option><option>Rwandese</option><option>South Sudanese</option><option>Other</option></select>
                        </div>
                        <div class="">
                            <label for="phone" class="field-label">Phone number <span class="text-accent-600">*</span></label>
                            <input type="tel" id="phone" name="phone" placeholder="+256 7XX XXX XXX" required class="input-field">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="district" class="field-label">District / city of residence <span class="text-accent-600">*</span></label>
                            <input type="text" id="district" name="district" placeholder="Kampala" required class="input-field">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="photo" class="field-label">Passport photo</label>
                            <input type="file" id="photo" name="photo" accept="image/*" class="file-input input-field !py-2">
                            <p class="text-xs text-slate-400 mt-1.5">JPG or PNG, plain background, under 2 MB.</p>
                        </div>
                    </div>
                </div>

                    <!-- Start: Student-only section -->
                    <fieldset data-for="student" class="space-y-6">
                    <div class="card">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-brand-50 flex items-center justify-center"><i data-lucide="graduation-cap" class="w-4 h-4 text-brand-600"></i></div>
                        <div><h2 class="font-bold">Academic details</h2><p class="text-xs text-slate-500">The programme you were admitted to</p></div>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                        
                        <div class="sm:col-span-2">
                            <label for="programme" class="field-label">Programme <span class="text-accent-600">*</span></label>
                            <select id="programme" name="programme" required class="input-field"><option value="" disabled selected>Choose…</option><option>Bachelor of Business Computing (BBC)</option><option>Bachelor of Information Technology (BIT)</option><option>Bachelor of Commerce (BCOM)</option><option>Bachelor of Procurement &amp; Logistics (BPLM)</option><option>Bachelor of Human Resource Management (BHRM)</option><option>Diploma in Computer Science (DCS)</option></select>
                        </div>
                        <div class="">
                            <label for="study_mode" class="field-label">Study mode <span class="text-accent-600">*</span></label>
                            <select id="study_mode" name="study_mode" required class="input-field"><option value="" disabled selected>Choose…</option><option>Day</option><option>Evening</option><option>Weekend</option></select>
                        </div>
                        <div class="">
                            <label for="sponsorship" class="field-label">Sponsorship <span class="text-accent-600">*</span></label>
                            <select id="sponsorship" name="sponsorship" required class="input-field"><option value="" disabled selected>Choose…</option><option>Private</option><option>Government</option><option>Scholarship</option></select>
                        </div>
                        <div class="">
                            <label for="scheme" class="field-label">Entry scheme <span class="text-accent-600">*</span></label>
                            <select id="scheme" name="scheme" required class="input-field"><option value="" disabled selected>Choose…</option><option>Direct entry (UACE)</option><option>Diploma holder</option><option>Mature age</option><option>Transfer</option></select>
                        </div>
                        <div class="">
                            <label for="uace_index" class="field-label">UACE index number <span class="text-accent-600">*</span></label>
                            <input type="text" id="uace_index" name="uace_index" placeholder="U0012/501" required class="input-field"><p class="text-xs text-slate-400 mt-1.5">Or diploma registration number.</p>
                        </div>
                    </div>
                </div>
                    <div class="card">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-brand-50 flex items-center justify-center"><i data-lucide="users-round" class="w-4 h-4 text-brand-600"></i></div>
                        <div><h2 class="font-bold">Next of kin / guardian</h2><p class="text-xs text-slate-500">Who we contact in an emergency</p></div>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                        
                        <div class="">
                            <label for="guardian_name" class="field-label">Full name <span class="text-accent-600">*</span></label>
                            <input type="text" id="guardian_name" name="guardian_name" placeholder="Full name" required class="input-field">
                        </div>
                        <div class="">
                            <label for="guardian_relation" class="field-label">Relationship <span class="text-accent-600">*</span></label>
                            <select id="guardian_relation" name="guardian_relation" required class="input-field"><option value="" disabled selected>Choose…</option><option>Parent</option><option>Guardian</option><option>Spouse</option><option>Sibling</option><option>Sponsor</option></select>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="guardian_phone" class="field-label">Phone number <span class="text-accent-600">*</span></label>
                            <input type="tel" id="guardian_phone" name="guardian_phone" placeholder="+256 7XX XXX XXX" required class="input-field">
                        </div>
                    </div>
                </div>
                    </fieldset>
                    <!-- End: Student-only section -->

                    <!-- Start: Lecturer-only section -->
                    <fieldset data-for="lecturer" class="space-y-6" style="display:none" disabled>
                    <div class="card">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-brand-50 flex items-center justify-center"><i data-lucide="presentation" class="w-4 h-4 text-brand-600"></i></div>
                        <div><h2 class="font-bold">Staff details</h2><p class="text-xs text-slate-500">Your teaching appointment</p></div>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                        
                        <div class="">
                            <label for="title" class="field-label">Title <span class="text-accent-600">*</span></label>
                            <select id="title" name="title" required class="input-field"><option value="" disabled selected>Choose…</option><option>Dr.</option><option>Mr.</option><option>Ms.</option><option>Mrs.</option><option>Prof.</option><option>Assoc. Prof.</option></select>
                        </div>
                        <div class="">
                            <label for="staff_no" class="field-label">Staff number</label>
                            <input type="text" id="staff_no" name="staff_no" placeholder="If already issued" class="input-field">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="department" class="field-label">Department <span class="text-accent-600">*</span></label>
                            <select id="department" name="department" required class="input-field"><option value="" disabled selected>Choose…</option><option>Business Computing</option><option>Information Technology</option><option>Accounting</option><option>Marketing</option><option>Procurement</option><option>Human Resource Management</option></select>
                        </div>
                        <div class="">
                            <label for="qualification" class="field-label">Highest qualification <span class="text-accent-600">*</span></label>
                            <select id="qualification" name="qualification" required class="input-field"><option value="" disabled selected>Choose…</option><option>PhD</option><option>Masters</option><option>Bachelors</option><option>Postgraduate Diploma</option></select>
                        </div>
                        <div class="">
                            <label for="employment" class="field-label">Employment type <span class="text-accent-600">*</span></label>
                            <select id="employment" name="employment" required class="input-field"><option value="" disabled selected>Choose…</option><option>Full-time</option><option>Part-time</option></select>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="specialisation" class="field-label">Area of specialisation <span class="text-accent-600">*</span></label>
                            <input type="text" id="specialisation" name="specialisation" placeholder="e.g. Web &amp; mobile development" required class="input-field">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="cv" class="field-label">CV / appointment letter</label>
                            <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" class="file-input input-field !py-2">
                        </div>
                    </div>
                </div>
                    </fieldset>
                    <!-- End: Lecturer-only section -->

                    <div class="card">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-brand-50 flex items-center justify-center"><i data-lucide="key-round" class="w-4 h-4 text-brand-600"></i></div>
                        <div><h2 class="font-bold">Create your account</h2><p class="text-xs text-slate-500">You will sign in with this email and password after approval</p></div>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                        
                        <div class="sm:col-span-2">
                            <label for="email" class="field-label">Email <span class="text-accent-600">*</span></label>
                            <input type="email" id="email" name="email" placeholder="you@example.com" required class="input-field">
                        </div>
                        <div class="">
                            <label for="password" class="field-label">Password <span class="text-accent-600">*</span></label>
                            <input type="password" id="password" name="password" placeholder="At least 8 characters" required class="input-field"><p class="text-xs text-slate-400 mt-1.5">At least 8 characters.</p>
                        </div>
                        <div class="">
                            <label for="password_confirmation" class="field-label">Confirm password <span class="text-accent-600">*</span></label>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repeat password" required class="input-field">
                        </div>
                        <label class="sm:col-span-2 flex items-start gap-3 text-sm text-slate-600 cursor-pointer">
                            <input type="checkbox" required class="mt-0.5 w-4 h-4 rounded accent-brand-700">
                            <span>I confirm the information above is true, and I agree to the <a href="#" class="font-semibold text-brand-700 underline">code of conduct</a> and <a href="#" class="font-semibold text-brand-700 underline">privacy notice</a>.</span>
                        </label>
                    </div>
                </div>

                    <div id="register-error" hidden class="flex items-start gap-2 p-3 rounded-xl bg-red-50 border border-red-100 text-sm text-red-700"><i data-lucide="circle-alert" class="w-4 h-4 mt-0.5 shrink-0"></i><span></span></div>

                    <div class="flex flex-col-reverse sm:flex-row sm:items-center justify-between gap-4 pt-2">
                        <p class="text-sm text-slate-500">Already registered? <a href="login.html" class="font-bold text-brand-700">Sign in</a></p>
                        <button type="submit" class="btn-accent justify-center py-3 px-6">Submit registration<i data-lucide="send" class="w-4 h-4"></i></button>
                    </div>
                </form>
                <!-- End: Register form -->
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
