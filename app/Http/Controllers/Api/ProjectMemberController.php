<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProjectMember;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(ProjectMember::all()->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $projectMember = ProjectMember::create([
            'division_id' => Str::random(12),
            'member_email' => $request->member_email,
            'division_name' => $request->division_name,
            'division_desc'=> $request->division_desc,
        ]);

        return response()->json([
            'status' => $projectMember,
            'message' => $projectMember ? 'Project member added' : 'Error adding project member',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectMember $projectMember)
    {
        return response()->json($projectMember);
    }

    public function cardMembers(ProjectMember $projectMember)
    {
        return response()->json($projectMember->cardMembers());
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
    public function update(Request $request, ProjectMember $projectMember)
    {
        $status = $projectMember->update($request->only([
            'division_id',
            'permission',
        ]));

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Project member updated' : 'Error updating project member',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectMember $projectMember)
    {
        $status = $projectMember->delete();
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Project member deleted' : 'Error deleting project member',
        ]);
    }
}
