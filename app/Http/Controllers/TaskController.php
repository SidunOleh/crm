<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
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

        switch ($user->permissions['tasks']['read']) {
            case 1:
                $tasks = $user->tasks;
            break;

            case 2:
                $tasks = $user->company->tasks;
            break;
        }

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProjectRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TaskRequest $request)
    {
        $validated = $request->safe()->merge([
            'user_id' => $request->user()->id,
        ])->all();
        $validated['deadline'] = date('Y-m-d', strtotime($validated['deadline']));

        Task::create($validated);

        return back()->with([
            'status'  => 'ok',
            'message' => 'Task was created successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TaskRequest $request, Task $task)
    {
        $validated = $request->validated();
        $validated['deadline'] = date('Y-m-d H:i:s', strtotime($validated['deadline']));

        $task->update($validated);

        return back()->with([
            'status'  => 'ok',
            'message' => 'Task was updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }

    /**
     * Search for tasks.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $search = $request->validate(['search'=>'nullable|string'])['search'];
        $user   = $request->user();

        $tasks = $user->company->tasks()->where(
            function ($query) use($user, $search) {
                $query->where('tasks.name', 'like', "%$search%")
                    ->orWhere('tasks.description', 'like', "%$search%");
            }
        );

        if ($user->permissions['tasks']['read'] == 1) {
            $tasks->where('tasks.user_id', $user->id);
        }

        return view('tasks.search', ['tasks' => $tasks->get(),]);
    }
}
