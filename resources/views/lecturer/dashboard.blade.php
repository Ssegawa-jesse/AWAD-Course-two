<x-app-layout title="Lecturer dashboard">
    <x-ui.page-heading :title="'Welcome, '.auth()->user()->name" :subtitle="($lecturer->department ?? 'Lecturer').' · Staff number '.$lecturer->staff_number" />

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
        <x-ui.stat label="Assigned courses" :value="$stats['courses']" icon="library" />
        <x-ui.stat label="Students taught" :value="$stats['students']" icon="users-round" tone="indigo" />
        <x-ui.stat label="Marks entered" :value="$stats['marked']" icon="pen-line" tone="accent" />
        <x-ui.stat label="Waiting for marks" :value="$stats['unmarked']" icon="hourglass" tone="red" />
    </div>

    <div class="flex justify-between items-center mb-4">
        <h2 class="font-bold text-lg">My courses this semester</h2>
        <a href="{{ route('lecturer.courses.index') }}" class="text-sm font-semibold text-brand-700">All courses</a>
    </div>
    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-5">
        @forelse ($courses as $course)
            @include('lecturer.courses._card')
        @empty
            <div class="card md:col-span-2 xl:col-span-3"><x-ui.empty icon="library" message="No courses have been assigned to you yet. The Registrar assigns lecturers to courses." /></div>
        @endforelse
    </div>
</x-app-layout>
