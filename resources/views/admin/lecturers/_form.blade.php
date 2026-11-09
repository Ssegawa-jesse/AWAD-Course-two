<div class="card">
    <x-ui.card-header title="Lecturer details" subtitle="Name, contact and department" icon="presentation" />
    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
        <x-ui.select name="title" label="Title" :options="['Mr.', 'Ms.', 'Mrs.', 'Dr.', 'Prof.']" :value="$lecturer->title" />
        <x-ui.input name="name" label="Full name (as displayed)" :value="$lecturer->user?->name" required placeholder="Dr. Moses Kato" />
        <x-ui.input name="email" label="Email" type="email" :value="$lecturer->user?->email" required />
        <x-ui.input name="phone" label="Phone" :value="$lecturer->phone" />
        <x-ui.input name="staff_number" label="Staff number" :value="$lecturer->staff_number" placeholder="Auto-generated if blank" />
        <x-ui.input name="department" label="Department" :value="$lecturer->department" required />
        <x-ui.select name="qualification" label="Qualification" :options="['Bachelors', 'Masters', 'PhD']" :value="$lecturer->qualification" />
        <x-ui.select name="employment_type" label="Employment" :options="['Full-time', 'Part-time']" :value="$lecturer->employment_type" required :placeholder="false" />
        <x-ui.input name="password" :label="$lecturer->exists ? 'New password' : 'Password'" type="password" autocomplete="new-password" :hint="$lecturer->exists ? 'Leave blank to keep the current password.' : 'Leave blank to use the default password 12345678.'" />
    </div>
</div>
