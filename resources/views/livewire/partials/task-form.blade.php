<!-- Left Side - Add Task Form -->
<div class="w-full md:w-1/3 bg-white rounded-lg shadow p-6 md:self-start">
    <h2 class="text-xl font-semibold mb-4">Add New Task</h2>

    <form wire:submit="createTask">
        <div class="mb-4">
            <input
                type="text"
                wire:model="description"
                id="task-input"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter your task here..."
                required
            >
            @error('description')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <button
            type="submit"
            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md
                   transition duration-200"
        >
            Add
        </button>
    </form>
</div>
