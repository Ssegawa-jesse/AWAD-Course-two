<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProgrammeController extends Controller
{
    public function index()
    {
        $programmes = Programme::withCount(['students', 'courses'])
            ->latest()
            ->paginate(10);

        return view('admin.programmes.index', compact('programmes'));
    }

    public function create()
    {
        return view('admin.programmes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:programmes,code'],
            'name' => ['required', 'string', 'max:255'],
            'faculty' => ['nullable', 'string', 'max:255'],
            'level' => ['nullable', 'string', 'max:100'],
            'duration_years' => ['required', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
        ]);

        Programme::create($validated);

        return redirect()->route('admin.programmes.index')
            ->with('success', 'Programme created successfully.');
    }

    public function show(Programme $programme)
    {
        return redirect()->route('admin.programmes.edit', $programme);
    }

    public function edit(Programme $programme)
    {
        return view('admin.programmes.edit', compact('programme'));
    }

    public function update(Request $request, Programme $programme)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', Rule::unique('programmes', 'code')->ignore($programme->id)],
            'name' => ['required', 'string', 'max:255'],
            'faculty' => ['nullable', 'string', 'max:255'],
            'level' => ['nullable', 'string', 'max:100'],
            'duration_years' => ['required', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
        ]);

        $programme->update($validated);

        return redirect()->route('admin.programmes.index')
            ->with('success', 'Programme updated successfully.');
    }

    public function destroy(Programme $programme)
    {
        if ($programme->students()->exists() || $programme->courses()->exists()) {
            return back()->with('error', 'Cannot delete a programme that has students or courses.');
        }

        $programme->delete();

        return redirect()->route('admin.programmes.index')
            ->with('success', 'Programme deleted successfully.');
    }
}
