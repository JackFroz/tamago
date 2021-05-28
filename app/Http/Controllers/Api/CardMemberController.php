<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CardMember;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CardMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(CardMember::all()->toArray());
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
        $cardMember = CardMember::create([
            'card_member_id' => Str::random(12),
            'card_id' => $request->card_id,
            'username' => $request->username,
            'member_id' => $request->member_id,
        ]);

        return response()->json([
            'status' => $cardMember,
            'message' => $cardMember ? 'Card member added' : 'Error adding card member',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CardMember $cardMember)
    {
        return response()->json($cardMember);
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
    public function update(Request $request, CardMember $cardMember)
    {
        $status = $cardMember->update($request->only(['card_id']));

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Card member updated' : 'Error updating card member',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CardMember $cardMember)
    {
        $status = $cardMember->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Card member deleted' : 'Error deleting card member'
        ]);
    }

    public function user(CardMember $cardMember)
    {
        return response()->json($cardMember->user()->first());
    }
}
