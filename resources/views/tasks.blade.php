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
            @include('partials.task-form')
            @include('partials.task-list')
        </div>
    </div>
</body>
</html>
