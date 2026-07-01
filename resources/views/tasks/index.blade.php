<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager Pro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        body{
            background: linear-gradient(135deg,#667eea,#764ba2);
            min-height:100vh;
        }

        .navbar{
            background:#212529;
        }

        .main-card{
            border:none;
            border-radius:25px;
            overflow:hidden;
        }

        .header{
            background:linear-gradient(45deg,#0d6efd,#6610f2);
            color:white;
            padding:35px;
        }

        .stats-card{
            border:none;
            border-radius:20px;
            transition:0.3s;
        }

        .stats-card:hover{
            transform:translateY(-5px);
        }

        .task-card{
            border:none;
            border-radius:20px;
            transition:0.3s;
        }

        .task-card:hover{
            transform:translateY(-5px);
            box-shadow:0 10px 25px rgba(0,0,0,.2);
        }

        .completed{
            text-decoration:line-through;
            color:gray;
        }

        .btn{
            border-radius:10px;
        }

        footer{
            color:white;
            text-align:center;
            margin-top:30px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark shadow">
    <div class="container">
        <span class="navbar-brand fw-bold">
            <i class="fa-solid fa-list-check"></i>
            Task Manager Pro
        </span>
    </div>
</nav>

<div class="container py-5">

    <div class="card shadow-lg main-card">

        <div class="header text-center">
            <h1> TASK MANAGER FOR ALL</h1>
            <p class="mb-0">
                Organize your daily activities efficiently.
            </p>
        </div>

        <div class="card-body p-4">

            <!-- Statistics -->
            <div class="row mb-4">

                <div class="col-md-4 mb-3">
                    <div class="card stats-card shadow text-center p-3">
                        <h2>{{ count($tasks) }}</h2>
                        <p>Total Tasks</p>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card stats-card shadow text-center p-3">
                        <h2>{{ $tasks->where('completed', true)->count() }}</h2>
                        <p>Completed</p>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card stats-card shadow text-center p-3">
                        <h2>{{ $tasks->where('completed', false)->count() }}</h2>
                        <p>Pending</p>
                    </div>
                </div>

            </div>

            <!-- Add Task Form -->
            <div class="card shadow mb-4">
                <div class="card-body">

                    <h4 class="mb-3">
                        <i class="fa-solid fa-plus"></i>
                        Add New Task
                    </h4>

                    <form action="/tasks" method="POST">
                        @csrf

                        <input
                            type="text"
                            name="title"
                            class="form-control mb-3"
                            placeholder="Task Title"
                            required>

                        <textarea
                            name="description"
                            class="form-control mb-3"
                            rows="3"
                            placeholder="Task Description"></textarea>

                        <input
                            type="date"
                            name="due_date"
                            class="form-control mb-3">

                        <button class="btn btn-primary w-100">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Save Task
                        </button>
                    </form>

                </div>
            </div>

            <!-- Task List -->
            <h4 class="mb-3">
                <i class="fa-solid fa-list"></i>
                My Tasks
            </h4>

            @forelse($tasks as $task)

                <div class="card task-card shadow-sm mb-3">
                    <div class="card-body">

                        <h5>

                            @if($task->completed)
                                <span class="completed">
                                    <i class="fa-solid fa-circle-check text-success"></i>
                                    {{ $task->title }}
                                </span>
                            @else
                                <i class="fa-solid fa-circle"></i>
                                {{ $task->title }}
                            @endif

                        </h5>

                        <p class="text-muted">
                            {{ $task->description }}
                        </p>

                        @if($task->due_date)
                            <span class="badge bg-danger">
                                <i class="fa-solid fa-calendar"></i>
                                Due: {{ $task->due_date }}
                            </span>
                        @endif

                        <div class="mt-3">

                            <form
                                action="/tasks/{{ $task->id }}/complete"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('PUT')

                                <button class="btn btn-success btn-sm">
                                    <i class="fa-solid fa-check"></i>
                                    Complete
                                </button>
                            </form>

                            <a
                                href="/tasks/{{ $task->id }}/edit"
                                class="btn btn-warning btn-sm">

                                <i class="fa-solid fa-pen"></i>
                                Edit
                            </a>

                            <form
                                action="/tasks/{{ $task->id }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this task?')">

                                    <i class="fa-solid fa-trash"></i>
                                    Delete
                                </button>
                            </form>

                        </div>

                    </div>
                </div>

            @empty

                <div class="alert alert-info text-center">
                    <h5>No tasks yet 🚀</h5>
                    <p>Add your first task above.</p>
                </div>

            @endforelse

        </div>
    </div>

    <footer>
        <p>
            Task Manager Pro © 2026 | Built with Laravel & Bootstrap
        </p>
    </footer>

</div>

</body>
</html>