<x-app-layout :title="'Edit '.$course->code">
    <x-ui.page-heading :title="'Edit '.$course->code" :subtitle="$course->title" :crumbs="['Course units' => route('admin.courses.index'), $course->code => route('admin.courses.show', $course), 'Edit' => null]" />

    <form method="POST" action="{{ route('admin.courses.update', $course) }}" class="space-y-6 max-w-4xl" novalidate>
        @csrf
        @method('PUT')
        @include('admin.courses._form')
        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.courses.show', $course) }}" class="btn-ghost">Cancel</a>
            <button type="submit" class="btn-primary"><i data-lucide="save" class="w-4 h-4"></i>Save changes</button>
        </div>
    </form>
</x-app-layout>
