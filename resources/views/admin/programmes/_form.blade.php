<div class="card">
    <x-ui.card-header title="Programme details" icon="layers" />
    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
        <x-ui.input name="code" label="Code" :value="$programme->code" required placeholder="BBC" />
        <x-ui.input name="name" label="Name" :value="$programme->name" required placeholder="Bachelor of Business Computing" />
        <x-ui.input name="faculty" label="Faculty" :value="$programme->faculty" placeholder="Computing & Informatics" />
        <x-ui.select name="level" label="Level" :options="['Certificate', 'Diploma', 'Bachelor', 'Masters']" :value="$programme->level" required :placeholder="false" />
        <x-ui.input name="duration_years" label="Duration (years)" type="number" min="1" max="6" :value="$programme->duration_years" required />
        <x-ui.textarea class="sm:col-span-2" name="description" label="Description" :value="$programme->description" rows="3" />
    </div>
</div>
