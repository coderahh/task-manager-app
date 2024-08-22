<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskDashboard extends Component
{
   public $tasks;

   protected $listeners = ['taskUpdated' => 'refreshTasks', 'taskCreated' => 'refreshTasks'
   , 'taskCompleted' => 'refreshTasks', 'highPriorityTaskCreated' => 'refreshTasks'];

    public function mount()
    {
        $this->tasks = Task::all();
    }

    public function render()
    {
        return view('livewire.task-dashboard');
    }

    public function refreshTasks()
    {
        $this->tasks = Task::all();
    }

    public function deleteTask($taskId)
    {
        $task = Task::findOrFail($taskId);
        $this->authorize('delete', $task);

        $task->delete();

        $this->tasks = Task::where('user_id', auth()->id())->get();

        session()->flash('message', 'Task deleted successfully.');
    }
}
