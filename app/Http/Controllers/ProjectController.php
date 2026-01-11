<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        return response()->json(
            Project::create($data),
            201
        );
    }

    public function show(Project $project){
        $project->load([
            'tasks' => fn($q) => $q->orderBy('due_date', 'desc')
        ]);

        return response()->json($project);
    }
}
