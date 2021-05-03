<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProjectDivision;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectDivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(ProjectDivision::all()->toArray());
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
        $projectDivision = ProjectDivision::create([
            'division_id' => Str::random(12),
            'project_id' => $request->user()->email,
            'division_name' => $request->division_name,
            'division_desc'=> $request->division_desc,
        ]);

        return response()->json([
            'status' => $projectDivision,
            'message' => $projectDivision ? 'Project division created' : 'Error creating project division',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectDivision $projectDivision)
    {
        return response()->json($projectDivision);
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
    public function update(Request $request, ProjectDivision $projectDivision)
    {
        $status = $projectDivision->update($request->only([
            'division_name',
            'division_desc',
        ]));

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Project division updated' : 'Error updating project division',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectDivision $projectDivision)
    {
        $status = $projectDivision->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Project division deleted' : 'Error deleting project division',
        ]);
    }

    public function progressLists(ProjectDivision $projectDivision)
    {
        return response()->json($projectDivision->progressLists()->orderBy('order'));
    }

    public function projectMembers(ProjectDivision $projectDivision)
    {
        return response()->json($projectDivision->projectMembers());
    }
}
