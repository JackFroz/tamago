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
        $cardId = Str::random(12);
        $card = Card::create([
            'card_id' => $cardId,
            'list_id' => $request->list_id,
            'card_name' => $request->card_name,
            'card_desc' => $request->card_desc,
            'card_deadline' => $request->card_deadline,
            'order' => $request->order,
        ]);

        return response()->json([
            'status' => (bool)$card,
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
            'list_id',
        ]));

        return response()->json([
            'status' => (bool)$status,
            'message' => $status ? 'Card updated' : 'Error updating card',
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
            'status' => (bool)$status,
            'message' => $status ? 'Card deleted' : 'Error deleting card',
        ]);
    }

    public function cardMembers(Card $card)
    {
        return response()->json($card->cardMembers()->get());
    }

    public function attachments(Card $card)
    {
        return response()->json($card->attachments()->get());
    }
}
