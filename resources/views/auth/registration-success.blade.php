<x-guest-layout title="Registration received">
    <div class="text-center">
        <div class="w-16 h-16 mx-auto rounded-2xl bg-brand-50 flex items-center justify-center mb-6"><i data-lucide="mail-check" class="w-8 h-8 text-brand-600"></i></div>
        <h1 class="text-2xl font-extrabold tracking-tight">Registration received</h1>
        <p class="text-sm text-slate-500 mt-2 mb-8">Thank you{{ session('registered_name') ? ', '.session('registered_name') : '' }}. Your account is now <b class="text-accent-600">pending approval</b>. The Registrar's office will check your details. Once approved you can sign in and you will get your student or staff number.</p>
    </div>

    <div class="card p-5 space-y-4 text-sm">
        <div class="flex gap-3"><span class="w-7 h-7 rounded-lg bg-brand-50 text-brand-700 font-bold flex items-center justify-center shrink-0">1</span><p class="pt-1">Your registration is saved with status <b>Pending</b>.</p></div>
        <div class="flex gap-3"><span class="w-7 h-7 rounded-lg bg-brand-50 text-brand-700 font-bold flex items-center justify-center shrink-0">2</span><p class="pt-1">The Registrar approves or rejects it under <b>Approvals</b>.</p></div>
        <div class="flex gap-3"><span class="w-7 h-7 rounded-lg bg-brand-50 text-brand-700 font-bold flex items-center justify-center shrink-0">3</span><p class="pt-1">After approval, sign in with the email and password you chose.</p></div>
    </div>

    <div class="mt-8 flex flex-col sm:flex-row gap-3">
        <a href="{{ route('login') }}" class="btn-primary justify-center flex-1">Go to sign in<i data-lucide="arrow-right" class="w-4 h-4"></i></a>
        <a href="{{ route('home') }}" class="btn-ghost justify-center flex-1">Back to home</a>
    </div>
</x-guest-layout>
