<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Tasks</h1>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <a href="{{ route('tasks.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600">
        Create New Task
    </a>

    <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md">
        <thead>
            <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Title</th>
                <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Description</th>
                <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Priority</th>
                <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Due Date</th>
                <th class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $task->title }}</td>
                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $task->description }}</td>
                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ ucfirst($task->priority) }}</td>
                    <td class="px-6 py-4 text-sm">
                        @if($task->status == 'completed')
                            <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300 px-2 py-1 rounded-md">{{ ucfirst($task->status) }}</span>
                        @elseif($task->status == 'in_progress')
                            <span class="bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-300 px-2 py-1 rounded-md">{{ ucfirst($task->status) }}</span>
                        @elseif($task->status == 'delayed')
                            <span class="bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-300 px-2 py-1 rounded-md">{{ ucfirst($task->status) }}</span>
                        @else
                            <span class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-300 px-2 py-1 rounded-md">{{ ucfirst($task->status) }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ \Morilog\Jalali\Jalalian::forge($task->due_date)->format('Y-m-d') }}</td>
                    @if (auth()->user()->id === $task->user_id)
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        <button wire:click="deleteTask({{ $task->id }})" class="ml-4 text-red-500 hover:underline">Delete</button>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>



<!-- <script type="module" src="resources/js/app.js"></script> -->
@vite('resources/js/app.js')
<script>
    Echo.channel('notifications')
        .listen('HighPriorityTaskCreated', (e) => {
            console.log(e);
            alert('A new high-priority task has been created: ' + e.task.title);
        })
        .listen('TaskCompleted', (e) => {
            console.log(e);
            alert('A task has been completed: ' + e.task.title);
        });
</script>
