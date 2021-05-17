<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Card::all()->toArray());
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
        $listId = DB::table('progress_lists')
            ->where('list_name', $request->list_name)
            ->where('division_id', $request->division_id) 
            ->first()
            ->list_id;

        $card = Card::create([
            'card_id' => Str::random(12),
            'list_id' => $listId,
            'card_name' => $request->card_name,
            'card_desc' => $request->card_desc,
            'card_deadline' => $request->card_deadline,
            'order' => $request->order,
        ]);

        return response()->json([
            'status' => $card,
            'message' => $card ? 'Card created' : 'Error creating card',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        return response()->json($card);
    }

    public function cardMembers(Card $card)
    {
        return response()->json($card->cardMembers());
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
    public function update(Request $request, Card $card)
    {
        $status = $card->update($request->only([
            'card_name',
            'card_desc',
            'card_deadline',
            'order',
        ]));

        return response()->json([
            'status' => $card,
            'message' => $card ? 'Card updated' : 'Error creating card',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        $status = $card->delete();

        return response()->json([
            'card' => $card,
            'message' => $card ? 'Card deleted' : 'Error deleting card',
        ]);
    }
}
