<x-app-layout :title="$student->full_name">
    <x-ui.page-heading :title="$student->full_name" :subtitle="$student->programme?->name" :crumbs="['Students' => route('admin.students.index'), $student->full_name => null]">
        <x-slot name="actions">
            @can('update', $student)
                <a href="{{ route('admin.students.edit', $student) }}" class="btn-ghost"><i data-lucide="pencil" class="w-4 h-4"></i>Edit</a>
            @endcan
            @can('delete', $student)
                <x-ui.delete-button :action="route('admin.students.destroy', $student)" label="Delete" :confirm="'Delete '.$student->full_name.' and all their registrations?'" />
            @endcan
        </x-slot>
    </x-ui.page-heading>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        {{-- Profile card --}}
        <div class="card p-6 h-fit">
            <div class="flex items-center gap-4 pb-5 border-b border-slate-100">
                <x-ui.avatar :initials="$student->initials" tone="accent" size="w-14 h-14" class="!text-base" />
                <div class="min-w-0">
                    <p class="font-bold text-lg truncate">{{ $student->full_name }}</p>
                    <p class="text-sm text-slate-500">{{ $student->student_number }}</p>
                    <x-ui.badge :value="$student->status" class="mt-1" />
                </div>
            </div>
            <dl class="pt-5 space-y-3 text-sm">
                @foreach ([
                    'Programme' => $student->programme ? $student->programme->code.' — '.$student->programme->name : '—',
                    'Year / mode' => 'Year '.$student->year_of_study.' · '.$student->study_mode,
                    'Sponsorship' => $student->sponsorship,
                    'Reg. number' => $student->registration_number ?? '—',
                    'Email' => $student->email,
                    'Phone' => $student->phone ?? '—',
                    'Gender' => $student->gender ?? '—',
                    'Date of birth' => $student->date_of_birth?->format('d M Y') ?? '—',
                    'Login account' => $student->user ? ucfirst($student->user->status) : 'None',
                ] as $label => $value)
                    <div class="flex justify-between gap-4"><dt class="text-slate-500">{{ $label }}</dt><dd class="font-semibold text-right">{{ $value }}</dd></div>
                @endforeach
            </dl>
        </div>

        {{-- Registered courses (Eloquent: $student->courses) --}}
        <div class="xl:col-span-2 space-y-6">
            <div class="card overflow-hidden">
                <x-ui.card-header title="Registered courses" :subtitle="$student->courses->count().' courses · '.$student->courses->sum('credit_units').' credit units'" icon="book-open-check" />
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[640px]">
                        <thead><tr class="bg-slate-50"><th class="table-th">Code</th><th class="table-th">Course</th><th class="table-th">CU</th><th class="table-th">Lecturer</th><th class="table-th">Grade</th><th class="table-th"></th></tr></thead>
                        <tbody>
                            @forelse ($student->courses as $course)
                                <tr class="border-t border-slate-100">
                                    <td class="table-td font-bold text-brand-700">{{ $course->code }}</td>
                                    <td class="table-td">{{ $course->title }}</td>
                                    <td class="table-td">{{ $course->credit_units }}</td>
                                    <td class="table-td">{{ $course->lecturer?->name ?? 'Not assigned' }}</td>
                                    <td class="table-td">{{ $course->pivot->grade ?? '—' }}</td>
                                    <td class="table-td text-right">
                                        @can('manage registrations')
                                            <x-ui.delete-button :action="route('admin.registrations.destroy', $course->pivot->id)" icon="x" :confirm="'Remove '.$student->full_name.' from '.$course->code.'?'" />
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6"><x-ui.empty icon="book-x" message="This student has not registered for any course yet." /></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @can('manage registrations')
                <form method="POST" action="{{ route('admin.registrations.store') }}" class="card p-5 flex flex-col sm:flex-row sm:items-end gap-3">
                    @csrf
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <input type="hidden" name="redirect_to" value="{{ route('admin.students.show', $student) }}">
                    <x-ui.select class="flex-1" name="course_id" label="Register this student for a course" :options="$available" required />
                    <button class="btn-primary justify-center"><i data-lucide="plus" class="w-4 h-4"></i>Register</button>
                </form>
            @endcan
        </div>
    </div>
</x-app-layout>
