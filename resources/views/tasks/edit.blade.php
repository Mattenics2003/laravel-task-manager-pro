<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task | Task Manager Pro</title>

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
            margin-top:40px;
        }

        .header{
            background:linear-gradient(45deg,#ffc107,#fd7e14);
            color:white;
            padding:35px;
        }

        .btn{
            border-radius:10px;
        }

        footer{
            color:white;
            text-align:center;
            margin-top:30px;
        }

        .form-card{
            border:none;
            border-radius:20px;
            transition:0.3s;
        }

        .form-card:hover{
            transform:translateY(-5px);
            box-shadow:0 10px 25px rgba(0,0,0,.2);
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

<div class="container">

    <div class="card shadow-lg main-card">

        <!-- HEADER -->
        <div class="header text-center">
            <h1>
                <i class="fa-solid fa-pen-to-square"></i>
                EDIT TASK
            </h1>
            <p class="mb-0">Update your task details below</p>
        </div>

        <div class="card-body p-4">

            <!-- FORM -->
            <div class="card form-card shadow-sm">
                <div class="card-body">

                    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                        @csrf
                        @method('PUT')

                        <label class="form-label fw-bold">Task Title</label>
                        <input
                            type="text"
                            name="title"
                            class="form-control mb-3"
                            value="{{ $task->title }}"
                            required>

                        <label class="form-label fw-bold">Description</label>
                        <textarea
                            name="description"
                            class="form-control mb-3"
                            rows="4">{{ $task->description }}</textarea>

                        <label class="form-label fw-bold">Due Date</label>
                        <input
                            type="date"
                            name="due_date"
                            class="form-control mb-3"
                            value="{{ $task->due_date }}">

                        <div class="d-flex gap-2">

                            <button class="btn btn-success w-100">
                                <i class="fa-solid fa-floppy-disk"></i>
                                Update Task
                            </button>

                            <a href="/" class="btn btn-secondary w-100">
                                <i class="fa-solid fa-arrow-left"></i>
                                Back
                            </a>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

    <footer>
        <p>Task Manager Pro © 2026 | Edit Mode</p>
    </footer>

</div>

</body>
</html>