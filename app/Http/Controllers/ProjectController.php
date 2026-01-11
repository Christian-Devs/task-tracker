<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    //function to create and store a new project
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        return response()->json(
            Project::create($data),
            201
        );
    }

    //function to retrieve an existing project
    public function show(Project $project){
        $project->load([
            'tasks' => fn($q) => $q->orderBy('due_date', 'desc')
        ]);

        return response()->json($project);
    }
}
