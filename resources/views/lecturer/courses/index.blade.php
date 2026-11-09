<x-app-layout title="My courses">
    <x-ui.page-heading title="My courses" subtitle="Courses assigned to you by the Registrar. Open a course to see the students registered for it." :crumbs="['Teaching' => null, 'My courses' => null]" />

    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-5">
        @forelse ($courses as $course)
            @include('lecturer.courses._card')
        @empty
            <div class="card md:col-span-2 xl:col-span-3"><x-ui.empty icon="library" message="No courses have been assigned to you yet." /></div>
        @endforelse
    </div>
</x-app-layout>
