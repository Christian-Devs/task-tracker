<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    public function store(Request $request, Project $project){
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:todo,doing,done',
            'due_date' => 'nullable|date',
        ]);

        return response()->json(
            $project->tasks()->create($data),
            201
        );
    }

    public function updateStatus(Request $request, Task $task)
    {
        $data = $request->validate([
            'status' => 'required|in:todo,doing,done',
        ]);

        $task->update($data);

        return response()->json($task);
    }
}
