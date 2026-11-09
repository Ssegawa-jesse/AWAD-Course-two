<div class="card">
    <x-ui.card-header title="Course details" subtitle="Code, title and credit units" icon="library" />
    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
        <x-ui.input name="code" label="Course code" :value="$course->code" required placeholder="BBC3101" />
        <x-ui.input name="title" label="Title" :value="$course->title" required placeholder="Advanced Web Application Development" />
        <x-ui.select class="sm:col-span-2" name="programme_id" label="Programme" :options="$programmes" :value="$course->programme_id" required />
        <x-ui.input name="credit_units" label="Credit units" type="number" min="1" max="10" :value="$course->credit_units" required />
        <x-ui.select name="type" label="Type" :options="App\Models\Course::TYPES" :value="$course->type" required :placeholder="false" />
        <x-ui.select name="year_of_study" label="Year of study" :options="[1 => 'Year 1', 2 => 'Year 2', 3 => 'Year 3', 4 => 'Year 4']" :value="$course->year_of_study" required :placeholder="false" />
        <x-ui.select name="semester" label="Semester" :options="[1 => 'Semester I', 2 => 'Semester II']" :value="$course->semester" required :placeholder="false" />
        <x-ui.textarea class="sm:col-span-2" name="description" label="Description" :value="$course->description" rows="3" />
    </div>
</div>

<div class="card">
    <x-ui.card-header title="Teaching & timetable" subtitle="Assigned lecturer, capacity and weekly slot" icon="calendar-days" />
    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
        <x-ui.select class="sm:col-span-2" name="lecturer_id" label="Lecturer" :options="$lecturers" :value="$course->lecturer_id" placeholder="Not assigned yet" />
        <x-ui.input name="capacity" label="Capacity (max students)" type="number" min="1" :value="$course->capacity" required />
        <x-ui.input name="room" label="Room" :value="$course->room" placeholder="Lab 3" />
        <x-ui.select name="day" label="Day" :options="App\Models\Course::DAYS" :value="$course->day" placeholder="Not scheduled" />
        <div class="grid grid-cols-2 gap-3">
            <x-ui.input name="start_time" label="Starts" type="time" :value="$course->start_time ? substr($course->start_time, 0, 5) : null" />
            <x-ui.input name="end_time" label="Ends" type="time" :value="$course->end_time ? substr($course->end_time, 0, 5) : null" />
        </div>
    </div>
</div>
