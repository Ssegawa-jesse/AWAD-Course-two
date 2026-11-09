<div class="card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full min-w-[720px]">
            <thead>
                <tr class="bg-slate-50">
                    <th class="table-th">Student</th>
                    <th class="table-th">Programme</th>
                    <th class="table-th">Year</th>
                    <th class="table-th">Mode</th>
                    <th class="table-th">Courses</th>
                    <th class="table-th">Status</th>
                    <th class="table-th"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr class="border-t border-slate-100 hover:bg-brand-50/40">
                        <td class="table-td">
                            <div class="flex items-center gap-3">
                                <x-ui.avatar :initials="$student->initials" :tone="$student->gender === 'Female' ? 'accent' : 'brand'" />
                                <div><p class="font-semibold">{{ $student->full_name }}</p><p class="text-xs text-slate-500">{{ $student->student_number }}</p></div>
                            </div>
                        </td>
                        <td class="table-td">{{ $student->programme?->code ?? '—' }}</td>
                        <td class="table-td">Year {{ $student->year_of_study }}</td>
                        <td class="table-td">{{ $student->study_mode }}</td>
                        <td class="table-td">{{ $student->registrations_count ?? $student->registrations()->count() }}</td>
                        <td class="table-td"><x-ui.badge :value="$student->status" /></td>
                        <td class="table-td">
                            <div class="flex justify-end gap-1">
                                <a href="{{ route('admin.students.show', $student) }}" class="icon-btn" title="View"><i data-lucide="eye" class="w-4 h-4"></i></a>
                                @can('update', $student)
                                    <a href="{{ route('admin.students.edit', $student) }}" class="icon-btn" title="Edit"><i data-lucide="pencil" class="w-4 h-4"></i></a>
                                @endcan
                                @can('delete', $student)
                                    <x-ui.delete-button :action="route('admin.students.destroy', $student)" :confirm="'Delete '.$student->full_name.' and all their registrations?'" />
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7"><x-ui.empty icon="graduation-cap" message="No students found." /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
