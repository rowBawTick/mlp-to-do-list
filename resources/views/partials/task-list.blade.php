<!-- Right Side - Task List (2/3 width) -->
<div class="w-full md:w-2/3 bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-semibold mb-4">Your Tasks</h2>

    @if(count($tasks) > 0)
        <div class="divide-y divide-gray-200">
            <!-- Header Row -->
            <div class="py-3 flex items-center text-gray-500 font-medium">
                <div class="w-12 text-center">#</div>
                <div class="flex-grow">Task</div>
                <div class="w-24 text-right">Actions</div>
            </div>

            <!-- Task Rows -->
            @foreach($tasks as $index => $task)
                <div class="py-3 flex items-center">
                    <div class="w-12 text-center">{{ $index + 1 }}</div>
                    <div class="flex-grow {{ $task->completed ? 'completed-task text-gray-400' : '' }}">
                        {{ $task->description }}
                    </div>

                    @if(!$task->completed)
                        <div class="w-24 flex justify-end space-x-2">
                            <!-- Complete Task Button -->
                            <form action="{{ route('tasks.toggle', $task->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-green-500 hover:text-green-700">
                                    <x-heroicon-o-check-circle class="h-5 w-5" />
                                </button>
                            </form>

                            <!-- Delete Task Button -->
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <x-heroicon-o-x-circle class="h-5 w-5" />
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
