<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProgrammeRequest;
use App\Models\Programme;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProgrammeController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [new Middleware('permission:manage programmes')];
    }

    public function index()
    {
        return view('admin.programmes.index', [
            'programmes' => Programme::withCount(['courses', 'students' => fn ($q) => $q->enrolled()])->orderBy('code')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.programmes.create', ['programme' => new Programme(['level' => 'Bachelor', 'duration_years' => 3])]);
    }

    public function store(ProgrammeRequest $request)
    {
        $programme = Programme::create($request->validated());

        return redirect()->route('admin.programmes.index')->with('success', "Programme {$programme->code} was created.");
    }

    public function edit(Programme $programme)
    {
        return view('admin.programmes.edit', compact('programme'));
    }

    public function update(ProgrammeRequest $request, Programme $programme)
    {
        $programme->update($request->validated());

        return redirect()->route('admin.programmes.index')->with('success', "Programme {$programme->code} was updated.");
    }

    public function destroy(Programme $programme)
    {
        if ($programme->students()->exists()) {
            return back()->with('error', "{$programme->code} still has students. Move them to another programme first.");
        }

        $programme->delete();

        return redirect()->route('admin.programmes.index')->with('success', "Programme {$programme->code} was deleted.");
    }
}
