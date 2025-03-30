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
            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md 
                   transition duration-200"
        >
            Add
        </button>
    </form>
    
    <script>
        // Allow pressing Enter to submit the form
        document.getElementById('task-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('task-form').submit();
            }
        });
    </script>
</div>
