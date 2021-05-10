<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProjectMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $checkOwnership = DB::table('projects')
            ->where('project_id', $request->project_id)
            ->first();

        if ($checkOwnership->owner_email === $request->user()->email) {
            return response()->json([
                'status' => false,
                'message' => 'This project is belong to you!',
            ]);
        }

        $checkMembership = DB::table('project_members')
            ->where('project_id', $request->project_id)
            ->where('member_email', $request->user()->email)
            ->first();

        if (!$checkMembership) {
            $projectMember = ProjectMember::create([
                'member_id' => Str::random(12),
                'project_id' => $request->project_id,
                'division_id' => null,
                'member_email' => $request->user()->email,
                'permission' => null,
            ]);

            return response()->json([
                'status' => $projectMember,
                'message' => $projectMember ? 'Project member added' : 'Error adding project member',
            ]);
        }

        if ($checkMembership->member_email === $request->user()->email) {
            return response()->json([
                'status' => false,
                'message' => 'You are already member of this project!',
            ]);
        }
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
