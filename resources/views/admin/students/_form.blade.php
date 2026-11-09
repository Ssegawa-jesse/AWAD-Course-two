{{-- Shared by create.blade.php and edit.blade.php --}}
<div class="card">
    <x-ui.card-header title="Personal details" subtitle="Legal name and contact" icon="user-round" />
    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
        <x-ui.input name="first_name" label="First name" :value="$student->first_name" required />
        <x-ui.input name="last_name" label="Last name" :value="$student->last_name" required />
        <x-ui.select name="gender" label="Gender" :options="App\Models\Student::GENDERS" :value="$student->gender" required />
        <x-ui.input name="date_of_birth" label="Date of birth" type="date" :value="$student->date_of_birth?->format('Y-m-d')" />
        <x-ui.input name="phone" label="Phone" type="tel" :value="$student->phone" placeholder="+256 7XX XXX XXX" />
        <x-ui.input name="email" label="Email" type="email" :value="$student->email" required placeholder="name@students.mubs.ac.ug" />
    </div>
</div>

<div class="card">
    <x-ui.card-header title="Academic record" subtitle="Programme and status" icon="graduation-cap" />
    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
        <x-ui.input name="student_number" label="Student number" :value="$student->student_number" placeholder="Auto-generated if blank" />
        <x-ui.input name="registration_number" label="Registration number" :value="$student->registration_number" placeholder="24/U/00000/DAY" />
        <x-ui.select class="sm:col-span-2" name="programme_id" label="Programme" :options="$programmes" :value="$student->programme_id" required />
        <x-ui.select name="year_of_study" label="Year of study" :options="[1 => 'Year 1', 2 => 'Year 2', 3 => 'Year 3', 4 => 'Year 4']" :value="$student->year_of_study" required />
        <x-ui.select name="study_mode" label="Study mode" :options="App\Models\Student::MODES" :value="$student->study_mode" required />
        <x-ui.select name="sponsorship" label="Sponsorship" :options="App\Models\Student::SPONSORSHIPS" :value="$student->sponsorship" required />
        <x-ui.select name="status" label="Status" :options="App\Models\Student::STATUSES" :value="$student->status" required :placeholder="false" />
    </div>
</div>

<div class="card">
    <x-ui.card-header title="Login account" subtitle="The student signs in with their email" icon="key-round" />
    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
        <x-ui.input name="password" label="{{ $student->exists ? 'New password' : 'Password' }}" type="password" autocomplete="new-password"
                    :hint="$student->exists ? 'Leave blank to keep the current password.' : 'Leave blank to use the default password 12345678.'" />
    </div>
</div>
