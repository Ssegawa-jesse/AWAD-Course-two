<x-public-layout title="Contact">
    <!-- Start: Contact -->
    <section class="pt-[72px]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="max-w-2xl mb-12">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-accent-600 mb-3">Contact</p>
                <h1 class="text-4xl font-extrabold tracking-tight mb-3">Talk to the Registrar's office</h1>
                <p class="text-slate-500">Questions about registration, results, transcripts or your student number. We reply within one working day.</p>
            </div>
            <div class="grid lg:grid-cols-[1fr_1.3fr] gap-8">
                <div class="space-y-4">
                    <div class="card p-6 flex gap-4"><div class="w-11 h-11 rounded-xl bg-brand-50 flex items-center justify-center shrink-0"><i data-lucide="map-pin" class="w-5 h-5 text-brand-600"></i></div><div><p class="font-bold">Academic Registrar</p><p class="text-sm text-slate-500">Block B, ground floor · Main campus</p></div></div>
                    <div class="card p-6 flex gap-4"><div class="w-11 h-11 rounded-xl bg-accent-50 flex items-center justify-center shrink-0"><i data-lucide="phone" class="w-5 h-5 text-accent-600"></i></div><div><p class="font-bold">Phone</p><p class="text-sm text-slate-500">Registrar: +256 414 000 300<br>Finance: +256 414 000 301</p></div></div>
                    <div class="card p-6 flex gap-4"><div class="w-11 h-11 rounded-xl bg-brand-50 flex items-center justify-center shrink-0"><i data-lucide="mail" class="w-5 h-5 text-brand-600"></i></div><div><p class="font-bold">Email</p><p class="text-sm text-slate-500">registrar@campus.ac.ug<br>admissions@campus.ac.ug</p></div></div>
                    <div class="card p-6 flex gap-4"><div class="w-11 h-11 rounded-xl bg-accent-50 flex items-center justify-center shrink-0"><i data-lucide="clock" class="w-5 h-5 text-accent-600"></i></div><div><p class="font-bold">Office hours</p><p class="text-sm text-slate-500">Monday – Friday, 8:00am – 5:00pm</p></div></div>
                </div>
                <form action="{{ route('contact.send') }}" method="POST" class="card p-6 sm:p-8 grid sm:grid-cols-2 gap-5" novalidate>
                    @csrf
                    @if (session('success'))
                        <div class="sm:col-span-2"><x-ui.alert type="success">{{ session('success') }}</x-ui.alert></div>
                    @endif
                    <div>
                        <label for="name" class="field-label">Full name <span class="text-accent-600">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Your name" required class="input-field">
                        <x-ui.error field="name" />
                    </div>
                    <div>
                        <label for="email" class="field-label">Email <span class="text-accent-600">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required class="input-field">
                        <x-ui.error field="email" />
                    </div>
                    <div>
                        <label for="student_no" class="field-label">Student number</label>
                        <input type="text" id="student_no" name="student_no" value="{{ old('student_no') }}" placeholder="If you have one" class="input-field">
                        <x-ui.error field="student_no" />
                    </div>
                    <div>
                        <label for="topic" class="field-label">Topic <span class="text-accent-600">*</span></label>
                        <select id="topic" name="topic" required class="input-field">
                            <option value="" disabled @selected(! old('topic'))>Choose…</option>
                            @foreach (['Registration', 'Course units', 'Results / transcript', 'Fees', 'Account / password', 'Other'] as $topic)
                                <option @selected(old('topic') === $topic)>{{ $topic }}</option>
                            @endforeach
                        </select>
                        <x-ui.error field="topic" />
                    </div>
                    <div class="sm:col-span-2">
                        <label for="message" class="field-label">Message <span class="text-accent-600">*</span></label>
                        <textarea id="message" name="message" rows="6" placeholder="How can we help?" required class="input-field">{{ old('message') }}</textarea>
                        <x-ui.error field="message" />
                    </div>
                    <div class="sm:col-span-2"><button class="btn-primary">Send message<i data-lucide="send" class="w-4 h-4"></i></button></div>
                </form>
            </div>
        </div>
    </section>
    <!-- End: Contact -->
</x-public-layout>
