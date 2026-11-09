<x-guest-layout title="Register" wide>
    <div class="mb-6">
        <span class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-accent-600 bg-accent-50 px-3 py-1 rounded-full mb-3"><i data-lucide="sparkles" class="w-3.5 h-3.5"></i>Semester I 2026/27</span>
        <h1 class="text-2xl font-extrabold tracking-tight">Create your account</h1>
        <p class="text-sm text-slate-500 mt-1">Students and lecturers register here. The Registrar's office checks your details and approves your account before you can sign in.</p>
    </div>

    @if ($errors->any())
        <x-ui.alert type="error" class="mb-6">Please check the highlighted fields below.</x-ui.alert>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-6" x-data="{ type: @js(old('account_type', 'student')) }" novalidate>
        @csrf

        {{-- Account type --}}
        <div>
            <p class="field-label">I am registering as <span class="text-accent-600">*</span></p>
            <div class="grid grid-cols-2 gap-3">
                <label class="cursor-pointer">
                    <input type="radio" name="account_type" value="student" x-model="type" class="peer sr-only">
                    <span class="flex items-center gap-3 p-4 rounded-2xl border-2 border-slate-200 bg-white peer-checked:border-brand-500 peer-checked:bg-brand-50 transition">
                        <span class="w-10 h-10 rounded-xl bg-brand-100 flex items-center justify-center shrink-0"><i data-lucide="graduation-cap" class="w-5 h-5 text-brand-700"></i></span>
                        <span><span class="block font-bold">Student</span><span class="block text-xs text-slate-500">Admitted to a programme</span></span>
                    </span>
                </label>
                <label class="cursor-pointer">
                    <input type="radio" name="account_type" value="lecturer" x-model="type" class="peer sr-only">
                    <span class="flex items-center gap-3 p-4 rounded-2xl border-2 border-slate-200 bg-white peer-checked:border-accent-500 peer-checked:bg-accent-50 transition">
                        <span class="w-10 h-10 rounded-xl bg-accent-100 flex items-center justify-center shrink-0"><i data-lucide="presentation" class="w-5 h-5 text-accent-700"></i></span>
                        <span><span class="block font-bold">Lecturer</span><span class="block text-xs text-slate-500">Teaching staff</span></span>
                    </span>
                </label>
            </div>
            <x-ui.error field="account_type" />
        </div>

        {{-- Personal details --}}
        <div class="card">
            <x-ui.card-header title="Personal details" subtitle="As they appear on your national ID or passport" icon="user-round" />
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <x-ui.input name="first_name" label="First name" required placeholder="First name" />
                <x-ui.input name="last_name" label="Last name" required placeholder="Last name" />
                <x-ui.select name="gender" label="Gender" :options="\App\Models\Student::GENDERS" />
                <x-ui.input name="phone" label="Phone number" type="tel" placeholder="+256 7XX XXX XXX" />
            </div>
        </div>

        {{-- Student only --}}
        <div class="card" x-show="type === 'student'" x-cloak>
            <x-ui.card-header title="Academic details" subtitle="The programme you were admitted to" icon="graduation-cap" />
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <x-ui.select class="sm:col-span-2" name="programme_id" label="Programme" required :options="$programmes" />
                <x-ui.select name="study_mode" label="Study mode" required :options="\App\Models\Student::MODES" />
                <x-ui.select name="sponsorship" label="Sponsorship" :options="\App\Models\Student::SPONSORSHIPS" />
                <x-ui.input name="date_of_birth" label="Date of birth" type="date" />
            </div>
        </div>

        {{-- Lecturer only --}}
        <div class="card" x-show="type === 'lecturer'" x-cloak>
            <x-ui.card-header title="Staff details" subtitle="Your department and qualification" icon="presentation" />
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <x-ui.select name="title" label="Title" :options="['Mr.', 'Ms.', 'Mrs.', 'Dr.', 'Prof.']" />
                <x-ui.input name="department" label="Department" required placeholder="e.g. Computing & Informatics" />
                <x-ui.select name="qualification" label="Highest qualification" :options="['Bachelors', 'Masters', 'PhD']" />
            </div>
        </div>

        {{-- Sign-in details --}}
        <div class="card">
            <x-ui.card-header title="Sign-in details" subtitle="You will use these to sign in after approval" icon="key-round" />
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <x-ui.input class="sm:col-span-2" name="email" label="Email" type="email" required autocomplete="username" placeholder="you@example.com" />
                <x-ui.input name="password" label="Password" type="password" required autocomplete="new-password" hint="At least 8 characters" />
                <x-ui.input name="password_confirmation" label="Confirm password" type="password" required autocomplete="new-password" />
            </div>
        </div>

        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <label class="flex items-center gap-2 text-sm text-slate-600">
                <input type="checkbox" name="terms" required class="rounded border-slate-300 text-brand-700"> I agree to the terms of service and privacy policy
            </label>
        @endif

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <p class="text-sm text-slate-500">Already registered? <a href="{{ route('login') }}" class="font-bold text-brand-700">Sign in</a></p>
            <button type="submit" class="btn-accent justify-center py-3 px-6">Submit registration<i data-lucide="send" class="w-4 h-4"></i></button>
        </div>
    </form>
</x-guest-layout>
