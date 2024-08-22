<?php

namespace App\Jobs;

use App\Events\HighPriorityTaskCreated;
use App\Events\TaskCreated;
use App\Models\Task;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;

class ProcessHighPriorityTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $task;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Process the high-priority task
        try {
            broadcast(new HighPriorityTaskCreated($this->task));

        } catch (Exception $e) {
            Log::error("Error processing high priority task [ID: {$this->task->id}]: " . $e->getMessage());
            throw $e;
        }
    }

    public function failed(Exception $exception)
    {
        Log::error("Failed to process high priority task [ID: {$this->task->id}]: " . $exception->getMessage());
    }

    public function getTask()
    {
        return $this->task;
    }
}
