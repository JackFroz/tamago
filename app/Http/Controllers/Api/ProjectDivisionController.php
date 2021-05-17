<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgressList;
use App\Models\ProjectDivision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $divisionId = Str::random(12);
        $projectDivision = ProjectDivision::create([
            'project_id' => $request->project_id,
            'division_id' => $divisionId,
            'division_name' => $request->division_name,
            'division_desc' => $request->division_desc,

        ]);

        $toDo = ProgressList::create([
            'list_id' => Str::random(12),
            'division_id' => $divisionId,
            'list_name' => 'TO DO',
            'order' => 0,
        ]);

        $inProgress = ProgressList::create([
            'list_id' => Str::random(12),
            'division_id' => $divisionId,
            'list_name' => 'In Progress',
            'order' => 0,
        ]);

        $ready = ProgressList::create([
            'list_id' => Str::random(12),
            'division_id' => $divisionId,
            'list_name' => 'Ready',
            'order' => 0,
        ]);

        $complete = ProgressList::create([
            'list_id' => Str::random(12),
            'division_id' => $divisionId,
            'list_name' => 'Complete',
            'order' => 0,
        ]);

        $status = $toDo && $inProgress && $ready && $complete && $projectDivision;

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Progress lists created' : 'Error creating progress lists',
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
        $success = DB::table('progress_lists')
            ->where('division_id', $projectDivision->division_id)
            ->get();

        return response()->json(['progressLists' => $success]);
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

    public function progressLists($projectDivision)
    {
        $todo = DB::table('progress_lists')
            ->where('division_id', $projectDivision)
            ->where('list_name', 'TO DO')
            ->first();

        $inProgress = DB::table('progress_lists')
            ->where('division_id', $projectDivision)
            ->where('list_name', 'In Progress')
            ->first();

        $ready = DB::table('progress_lists')
            ->where('division_id', $projectDivision)
            ->where('list_name', 'Ready')
            ->first();

        $complete = DB::table('progress_lists')
            ->where('division_id', $projectDivision)
            ->where('list_name', 'Complete')
            ->first();

        return response()->json([
            'progressLists' => [
                'todo' => $todo,
                'inProgress' => $inProgress,
                'ready' => $ready,
                'complete' => $complete,
            ]
        ]);
    }

    public function projectMembers(ProjectDivision $projectDivision)
    {
        return response()->json($projectDivision->projectMembers());
    }
}
