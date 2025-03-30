<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MLP To-Do</title>

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato', sans-serif;
        }
        .completed-task {
            text-decoration: line-through;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="w-[90%] mx-auto py-8 max-w-[1400px]">
        <!-- Logo Section -->
        <div class="flex justify-start mb-8">
            <img src="{{ asset('logo.png') }}" class="h-16" alt="MLP Logo">
        </div>

        <!-- Main Content -->
        <div class="flex flex-col md:flex-row gap-8 items-start">
            <!-- Left Side - Add Task Form -->
            <div class="w-full md:w-1/3 bg-white rounded-lg shadow p-6 md:self-start">
                <h2 class="text-xl font-semibold mb-4">Add New Task</h2>
                <form id="task-form" action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <input
                            type="text"
                            name="description"
                            id="task-input"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter your task here..."
                            required
                        >
                    </div>
                    <button
                        type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md transition duration-200"
                    >
                    Add
                </button>
                </form>
            </div>

            <!-- Right Side - Task List (2/3 width) -->
            <div class="w-full md:w-2/3 bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Your Tasks</h2>

                @if(count($tasks) > 0)
                    <div class="divide-y divide-gray-200">
                        <div class="py-3 flex items-center text-gray-500 font-medium">
                            <div class="w-12 text-center">#</div>
                            <div class="flex-grow">Task</div>
                            <div class="w-24 text-right">Actions</div>
                        </div>

                        @foreach($tasks as $index => $task)
                            <div class="py-3 flex items-center">
                                <div class="w-12 text-center">{{ $index + 1 }}</div>
                                <div class="flex-grow {{ $task->completed ? 'completed-task text-gray-400' : '' }}">{{ $task->description }}</div>

                                @if(!$task->completed)
                                    <div class="w-24 flex justify-end space-x-2">
                                        <form action="{{ route('tasks.toggle', $task->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-green-500 hover:text-green-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>

                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        No tasks yet. Add your first task!
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Allow pressing Enter to submit the form
        document.getElementById('task-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('task-form').submit();
            }
        });
    </script>
</body>
</html>
