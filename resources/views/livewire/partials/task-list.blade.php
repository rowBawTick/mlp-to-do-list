<!-- Right Side - Task List -->
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

                    <div class="w-24 flex justify-end space-x-2">
                        @if(!$task->completed)
                            <!-- Complete Task Button -->
                            <button
                                wire:click="toggleComplete({{ $task->id }})"
                                class="text-green-500 hover:text-green-700 focus:outline-none w-5 h-5"
                                title="Mark as completed"
                                wire:loading.attr="disabled"
                                wire:target="toggleComplete({{ $task->id }})"
                            >
                                <x-heroicon-o-check-circle wire:loading.remove wire:target="toggleComplete({{ $task->id }})" class="h-5 w-5" />
                                <flux:icon.loading wire:loading wire:target="toggleComplete({{ $task->id }})" class="h-5 w-5 text-green-500" theme="light" />
                            </button>

                            <!-- Delete Task Button -->
                            <button
                                wire:click="deleteTask({{ $task->id }})"
                                class="text-red-500 hover:text-red-700 focus:outline-none w-5 h-5"
                                title="Delete task"
                                wire:loading.attr="disabled"
                                wire:target="deleteTask({{ $task->id }})"
                            >
                                <x-heroicon-o-x-circle wire:loading.remove wire:target="deleteTask({{ $task->id }})" class="h-5 w-5" />
                                <flux:icon.loading wire:loading wire:target="deleteTask({{ $task->id }})" class="h-5 w-5 text-red-500" theme="light" />
                            </button>
                        @else
                            <!-- Reopen Task Button -->
                            <button
                                wire:click="toggleComplete({{ $task->id }})"
                                class="text-blue-500 hover:text-blue-700 focus:outline-none w-5 h-5"
                                title="Reopen task"
                                wire:loading.attr="disabled"
                                wire:target="toggleComplete({{ $task->id }})"
                            >
                                <x-heroicon-o-arrow-path wire:loading.remove wire:target="toggleComplete({{ $task->id }})" class="h-5 w-5" />
                                <flux:icon.loading wire:loading wire:target="toggleComplete({{ $task->id }})" class="h-5 w-5 text-blue-500" theme="light" />
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-8 text-gray-500">
            No tasks yet. Add your first task!
        </div>
    @endif
</div>
