<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Attachment::all()->toArray());
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
        $attachmentId = Str::random(12);
        $attachment = Attachment::create([
            'attachment_id' => $attachmentId,
            'attachment_name' => $request->attachment_name,
            'attachment_url' => $request->attachment_url,
            'card_id' => $request->card_id,
        ]);

        return response()->json([
            'status' => (bool)$attachment,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Attachment $attachment)
    {
        return response()->json($attachment);
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
    public function update(Request $request, Attachment $attachment)
    {
        $status = $attachment->update($request->only([
            'attachment_name',
            'attachment_url',
        ]));

        return response()->json([
            'status' => (bool)$status,
            'message' => $status ? 'Attachment updated' : 'Error updating attachment',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attachment $attachment)
    {
        $status = $attachment->delete();

        return response()->json([
            'status' => (bool)$status,
            'message' => $status ? 'Attachment deleted' : 'Error deleting attachment',
        ]);
    }
}
