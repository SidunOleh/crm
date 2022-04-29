<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Project::class, 'project');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $user = $request->user();

        switch ($user->permissions['projects']['read']) {
            case 1:
                $projects = $user->projects;
            break;

            case 2:
                $projects = $user->company->projects;
            break;
        }

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProjectRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProjectRequest $request)
    {
        $validated = $request->safe()->merge([
            'user_id' => $request->user()->id,
        ])->all();

        Project::create($validated);

        return back()->with([
            'status'  => 'ok',
            'message' => 'Project was created successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->validated());

        return back()->with([
            'status'  => 'ok',
            'message' => 'Project was updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index');
    }

    /**
     * Search for projects.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $search = $request->validate(['search'=>'nullable|string'])['search'];
        $user   = $request->user();

        $projects = $user->company->projects()->where(
            function ($query) use($search) {
                $query->where('projects.name', 'like', "%$search%")
                    ->orWhere('projects.description', 'like', "%$search%")
                    ->orWhere('projects.status', 'like', "%$search%");
            }
        );

        if ($user->permissions['projects']['read'] == 1) {
            $projects->where('user_id', $user->id);
        }

        return view('projects.search', ['projects' => $projects->get(),]);
    }
}
