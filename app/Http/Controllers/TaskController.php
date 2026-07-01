<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Show all tasks
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    // Create new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date'
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date
        ]);

        return redirect()->route('tasks.index');
    }

    // Mark task as completed
    public function complete($id)
    {
        $task = Task::findOrFail($id);

        $task->update([
            'completed' => true
        ]);

        return redirect()->route('tasks.index');
    }

    // Show edit form
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    // Update task
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date'
        ]);

        $task = Task::findOrFail($id);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date
        ]);

        return redirect()->route('tasks.index');
    }

    // Delete task
    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        return redirect()->route('tasks.index');
    }
}