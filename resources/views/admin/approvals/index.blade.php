<x-app-layout title="Approvals">
    <x-ui.page-heading title="Approvals" subtitle="Students and lecturers who registered online. Approve to give them a student or staff number and let them sign in." :crumbs="['Overview' => null, 'Approvals' => null]" />

    {{-- Status tabs --}}
    <div class="flex flex-wrap gap-2 mb-5">
        @foreach (['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'] as $key => $label)
            <a href="{{ route('admin.approvals.index', ['status' => $key]) }}"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold border {{ $status === $key ? 'bg-brand-700 text-white border-brand-700' : 'bg-white text-slate-600 border-slate-200 hover:border-brand-300' }}">
                {{ $label }} <span class="text-xs px-1.5 rounded-full {{ $status === $key ? 'bg-white/20' : 'bg-slate-100' }}">{{ $counts[$key] ?? 0 }}</span>
            </a>
        @endforeach
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[820px]">
                <thead><tr class="bg-slate-50"><th class="table-th">Applicant</th><th class="table-th">Type</th><th class="table-th">Details</th><th class="table-th">Submitted</th><th class="table-th">Status</th><th class="table-th"></th></tr></thead>
                <tbody>
                    @forelse ($users as $applicant)
                        <tr class="border-t border-slate-100">
                            <td class="table-td"><div class="flex items-center gap-3"><x-ui.avatar :initials="$applicant->initials()" :tone="$applicant->account_type === 'lecturer' ? 'accent' : 'brand'" /><div><p class="font-semibold">{{ $applicant->name }}</p><p class="text-xs text-slate-500">{{ $applicant->email }}</p></div></div></td>
                            <td class="table-td"><x-ui.badge :value="$applicant->account_type" /></td>
                            <td class="table-td text-slate-600">
                                @if ($applicant->account_type === 'student')
                                    {{ $applicant->student?->programme?->name ?? '—' }}<br><span class="text-xs text-slate-400">{{ $applicant->student?->study_mode }} · {{ $applicant->student?->sponsorship }} @if($applicant->student?->student_number) · {{ $applicant->student->student_number }} @endif</span>
                                @else
                                    {{ $applicant->lecturer?->department ?? '—' }}<br><span class="text-xs text-slate-400">{{ $applicant->lecturer?->qualification }} @if($applicant->lecturer?->staff_number) · {{ $applicant->lecturer->staff_number }} @endif</span>
                                @endif
                            </td>
                            <td class="table-td text-slate-500">{{ $applicant->created_at->format('d M Y') }}</td>
                            <td class="table-td"><x-ui.badge :value="$applicant->status" /></td>
                            <td class="table-td">
                                <div class="flex justify-end gap-2">
                                    @unless ($applicant->isApproved())
                                        <form method="POST" action="{{ route('admin.approvals.approve', $applicant) }}">@csrf<button class="btn-primary !py-1.5 !px-3"><i data-lucide="check" class="w-4 h-4"></i>Approve</button></form>
                                    @endunless
                                    @if ($applicant->status === 'pending')
                                        <form method="POST" action="{{ route('admin.approvals.reject', $applicant) }}">@csrf<button class="btn-danger !py-1.5 !px-3"><i data-lucide="x" class="w-4 h-4"></i>Reject</button></form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6"><x-ui.empty icon="check-check" :message="'No '.$status.' registrations.'" /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
