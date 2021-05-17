<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgressList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProgressListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(ProgressList::all()->toArray());
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
        $toDo = ProgressList::create([
            'list_id' => Str::random(12),
            'division_id' => $request->division_id,
            'list_name' => 'TO DO',
        ]);

        $inProgress = ProgressList::create([
            'list_id' => Str::random(12),
            'division_id' => $request->division_id,
            'list_name' => 'In Progress',
        ]);

        $ready = ProgressList::create([
            'list_id' => Str::random(12),
            'division_id' => $request->division_id,
            'list_name' => 'Ready',
        ]);

        $complete = ProgressList::create([
            'list_id' => Str::random(12),
            'division_id' => $request->division_id,
            'list_name' => 'Complete',
        ]);

        $status = $toDo && $inProgress && $ready && $complete;

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
    public function show(ProgressList $progressList)
    {
        return response()->json($progressList);
    }

    public function cards($progressList)
    {
        $success = DB::table('cards')
            ->where('list_id', $progressList)
            ->get();

        return response()->json(['cards' => $success]);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProgressList $progressList)
    {
        $status = $progressList->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Progress list deleted' : 'Error deleting progress list',
        ]);
    }
}
