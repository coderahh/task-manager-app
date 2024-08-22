
@extends('layouts.app')

@section('content')
    <div class="container mx-auto max-w-4xl mt-12">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Create Task</h1>
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <!-- Display validation errors -->
                @if ($errors->any())
                    <div class="mb-4">
                        <div class="bg-red-500 text-white p-3 rounded-md">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                    <input type="text" class="form-input mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-gray-300" id="title" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea class="form-textarea mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-gray-300" id="description" name="description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select class="form-select mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-gray-300" id="status" name="status" required>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="delayed" {{ old('status') == 'delayed' ? 'selected' : '' }}>Delayed</option>
                    </select>
                    @error('status')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Priority</label>
                    <select class="form-select mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-gray-300" id="priority" name="priority" required>
                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                        <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    </select>
                    @error('priority')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Due Date</label>
                    <input type="date" class="form-input mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-gray-300" id="due_date" name="due_date" value="{{ old('due_date') }}" required>
                    @error('due_date')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Create Task</button>
                </div>
            </form>
        </div>
    </div>
@endsection


