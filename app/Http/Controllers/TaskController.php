<?php

namespace App\Http\Controllers;

use App\Events\HighPriorityTaskCreated;
use App\Events\TaskCreated;
use App\Events\TaskUpdated;
use App\Jobs\ProcessHighPriorityTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Log;

class TaskController extends Controller
{
    public function create()
    {
        return view('layouts.tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'status' => 'required|in:pending,in_progress,completed,delayed',
            'priority' => 'required|in:high,medium,low',
            'due_date' => 'required|date|after:now',
        ]);

        $task = $request->user()->tasks()->create($request->all());

        if ($task->priority === 'high') {
            // Dispatch the job to process high-priority tasks
            ProcessHighPriorityTask::dispatch($task)->onQueue('high_priority');
            // Broadcast event for high-priority task
            broadcast(new HighPriorityTaskCreated($task));
        }

        broadcast(new TaskCreated($task));

        return redirect()->route('dashboard')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        return view('layouts.tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'status' => 'required|in:pending,in_progress,completed,delayed',
            'priority' => 'required|in:high,medium,low',
            'due_date' => 'required|date|after:now',
        ]);

        $task->update($request->all());

        if ($task->status === 'completed') {
            // Broadcast event for task completion
            broadcast(new TaskUpdated($task));
        }

        broadcast(new TaskUpdated($task));

        return redirect()->route('dashboard')->with('success', 'Task updated successfully.');


    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Task deleted successfully.');
    }
}

