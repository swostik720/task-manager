<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->tasks();

        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        $tasks = $query->get();

        $totalTasks = $tasks->count();
        $completedTasks = $tasks->where('is_complete', true)->count();
        $completionPercentage = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100, 2) : 0;

        return view('tasks.index', compact('tasks', 'completionPercentage'));
    }

    public function toggleCompletion(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $task->is_complete = !$task->is_complete;
        $task->save();

        return response()->json([
            'success' => true,
            'is_complete' => $task->is_complete,
        ]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
        ]);

        $validatedData['user_id'] = auth()->id();

        Task::create($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
