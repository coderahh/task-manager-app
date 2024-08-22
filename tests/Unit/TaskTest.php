<?php

namespace Tests\Unit;

use App\Jobs\ProcessHighPriorityTask;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Queue;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_high_priority_task_queue()
    {
        Queue::fake();

        $task = Task::factory()->create(['priority' => 'high']);

        ProcessHighPriorityTask::dispatch($task);

        Queue::assertPushed(ProcessHighPriorityTask::class, function ($job) use ($task) {
            return $task->id === $job->getTask()->id;
        });
    }
}
