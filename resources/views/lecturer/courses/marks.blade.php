<x-app-layout :title="$course->code.' marks'">
    <x-ui.page-heading :title="'Enter marks · '.$course->code" subtitle="Coursework is out of 30 and the exam out of 70. The grade is worked out when both marks are in." :crumbs="['My courses' => route('lecturer.courses.index'), $course->code => route('lecturer.courses.show', $course), 'Marks' => null]" />

    <form method="POST" action="{{ route('lecturer.courses.marks.update', $course) }}" novalidate>
        @csrf
        @method('PUT')
        <div class="card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[720px]">
                    <thead><tr class="bg-slate-50"><th class="table-th">Student</th><th class="table-th w-40">Coursework /30</th><th class="table-th w-40">Exam /70</th><th class="table-th">Total</th><th class="table-th">Grade</th></tr></thead>
                    <tbody>
                        @forelse ($registrations as $registration)
                            @php $key = 'marks.'.$registration->id; @endphp
                            <tr class="border-t border-slate-100">
                                <td class="table-td"><p class="font-semibold">{{ $registration->student->full_name }}</p><p class="text-xs text-slate-500">{{ $registration->student->student_number }}</p></td>
                                <td class="table-td">
                                    <input type="number" step="0.5" min="0" max="30" name="marks[{{ $registration->id }}][coursework]" value="{{ old($key.'.coursework', $registration->coursework_mark) }}" class="input-field !py-1.5" @error($key.'.coursework') aria-invalid="true" @enderror>
                                    <x-ui.error :field="$key.'.coursework'" />
                                </td>
                                <td class="table-td">
                                    <input type="number" step="0.5" min="0" max="70" name="marks[{{ $registration->id }}][exam]" value="{{ old($key.'.exam', $registration->exam_mark) }}" class="input-field !py-1.5" @error($key.'.exam') aria-invalid="true" @enderror>
                                    <x-ui.error :field="$key.'.exam'" />
                                </td>
                                <td class="table-td font-semibold">{{ $registration->total() ?? '—' }}</td>
                                <td class="table-td"><span class="font-extrabold {{ $registration->grade === 'F' ? 'text-red-600' : 'text-brand-700' }}">{{ $registration->grade ?? '—' }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="5"><x-ui.empty icon="users-round" message="No students to mark yet." /></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($registrations->isNotEmpty())
            <div class="flex justify-end gap-2 mt-5">
                <a href="{{ route('lecturer.courses.show', $course) }}" class="btn-ghost">Cancel</a>
                <button class="btn-primary"><i data-lucide="save" class="w-4 h-4"></i>Save marks</button>
            </div>
        @endif
    </form>
</x-app-layout>
