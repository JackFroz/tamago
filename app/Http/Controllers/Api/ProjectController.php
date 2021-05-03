<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Project::all()->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = Project::create([
            'project_id' => Str::uuid(), 
            'project_name' => $request->project_name, 
            'project_desc' => $request->project_desc, 
            'owner_email' => $request->user()->email,
            ]);

        return response()->json([
            'status' => (bool)$project,
            'message' => $project ? 'Project created' : 'Error creating project',
            ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return response()->json($project);
    }

    public function projectDivisions(Project $project)
    {
        return response()->json($project->projectDivisions()->orderBy('division_name'));
    }

    public function projectMembers(Project $project)
    {
        return response()->json($project->projectMembers()->orderBy('division_name'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $status = $project->update($request->only([
            'project_name', 
            'project_desc'
            ]));
        
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Project updated' : 'Error updating project',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
